<?php

class kitap_islem
{
    private $istek;
    public function __construct()
    {
        require_once "../../client/istek.php";
        $istek = new İstek();

        $this->istek = $istek;
    }

    public function kategorilis()
    {
        $veri = [
            "tablo" => "kategoriler",
            "liste" => true
        ];

        return $this->liste($veri);
    }

    public function yazarlis()
    {
        $veri = [
            "tablo" => "yazarlar",
            "liste" => true
        ];

        return $this->liste($veri);
    }

    public function liste($veri)
    {
        return  $this->istek->get($veri);
    }

    public function idlist()
    {
        $int = (int)($_GET["id"]);
        (int)($int) != 0 ?
            $veri = [
                "tablo" => "kitaplar",
                "tekli_liste" => true,
                "id" => addslashes($int)
            ] : header("location:./");

        return $this->liste($veri);
    }

    public function tumlist()
    {
        $veri = [
            "tablo" => "kitaplar",
            "liste" => true
        ];

        $liste = $this->liste($veri);
        if (empty($liste->icerik) || $liste->icerik == "Boş") {
            die();
        }
        foreach ($liste->icerik as $deger) {
?>
            <div class="col-6 p-3">
                <div class="card mb-3 p-2" style="width:100%;">
                    <div class="row justify-content-center g-0" style=" height:20rem;">
                        <div class="col-md-10 d-flex flex-column h-100">
                            <h2 class="card-title p-3"><?php echo $deger->baslik; ?></h2>
                            <div class="card-body">
                                <div class="fs-5">
                                    <div class="mb-2">
                                        <b>Yazar : </b><span><?php echo $deger->yazar; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <b>Kategori : </b><span><?php echo $deger->kategori; ?></span>
                                    </div>
                                    <div class="mb-2">
                                        <b>Yayın Evi : </b><span><?php echo $deger->yayinevi; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 border-top border-1 border-secondary">
                                <div class="row">
                                    <div class="col d-grid">
                                        <a href="yonetici/kitaplar/?islem=guncelleme&id=<?php echo $deger->id; ?>" class="btn btn-primary">Güncelle</a>
                                    </div>
                                    <div class="col d-grid">
                                        <a href="yonetici/kitaplar/?islem=sil&id=<?php echo $deger->id; ?>" class="btn btn-danger">Sil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }


    public function ekle()
    {
        $kategoriler =  $this->kategorilis();
        $yazarlar =  $this->yazarlis();


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $veri = [
                "tablo" => "kitaplar",
                "degerler" => [
                    "baslik" => $_POST["baslik"],
                    "yazar" => $_POST["yazar"],
                    "kategori" => $_POST["kategori"],
                    "yayinevi" => $_POST["yayinevi"]
                ]
            ];

            $this->istek->post($veri);
        }
        ?>
        <div class="col-12">
            <div class="text-center mb-5">
                <h1>Kitap Ekle</h1>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-6">
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" class="row g-2" method="post">
                        <div class="form-floating mb-3 col-6">
                            <input type="text" class="form-control" name="baslik" id="formId1" placeholder="Başlık" value="">
                            <label for="formId1">Başlık</label>
                        </div>
                        <div class="form-floating mb-3 col-6">
                            <input type="text" class="form-control" name="yayinevi" id="formId2" placeholder="Yayınevi" value="">
                            <label for="formId2">Yayınevi</label>
                        </div>
                        <div class="form-floating mb-3 col-6">
                            <select class="form-select" name="yazar">
                                <option selected disabled>Yazar Seç</option>
                                <?php
                                foreach ($yazarlar->icerik as $deger) {
                                ?>
                                    <option value="<?php echo $deger->isim; ?>">
                                        <?php echo $deger->isim; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                            <label for="" class="form-label">Yazar</label>
                        </div>
                        <div class="form-floating mb-3 col-6">
                            <select class="form-select" name="kategori">
                                <option selected disabled>Kategori Seç</option>
                                <?php
                                foreach ($kategoriler->icerik as $deger) {
                                ?>
                                    <option value="<?php echo $deger->baslik; ?>">
                                        <?php echo $deger->baslik; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                            <label for="" class="form-label">Kategori</label>
                        </div>
                        <div class="col-12 d-grid">
                            <button class="btn btn-success">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php
    }



    public function guncelle()
    {
        $bilgiler = $this->idlist();
        $kategoriler =  $this->kategorilis();
        $yazarlar =  $this->yazarlis();

        if ($bilgiler->icerik == "Boş") {
            header("location:./");
            die();
        } else {
            $id = $bilgiler->icerik[0]->id;
            $baslik = $bilgiler->icerik[0]->baslik;
            $yayinevi = $bilgiler->icerik[0]->yayinevi;
            $yazar = $bilgiler->icerik[0]->yazar;
            $kategori = $bilgiler->icerik[0]->kategori;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $veri = [
                "tablo" => "kitaplar",
                "id" => $id,
                "degerler" => [
                    "baslik" => $_POST["baslik"],
                    "yazar" => $_POST["yazar"],
                    "kategori" => $_POST["kategori"],
                    "yayinevi" => $_POST["yayinevi"]
                ]
            ];

            $this->istek->put($veri);
            header("location:./");
        }
    ?>
        <div class="col-12">
            <div class="text-center mb-5">
                <h1>Kitap Güncelleme</h2>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-6">
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" class="row g-2" method="post">
                        <div class="form-floating mb-3 col-6">
                            <input type="text" class="form-control" name="baslik" id="formId1" placeholder="Başlık" value="<?php echo $baslik; ?>">
                            <label for="formId1">Başlık</label>
                        </div>
                        <div class="form-floating mb-3 col-6">
                            <input type="text" class="form-control" name="yayinevi" id="formId2" placeholder="Yayınevi" value="<?php echo $yayinevi; ?>">
                            <label for="formId2">Yayınevi</label>
                        </div>
                        <div class="form-floating mb-3 col-6">
                            <select class="form-select" name="yazar" id="">
                                <?php
                                foreach ($yazarlar->icerik as $deger) {
                                    if ($deger->isim == $yazar) {
                                ?>
                                        <option value="<?php echo $deger->isim; ?>" selected>
                                            <?php echo $deger->isim; ?>
                                        </option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $deger->isim; ?>">
                                            <?php echo $deger->isim; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="" class="form-label">Yazar</label>
                        </div>
                        <div class="form-floating mb-3 col-6">
                            <select class="form-select" name="kategori" id="" data-bs-theme="dark">
                                <?php
                                foreach ($kategoriler->icerik as $deger) {
                                    if ($deger->baslik == $kategori) {
                                ?>
                                        <option value="<?php echo $deger->baslik; ?>" selected>
                                            <?php echo $deger->baslik; ?>
                                        </option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $deger->baslik; ?>">
                                            <?php echo $deger->baslik; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <label for="" class="form-label">Kategori</label>
                        </div>
                        <div class="col-12 d-grid">
                            <button class="btn btn-success">Güncelle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
    }

    public function sil()
    {
        $this->idlist()->icerik != "Boş" ?
            $veri = [
                "tablo" => "kitaplar",
                "id" => $_GET["id"]
            ]
            : header("location:./");

        $this->istek->delete($veri);
        return header("location: ./");
    }
}
