<?php

require_once "..(../include/bas.php";
require_once "../../client/kategori_islemler.php";
$kategori_islem = new kategori_islem();

?>

<div class="container mt-5">
    <div class="row">
        <?php
        if (isset($_GET["islem"])) {
            switch ($_GET["islem"]) {
                case 'tumlist':
                    $kategori_islem->tumlist();
                    break;
                case 'ekle':
                    $kategori_islem->ekle();
                    break;
                case 'sil':
                    $kategori_islem->sil();
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