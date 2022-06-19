<?php

require_once "AppController.php";
// require_once __DIR__."/../scraping/UltimateGuitar.php";
require_once __DIR__."/../scraping/RetrieveResults.php";

class ResultsController extends AppController {
    public function results() {
        if($this->isGet()) {
            echo("data was not sent");
        }

        var_dump($_POST);

        $artist = $_POST["Artist_name"];
        $title = $_POST["Song_title"];

        echo($artist);
        echo($title);

        $title = str_replace(" ", "%20", $title);
        print("https://www.ultimate-guitar.com/search.php?search_type=title&value=$artist%20$title\n");

        $retrieveResults = new RetrieveResults($artist, $title);

        echo("links: \n");

        $links = $retrieveResults->getLinks();
        print($links);
        // foreach($links as $link) {
        //     var_dump($link);
        // }
    }

    public function loginResult() {
        $userRepository = new UserRepository();

        if($this->isGet()) {
            echo("data was not sent");
        }

        $email = $_POST["Email"];
        $password = $_POST["Password"];

        $user =$userRepository->getUserByEmail($email);

        if (!$user) {
            return $this->render("login", ["variables" => ["User with this email does not exist"]]);
        } else if ($user->getPassword() !== $password) {
            return $this->render("login", ["variables" => ["Wrong email / password"]]);
        } else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/index");
        }
        die();
    }

    public function registerResult() {
        $user = new User("andrzejdude@gmail.com", "dooda", 1);

        var_dump($_POST);
        die();
    }
}