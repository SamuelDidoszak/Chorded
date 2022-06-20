<?php

require_once "Repository.php";
require_once __DIR__."/../models/User.php";

class UserRepository extends Repository {
    public function getUserByEmail(string $email): ?User {
        $query = $this->database->connect()->prepare(
            "SELECT * FROM public.users WHERE email = :email"
        );
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);
        if($user == false)
            return null;
        return new User(
            $user["id"],
            $user["email"],
            $user["password"]
        );
    }

    public function register(string $email, string $password): ?User {
        $query = $this->database->connect()->prepare(
            "SELECT add_user('$email', '$password');"
        );
        $query->bindParam(":email", $email, ":password", $password, PDO::PARAM_STR);
        $query->execute();

        $id = $query->fetch(PDO::FETCH_ASSOC);
        if($id == false)
            return null;
        return new User(
            $id["add_user"],
            $email,
            $password
        );
    }

    public function getUserType(int $id): ?int {
        $query = $this->database->connect()->prepare(
            "SELECT type FROM public.user_types WHERE user_id = :id"
        );
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();

        $id = $query->fetch(PDO::FETCH_ASSOC);
        if($id == false)
            return null;
        return $id["type"];
    }
}

