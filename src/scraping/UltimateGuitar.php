<?php

// require __DIR__."/../../vendor/guzzlehttp/guzzle/src/Client.php";
// require __DIR__."/../../vendor\\fabpot\goutte\Goutte/Client.php";

require __DIR__."/../../vendor/autoload.php";

use Goutte\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpClient\HttpClient;

class UltimateGuitar {
    
    private $goutteClient;
    private $guzzleClient;
    private $links;

    public function __construct(string $author, string $title) {
        $client = new Client(HttpClient::create(['timeout' => 60]));
        // $goutteClient = new \Goutte\Client();
        // $guzzleClient = new GuzzleClient([
        //     "timeout" => 60,
        // ]);
        // $goutteClient->setClient($guzzleClient);

        $xpath = "/html/body/div[1]/div[2]/main/div[2]/div[2]/section/article/div/div[2]/div[2]/header/span/span/a";

        $title = str_replace(" ", "%20", $title);
        // $crawler = $client->request("GET", "https://www.ultimate-guitar.com/search.php?search_type=title&value=$author%20$title");
        $crawler = $client->request("GET", "https://www.ultimate-guitar.com/search.php?search_type=title&value=lilypichu%20dreamy%20night");
        // $this->links = $crawler->html();
        $this->links = $crawler->filter('a._3DU-x.JoRLr._3dYeW')->each(function($node){
            // print_r($node);
            print("\njeff\n");
            return $node;
        });
    }

    public function getLinks()
    {
        return $this->links;
    }
}