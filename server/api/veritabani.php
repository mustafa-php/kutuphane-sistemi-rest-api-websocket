<?php

class veritabani
{
    private $veritabani;

    public function __construct()
    {
        $this->veritabani = new PDO("mysql:host=host;dbname=veritabani", "kullanici", "sifre");
    }

    public function get($dbislem)
    {
        $veritabani = $this->veritabani->prepare($dbislem);
        $veritabani->execute();
        return $veritabani->fetchAll(PDO::FETCH_OBJ);
    }

    public  function post($dbislem)
    {
        $veritabani = $this->veritabani->prepare($dbislem);
        return $veritabani->execute();
    }

    public function put($dbislem)
    {
        $veritabani = $this->veritabani->prepare($dbislem);
        return $veritabani->execute();
    }

    public function delete($dbislem)
    {
        $veritabani = $this->veritabani->prepare($dbislem);
        return $veritabani->execute();
    }
}
