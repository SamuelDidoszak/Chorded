<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository {
    public function getUserByEmail(string $email): ?User {
        $query = $this->database->connect()->prepare(
            "SELECT * FROM users WHERE email = :email"
        );
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user == false)
            return null;
        return new User(
            $user["email"],
            $user["password"],
            1
        );
    }
}

