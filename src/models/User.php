<?php

class User {
    private $id;
    private $email;
    private $password;
    private $type;

    public function __construct(string $email, string $password, int $type) {
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}