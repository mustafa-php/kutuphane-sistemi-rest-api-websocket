<?php

require_once "../../include/bas.php";
require_once "../../client/uye_islemler.php";
$uye_islem = new uye_islem();

?>

<div class="container mt-5">
    <div class="row">
        <?php
        if (isset($_GET["islem"])) {
            switch ($_GET["islem"]) {
                case 'tumlist':
                    $uye_islem->tumlist();
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