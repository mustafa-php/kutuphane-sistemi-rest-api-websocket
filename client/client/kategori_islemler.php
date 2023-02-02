<?php

class kategori_islem
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

    public function idlist()
    {
        $int = (int)($_GET["id"]);
        (int)($int) != 0 ?
            $veri = [
                "tablo" => "kategoriler",
                "tekli_liste" => true,
                "id" => addslashes($int)
            ] : header("location:./");

        return $this->liste($veri);
    }

    public function tumlist()
    {
        $veri = [
            "tablo" => "kategoriler",
            "liste" => true
        ];

        $liste = $this->liste($veri);
        foreach ($liste->icerik as $deger) {
?>
            <div class="col-4 p-3 fs-5">
                <div class="alert alert-primary show row w-100" role="alert">
                    <div class="col fs-3"><?php echo $deger->baslik; ?></div>
                    <div class="col-auto">
                        <a href="yonetici/kategoriler/?islem=sil&id=<?php echo $deger->id; ?>" class="btn btn-danger">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        <?php
        }
    }


    public function ekle()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $veri = [
                "tablo" => "kategoriler",
                "degerler" => [
                    "baslik" => $_POST["baslik"]
                ]
            ];

            $this->istek->post($veri);
        }
        ?>

        <div class="col-12">
            <div class="text-center mb-5">
                <h1>Kategori Ekle</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="baslik" id="baslik" placeholder="Başlık">
                            <label for="baslik">Başlık</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                Ekle
                            </button>
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
                "tablo" => "kategoriler",
                "id" => $_GET["id"]
            ]
            : header("location:./");

        $this->istek->delete($veri);
        return header("location: ./");
    }
}
