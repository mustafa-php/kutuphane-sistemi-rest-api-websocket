<?php
require_once "../../include/bas.php";
require_once "../../client/yazar_islemler.php";

$yazar_islem = new yazar_islem();
?>

<div class="container mt-5">
    <div class="row">
        <?php
        if (isset($_GET["islem"])) {
            switch ($_GET["islem"]) {
                case 'tumlist':
                    $yazar_islem->tumlist();
                    break;
                case 'ekle':
                    $yazar_islem->ekle();
                    break;
                case 'sil':
                    $yazar_islem->sil();
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