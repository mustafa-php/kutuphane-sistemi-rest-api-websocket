<?php

require_once "veritabani.php";
$veritabani = new veritabani();

$method = $_SERVER["REQUEST_METHOD"];

header("Content-Type:application/json; charset=utf-8");
error_reporting(0);

$veriler = json_decode(file_get_contents("php://input"), true);

function api($icerik, $kod, $mesaj)
{
    $api["icerik"] = $icerik;
    $api["kod"] = $kod;
    $api["mesaj"] = $mesaj;
    $cevap = json_encode($api, JSON_UNESCAPED_UNICODE);
    print_r($cevap);
}


switch ($method) {
    case 'GET';
        if ($veriler["giris"]) {
            $api = $veritabani->get("SELECT * FROM {$veriler['tablo']} WHERE eposta='{$veriler['kullanici_giris']['eposta']}' && sifre='{$veriler['kullanici_giris']['sifre']}'");
            return count($api) > 0 ? api($api, 200, "Başarılı") : api("Boş", 404, "Başarısız");
        } else if ($veriler["liste"]) {
            $api = $veritabani->get("SELECT * FROM {$veriler['tablo']}");
            return count($api) > 0 ? api($api, 200, "Başarılı") : api("Boş", 404, "Başarısız");
        } else if ($veriler["tekli_liste"]) {
            $api = $veritabani->get("SELECT * FROM {$veriler['tablo']} WHERE id={$veriler['id']}");
            return count($api) > 0 ? api($api, 200, "Başarılı") : api("Boş", 404, "Başarısız");
        }
        break;
    case 'POST':
        $dizi_sayisi = count($veriler["degerler"]);
        $dizi_anahtarlari = array_keys($veriler["degerler"]);
        $dizi_degerleri = array_values($veriler["degerler"]);
        for ($i = 0; $i < $dizi_sayisi; $i++) {
            $oge["anahtar"] .= "$dizi_anahtarlari[$i],";
            $oge["deger"] .= "'$dizi_degerleri[$i]',";
        }

        $oge["anahtar"] = rtrim($oge["anahtar"], ",");
        $oge["deger"] = rtrim($oge["deger"], ",");
        $api = $veritabani->post("INSERT INTO {$veriler['tablo']} ({$oge['anahtar']}) VALUE ({$oge['deger']})");
        $api == true ? api("Başarılı", 200, "Başarılı") : api("Başarısız", 404, "Başarısız");
        break;
    case 'PUT':
        $dizi_sayisi = count($veriler["degerler"]);
        $dizi_anahtarlari = array_keys($veriler["degerler"]);
        $dizi_degerleri = array_values($veriler["degerler"]);
        for ($i = 0; $i < $dizi_sayisi; $i++) {
            $degerler .= "$dizi_anahtarlari[$i] = '$dizi_degerleri[$i]',";
        }

        $degerler = rtrim($degerler, " ,");
        $api = $veritabani->put("UPDATE {$veriler['tablo']} SET {$degerler} WHERE id={$veriler['id']}");
        $api == true ? api("Başarılı", 200, "Başarılı") : api("Başarısız", 404, "Başarısız");
        break;
    case 'DELETE':
        $api = $veritabani->delete("DELETE FROM {$veriler['tablo']} WHERE id={$veriler['id']}");
        $api == true ? api("Başarılı", 200, "Başarılı") : api("Başarısız", 404, "Başarısız");

        break;
    default:
        die("BU METHODLAR BOY BOY");
        break;
}