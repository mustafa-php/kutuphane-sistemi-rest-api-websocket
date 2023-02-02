<?php
session_start();
?>

<!Doctype html>
<html lang="tr" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kütüphane</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <base href="https://mustafa/projeler/php/api/kütüphane/v1/client/">
    <link rel="stylesheet" href="include/index.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>

<body>
    <style>
        header a {
            font-size: 1.2rem;
            padding: .5rem 1.5rem;
            margin: 1rem .5rem;
            display: inline-block;
            background: #422A23;
            width: min-content;
        }
    </style>
    <header class="container-fluid">
        <div class="fs-1 fw-bold text-center p-3 pb-2 text-white col-12">
            Mustafa Şimşek Kütüphane API & WebSocket
        </div>
        <div class="row justify-content-center">
            <a href="yonetici/" class="col-auto">Anasayfa</a>
        </div>
    </header>