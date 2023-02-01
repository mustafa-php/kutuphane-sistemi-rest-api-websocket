<?php

class masa_islem
{
    private $istek;

    private $masa_kisi;
    private $masa_kisiid;
    private $masano;
    private $masa_durum;

    function masa_kisi($masa_kisi)
    {
        return $this->masa_kisi = $masa_kisi;
    }

    function masa_kisiid($masa_kisiid)
    {
        return $this->masa_kisiid = $masa_kisiid;
    }

    function masano($masano)
    {
        return $this->masano = $masano;
    }

    function masa_durum($masa_durum)
    {
        return $this->masa_durum = $masa_durum;
    }

    public function __construct()
    {
        require_once dirname(__DIR__) . "/client/istek.php";
        $istek = new İstek();

        $this->istek = $istek;
    }

    public function masalar()
    {

        if (empty($_SESSION["bilgi"])) {
            return header("location:./");
        }

        $veri = [
            "tablo" => "masalar",
            "liste" => true
        ];

        $masalar =  $this->istek->get($veri);
?>
        <div>
            <div>
                <button class="btn btn-warning masa-cikis">Masa Çıkış</button>
            </div>
            <div>
                <a href="screen/?islem=cikis" class="btn btn-danger">Oturum Çıkış</a>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="text-center mb-5 col-12">
                    <h1>Masalar</h1>
                </div>
                <?php
                foreach ($masalar->icerik as $masa) {
                    if ($masa->durum == "dolu") {
                ?>
                        <div class="col-3 p-2">
                            <div class="masa position-relative dolu" id="<?php echo $masa->masano; ?>">
                                <span class="d-block text-center fs-4 fw-bold text-white masa-no"><?php echo $masa->masano; ?></span>
                                <?php echo $masa->kisiid == $_SESSION["bilgi"]["id"] ? '<span class="d-block text-center fs-5 isim">' . $masa->kisi . '</span>' : ""; ?>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-3 p-2">
                            <div class="masa position-relative bos" id="<?php echo $masa->masano; ?>">
                                <span class="d-block text-center fs-4 fw-bold text-white masa-no"><?php echo $masa->masano; ?></span>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var conn = new WebSocket('ws://localhost:8080');

                conn.onmessage = function(e) {
                    var veri = JSON.parse(e.data);

                    var kisi = veri.kisi;
                    var kisiid = veri.kisiid;
                    var masano = veri.masano;
                    var islem = veri.islem;
                    console.log(veri);

                    if (islem == "giriş") {
                        $("#" + masano).removeClass("bos");
                        $("#" + masano).addClass("dolu");
                        if (kisiid == <?php echo $_SESSION["bilgi"]["id"]; ?>) {
                            $("#" + masano).append('<span class="d-block text-center fs-5 isim">' + kisi + '</span>');
                        }
                    }

                    if (islem == "çıkış") {
                        $("#" + masano).removeClass("dolu");
                        $("#" + masano).addClass("bos");
                        var mymasano = $(".masa").has(".isim").attr("id");
                        if (masano == mymasano) {
                            $("#" + masano).find(".isim").remove();
                        }
                    }
                }

                $(".masa").click(function() {
                    var x = masakontrol();
                    if (x) {
                        var masano = $(this).attr("id");
                        var kisi = "<?php echo $_SESSION["bilgi"]["isimsoyisim"]; ?>";
                        var kisiid = "<?php echo $_SESSION["bilgi"]["id"]; ?>";
                        var islem = "giriş";

                        var veri = {
                            masano: masano,
                            kisi: kisi,
                            kisiid: kisiid,
                            islem: islem
                        };

                        conn.send(JSON.stringify(veri))
                    }
                });

                $(".masa-cikis").click(function() {
                    var x = masakontrol();
                    if (!x) {
                        var masano = $(".masa").has(".isim").attr("id");
                        var kisi = "<?php echo $_SESSION["bilgi"]["isimsoyisim"]; ?>";
                        var kisiid = "<?php echo $_SESSION["bilgi"]["id"]; ?>";
                        var islem = "çıkış";

                        var veri = {
                            masano: masano,
                            kisi: kisi,
                            kisiid: kisiid,
                            islem: islem
                        };

                        conn.send(JSON.stringify(veri))
                    }
                });

                function masakontrol() {
                    var kontrol = $(".masa").find(".isim").length;
                    if (kontrol > 0) {
                        return false;
                    } else {
                        return true;
                    }
                }

            });
        </script>
        <?php
    }

    public function masa_list()
    {

        $veri = [
            "tablo" => "masalar",
            "liste" => true
        ];

        $masalar =  $this->istek->get($veri);

        foreach ($masalar->icerik as $masa) {
            if ($masa->durum == "dolu") {
        ?>
                <div class="col-3 p-2">
                    <div class="masa position-relative dolu" id="<?php echo $masa->masano; ?>">
                        <span class="d-block text-center fs-4 fw-bold text-white masa-no"><?php echo $masa->masano; ?></span>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="col-3 p-2">
                    <div class="masa position-relative bos" id="<?php echo $masa->masano; ?>">
                        <span class="d-block text-center fs-4 fw-bold text-white masa-no"><?php echo $masa->masano; ?></span>
                    </div>
                </div>
        <?php
            }
        } ?>
        <script>
            var conn = new WebSocket('ws://localhost:8080');

            conn.onmessage = function(e) {
                var veri = JSON.parse(e.data);
                var masano = veri.masano;
                var islem = veri.islem;
                console.log(veri);
                if (islem == "giriş") {
                    $("#" + masano).removeClass("bos");
                    $("#" + masano).addClass("dolu");
                }

                if (islem == "çıkış") {
                    $("#" + masano).removeClass("dolu");
                    $("#" + masano).addClass("bos");
                }
            }

            $(".masa").click(function() {
                var y = $(this).hasClass("dolu");
                if (y) {
                    var masano = $(this).attr("id");
                    var islem = "çıkış";
                    var veri = {
                        masano: masano,
                        islem: islem
                    };
                    conn.send(JSON.stringify(veri))
                }
            });
        </script>
<?php
    }

    public function masa_islem()
    {
        $veri = [
            "tablo" => "masalar",
            "id" => $this->masano,
            "degerler" => [
                "kisi" => $this->masa_kisi,
                "kisiid" => $this->masa_kisiid,
                "durum" => $this->masa_durum,
                "masano" => $this->masano
            ]
        ];

        return $this->istek->put($veri);
    }
}