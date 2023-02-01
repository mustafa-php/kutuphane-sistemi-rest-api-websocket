<?php

class İstek
{

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

    public function post($veri)
    {

        $veriler = [
            "method" => "POST",
            "veri" => $veri
        ];
        return $this->curl($veriler);
    }

    public function put($veri)
    {
        $veriler = [
            "method" => "PUT",
            "veri" => $veri
        ];

        return $this->curl($veriler);
    }

    public function delete($veri)
    {
        $veriler = [
            "method" => "DELETE",
            "veri" => $veri
        ];
        return $this->curl($veriler);
    }
}
