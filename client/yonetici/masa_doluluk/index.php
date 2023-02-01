<?php

require_once "../../include/bas.php";
require_once "../../client/masa_islemler.php";

$masalar = new masa_islem;
?>

<div class="container mt-3">
    <div class="row">
        <div class="mb-3 text-center">
            <h1>Masa Doluluk</h1>
        </div>
        <?php $masalar->masa_list(); ?>
    </div>
</div>