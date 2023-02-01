<?php

require_once "../include/bas.php";
require_once "../client/uye_islemler.php";
require_once "../client/masa_islemler.php";

$uye_islem = new uye_islem();
$masa_islem = new masa_islem();

?>

<div class="container mt-5">
    <div class="row">
        <?php
        if (isset($_GET["islem"])) {
            switch ($_GET["islem"]) {
                case 'giris':
                    $uye_islem->giris();
                    break;
                case 'kayit_ol':
                    $uye_islem->kayit_ol();
                    break;
                case 'cikis':
                    $uye_islem->uye_cikis();
                    break;
                case 'masalar':
                    $masa_islem->masalar();
                    break;
                default:
                    header("location:./");
                    break;
            }
        } else {
            header("location:./?islem=giris");
        }
        ?>
    </div>
</div>
