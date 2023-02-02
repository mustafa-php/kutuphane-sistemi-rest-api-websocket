<?php

class uye_islem
{
    private $istek;
    public function __construct()
    {
        require_once "../../client/istek.php";
        $istek = new İstek();

        $this->istek = $istek;
    }

    public function liste($veri)
    {
        return  $this->istek->get($veri);
    }


    public function tumlist()
    {
        $veri = [
            "tablo" => "uyeler",
            "liste" => true
        ];

        $liste = $this->liste($veri);
        foreach ($liste->icerik as $deger) {
?>
            <div class="col-4 p-3 fs-5">
                <div class="card mb-3" style="width:100%;">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $deger->isimsoyisim; ?></h3>
                        <div>
                            <div>
                                <b>E-posta : </b><span><?php echo $deger->eposta; ?></span>
                            </div>
                            <div>
                                <b>Telefon : </b><span><?php echo $deger->tel; ?></span>
                            </div>
                            <div>
                                <b>Adres : </b><span><?php echo $deger->sehir; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }
    }

    public function giris()
    {
        if (isset($_SESSION["bilgi"])) {
            header("location:./?islem=masalar");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $eposta = $_POST["eposta"];
            $sifre = $_POST["sifre"];

            $veri = [
                "tablo" => "uyeler",
                "giris" => true,
                "kullanici_giris" => [
                    "eposta" => $eposta,
                    "sifre" => $sifre
                ]
            ];
            $giris = $this->istek->get($veri);

            if ($giris->icerik != "Boş") {
                $_SESSION["bilgi"] = [
                    "id" => $giris->icerik[0]->id,
                    "isimsoyisim" => $giris->icerik[0]->isimsoyisim
                ];

                header("location:./");
            } else {
            ?>
                <div class="p-3 position-fixed bottom-0 start-50 translate-middle text-center col-md-12 col-lg-3">
                    <div class="alert alert-danger" role="alert">
                        Giriş Başarısız Oldu !
                    </div>
                </div>
        <?php
            }
        }

        ?>

        <div class="col-12">
            <div class="row justify-content-center align-items-center">
                <div class="col-6">
                    <div class="text-center mb-5">
                        <h1>Giriş</h1>
                    </div>

                    <form action="" class="row g-2" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="eposta" id="eposta" placeholder="eposta">
                            <label for="eposta">E-posta</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="sifre" id="sifre" placeholder="sifre">
                            <label for="sifre">Şire</label>
                        </div>

                        <div class="col-12 d-grid">
                            <button class="btn btn-success" type="submit">Giriş</button>
                            <p class="mt-5 text-center">
                                <span>Hesabın Yokmu ? - <a href=""><b>Kaydol</b></a></span>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php
    }

    public function kayit_ol()
    {

        if (isset($_SESSION["bilgi"])) {
            header("location:./?islem=masalar");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $isim = $_POST["isimsoyisim"];
            $eposta = $_POST["eposta"];
            $tel = $_POST["tel"];
            $sehir = $_POST["sehir"];
            $ilce = $_POST["ilce"];
            $adres = $_POST["adres"];
            $sifre = $_POST["sifre"];

            $veri = [
                "tablo" => "uyeler",
                "degerler" => [
                    "isimsoyisim" => $isim,
                    "eposta" => $eposta,
                    "tel" => $tel,
                    "sehir" => $sehir,
                    "ilce" => $ilce,
                    "adres" => $adres,
                    "sifre" => $sifre
                ]
            ];

            $this->istek->post($veri);
        }
    ?>

        <div class="col-12">
            <div class="row justify-content-center">
                <div class="text-center mb-5">
                    <h1>Kayıt Ol</h1>
                </div>
                <div class="col-8">
                    <form action="" method="post" class="row g-2 justify-content-center">
                        <div class="form-floating mb-3 col-4">
                            <input type="text" class="form-control" name="isimsoyisim" id="isimsoyisim" placeholder="İsim - Soyisim">
                            <label for="isimsoyisim">İsim - Soyisim</label>
                        </div>

                        <div class="form-floating mb-3 col-4">
                            <input type="text" class="form-control" name="eposta" id="eposta" placeholder="E-posta">
                            <label for="eposta">E-posta</label>
                        </div>

                        <div class="form-floating mb-3 col-4">
                            <input type="text" class="form-control" name="tel" id="tel" placeholder="Telefon">
                            <label for="tel">Telefon</label>
                        </div>

                        <div class="form-floating mb-3 col-4">
                            <input type="text" class="form-control" name="sehir" id="sehir" placeholder="Şehir">
                            <label for="sehir">Şehir</label>
                        </div>

                        <div class="form-floating mb-3 col-4">
                            <input type="text" class="form-control" name="ilce" id="ilce" placeholder="İlçe">
                            <label for="ilce">İlçe</label>
                        </div>

                        <div class="form-floating mb-3 col-4">
                            <textarea name="adres" id="adres" class="form-control"></textarea>
                            <label for="adres">Adres</label>
                        </div>

                        <div class="form-floating mb-3 col-4">
                            <input type="text" class="form-control" name="sifre" id="sifre" placeholder="Şifre">
                            <label for="sifre">Şifre</label>
                        </div>

                        <div class="form-floating mb-3 col-4">
                            <input type="text" class="form-control" name="sifretekrar" id="sifretekrar" placeholder="Şifre Tekrar">
                            <label for="sifretekrar">Şifre Tekrar</label>
                        </div>

                        <div class="col-12 d-grid">
                            <button class="btn btn-success">Kayıt Ol</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
    }

    public function uye_cikis()
    {
        session_unset();

        header("location:./");
    }
}