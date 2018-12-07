<?php

namespace Babilonia\Context\Account\Domain\User;

class AuthenticatedUser
{
    protected $id;

    protected $name;

    protected $surnames;

    protected $email;

    protected $type;

    public function __construct(string $id, string $name, string $surnames, string $email, string $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surnames = $surnames;
        $this->email = $email;
        $this->type = $type;
    }

    public function id(): string
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

    public function type(): string
    {
        return $this->type;
    }

    public function isAdmin()
    {
        if ($this->type !== 'Admin'){
            return false;
        }

        return true;
    }
}