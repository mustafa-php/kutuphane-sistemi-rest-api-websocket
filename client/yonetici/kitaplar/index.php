<?php
require_once "../../include/bas.php";
require_once "../../client/kitap_islemler.php";

$kitap_islem = new kitap_islem();
?>

<div class="container mt-5">
    <div class="row">
        <?php
        if (isset($_GET["islem"])) {
            switch ($_GET["islem"]) {
                case 'tumlist':
                    $kitap_islem->tumlist();
                    break;
                case 'ekle':
                    $kitap_islem->ekle();
                    break;
                case 'guncelleme':
                    $kitap_islem->guncelle();
                    break;
                case 'sil':
                    $kitap_islem->sil();
                    break;
                default:
                    header("location:./");
                    break;
            }
        } else {
            header("location:./?islem=tumlist");
        }
        ?>
    </div>
</div>