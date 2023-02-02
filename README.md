<div align="center">
    
# Kütüphane Sistemi
# PHP REST API & WEBSOCKET

<img src="https://img.shields.io/github/license/mustafa-php/kutuphane-sistemi-rest-api-websocket?color=blue&label=Lisans&logo=github">
<img src="https://img.shields.io/github/v/tag/mustafa-php/kutuphane-sistemi-rest-api-websocket?color=green&label=version&style=plastic">
<img src="https://img.shields.io/badge/php-v^8.0-blue?style=plastic&logo=php">
</div>
<br>
<div align="center">
<img src="img/php-logo-white.png" style="width: 10vw;" alt="">
</div>

<div align="center">
<img src="img/logo.png" style="width: 10vw;" alt="">
<img src="img/ratchet-logo.png" style="width: 10vw;" alt="">
</div>

!["Kütüphane Sistemi Ekran Görüntüsü"](img/Kütüphane.png)

</br>

# Nedir ?

**Mustafa Şimşek** tarafından versionlar halinde yayınlanacak olan Kütüphane Sistemi Rest API sayesinde (Listeleme-Ekleme-Güncelleme-Silme) isteklerini gönderir
ve gönderilen isteklere tepki vererek istenilen komutların çalışmasına olanak sağlar. PHP'nin Socket Kütüphanesi ``Ratchet Websocket`` aracılığı ile gerçel zamanlı olarak masa doluluk oranlarına erişim sağlayıp masa giriş-çıkış işlemini görüntülemekte yardımcı olur.
\
&nbsp;
# Kullanım Bilgileri !

### Klonla

Kullanmak için öncelikle depoyu klonlamak lazım...

    git clone https://github.com/mustafa-php/kutuphane-sistemi-rest-api-websocket.git
    
komutu ile klonlamanızı tamamlayın

    kutuphane-sistemi-rest-api-websocke/ 
    
klasöründen **server** ve **client** klasörlerini çıkartalım
##

### SERVER klasörü ne işe yarar ?

Rest API yardımı ile verileri alacağımız dosyaları içerir.

### Client klasörü ne işe yara ?

Yönetici ve üye paneli, websocket kütüphanesi ve api isteklerini ileten dosyaları içerir
\
&nbsp;
\
&nbsp;
## Örnek API isteği &rarr; Veri Çekme İsteği &darr; 
```php
Dosya : client/client/istek.php

 public function curl($veriler)
    {
        $curl_basla = curl_init();
        curl_setopt($curl_basla, CURLOPT_CUSTOMREQUEST, $veriler["method"]);
        curl_setopt($curl_basla, CURLOPT_POSTFIELDS, json_encode($veriler["veri"]));
        curl_setopt_array($curl_basla, [
            CURLOPT_URL => "https://hostname.com/server/api/api.php",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
        ]);
        $sonuc = curl_exec($curl_basla);
        curl_close($curl_basla);
        return json_decode($sonuc);
    }

 public function get($veri)
    {
        $veriler = [
            "method" => "GET",
            "veri" => $veri
        ];

        return $this->curl($veriler);
    }

```
## Server cevabı &darr;

```json
{
    "icerik": {
        "0": {
            "id": "1",
            "baslik": "Kaval Yelleri",
            "yazar": "Reşat Nuri Güntekin",
            "kategori": "Dram"
        },
        "1": {
            "id": "2",
            "baslik": "Çalı Kuşu",
            "yazar": "Reşat Nuri Güntekin",
            "kategori": "Romantik"
        }
    },
    "kod": 200,
    "mesaj": "Başarılı"
}
```
\
&nbsp;
# Ratchet Websocket

Ratchet Websocket kütüphanesi depo içerisinde yerleşik pozisyondadır.

#### Websocket oluşturmak için ``client\bin\server.php`` dosyasının içerisinde port numarası belirlememiz lazım.

## Örnek server.php içeriği &darr; 
```php
Dosya : client/bin/server.php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use v1\masa;

    require dirname(__DIR__) . '/vendor/autoload.php';

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new masa()
            )
        ),
      |--> 8080 <--|
    );

    $server->run();
```
Port numarası depo klonlanması ile otomatik ``:8080`` olarak gelecektir.

    php client\bin\server.php

Terminalden yukarıda (&uarr;) bulunan isteği gerçekleştirdiğinizde websocket dinlenmeye hazır olucak.
\
&nbsp;
### Pekiii, sıra geldi web socket isteklerini dinlemeye ....

```js
  var conn = new WebSocket('ws://localhost:8080');
  
  conn.onopen = function(e){
    conn.send("Websocket girişi yapıldı...");
  }
  
  conn.onclose = function(e){
    conn.send("Websocket çıkış yapıldı...");
  }
  
  conn.onmessage = function(e) {
    var veri = e.data;
    console.log(veri);
  }
   
```

Web socket dinlemesini de tamamdık artık uygulamamızı kullanıp php bilgisi edinebilirsiniz.

# Kolay gelsin sağlıcakla kalınız -Mustafa Şimşek🌹



