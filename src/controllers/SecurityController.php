<?php

require_once "AppController.php";
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../repository/UserRepository.php";

class SecurityController extends AppController {
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
            // return $this->render("index", ["variables" => [$user->getId()]]);
            return $this->render("index", ["variables" => [$user->getId()]]);
            // $url = "http://$_SERVER[HTTP_HOST]";
            // header("Location: {$url}/index");
        }
        die();
    }

    public function registerResult() {
        $user = new User("andrzejdude@gmail.com", "dooda", 1);

        var_dump($_POST);
        die();
    }
}