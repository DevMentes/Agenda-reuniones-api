<?php

namespace Babilonia\Context\Account\Application\Services\RegisterUser;

class RegisterUserRequest
{
    private $id;

    private $name;

    private $surnames;

    private $email;

    private $password;

    public function __construct(?string $id, ?string $name, ?string $surnames, ?string $email, ?string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surnames = $surnames;
        $this->email = $email;
        $this->password = $password;
    }

    public function id():string
    {
        return $this->id;
    }

    public function name():string
    {
        return $this->name;
    }

    public function surnames():string
    {
        return $this->surnames;
    }

    public function email():string
    {
        return $this->email;
    }

    public function password():string
    {
        return $this->password;
    }
}