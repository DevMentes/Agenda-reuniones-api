<?php

namespace Babilonia\Context\Account\Domain\User;

class User
{
    protected $id;

    protected $name;

    protected $surnames;

    protected $email;

    protected $password;

    public function __construct(
        string $id, string $name, string $surnames, string $email, string $password
    )
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