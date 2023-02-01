<div align="center">
<h1>Kütüphane Sistemi || PHP REST API & WEBSOCKET</h1>
<img src="https://img.shields.io/github/license/mustafa-php/kutuphane-sistemi-rest-api-websocket?color=blue&label=Lisans&logo=github">
<img src="https://img.shields.io/badge/version-v1-blue?style=plastic">
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

<br><br>

# Nedir ?

**Mustafa Şimşek** tarafından versionlar halinde yayınlanacak olan Kütüphane Sistemi Rest API sayesinde (Listeleme-Ekleme-Güncelleme-Silme) isteklerini gönderir
ve gönderilen isteklere tepki vererek istenilen komutların çalışmasına olanak sağlar. PHP'nin Socket Kütüphanesi ``Ratchet Websocket`` aracılığı ile gerçel zamanlı olarak masa doluluk oranlarına erişim sağlayıp masa giriş-çıkış işlemini görüntülemekte yardımcı olur.

# Kullanım Bilgileri !

## Klonla

Kullanmak için öncelikle depoyu klonlamak lazım...

    git clone https://github.com/mustafa-php/kutuphane-sistemi-rest-api-websocket.git
    
komutu ile klonlamanızı tamamlayın

    kutuphane-sistemi-rest-api-websocke/ 
    
klasöründen **server** ve **client** klasörlerini çıkartalım

<br>

### SERVER klasörü ne işe yarar ?

Rest API yardımı ile verileri alacağımız dosyaları içerir.

### Client klasörü ne işe yara ?

Yönetici ve üye paneli, websocket kütüphanesi ve api isteklerini ileten dosyaları içerir
