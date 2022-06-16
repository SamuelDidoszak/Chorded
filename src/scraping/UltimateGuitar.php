<?php

require "GuzzleHttp\Client";
require __DIR__."/../../vendor/guzzlehttp/guzzle/scr/Client.php";

class UltimateGuitar {
    
    private $goutteClient;
    private $guzzleClient;
    private $links;

    public function __construct(string $author, string $title) {
        $guzzleClient = new \GuzzleHttp\Client();
        $guzzleClient = new GuzzleClient([
            "timeout" => 60,
        ]);
        $goutteClient->setClient($guzzleClient);

        str_replace(" ",  $title, "%20");
        $crawler = $goutteClient->request("GET", "https://www.ultimate-guitar.com/search.php?search_type=title&value=$author%20$title");
        $links = $crawler->filter("_3uKbA");
    }
}