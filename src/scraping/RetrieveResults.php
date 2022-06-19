<?php
require __DIR__."/../../vendor/autoload.php";

use Curl\Curl;
use Spatie\Browsershot\Browsershot;

class RetrieveResults {
    
    private $goutteClient;
    private $guzzleClient;
    private $links;

    public function __construct(string $author, string $title) {

        $author = str_replace(" ", "%20", $author);
        $title = str_replace(" ", "%20", $title);
        $page = "https://www.ultimate-guitar.com/search.php?search_type=title&value=$author%20$title";
        $curl = curl_init($page);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);      
        curl_close($curl);

        $this->links = $output;
    }

    public function getLinks()
    {
        return $this->links;
    }
}