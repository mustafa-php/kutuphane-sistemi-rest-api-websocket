<?php

namespace v1;

use masa_islem;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require_once dirname(__DIR__) . "/client/masa_islemler.php";

class masa implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $veri)
    {
        $masa_islem = new masa_islem();

        $veri = json_decode($veri, true);
        foreach ($this->clients as $client) {
            $veriler = [
                "kisi" => $veri["kisi"],
                "kisiid" => $veri["kisiid"],
                "masano" => $veri["masano"],
                "islem" => $veri["islem"]
            ];


            if ($veri["islem"] == "giriş") {
                $masa_islem->masa_kisi($veri["kisi"]);
                $masa_islem->masa_kisiid($veri["kisiid"]);
                $masa_islem->masano($veri["masano"]);
                $masa_islem->masa_durum("dolu");
            } else {
                $masa_islem->masa_kisi("-");
                $masa_islem->masa_kisiid("-");
                $masa_islem->masano($veri["masano"]);
                $masa_islem->masa_durum("bos");
            }

            $client->send(json_encode($veriler));

            $masa_islem->masa_islem();
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
