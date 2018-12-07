<?php

namespace Babilonia\Context\Agenda\Domain\User;

class PublicUser
{
    protected $id;

    protected $name;

    protected $surnames;

    protected $email;


    public function __construct(string $id, string $name, string $surnames, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surnames = $surnames;
        $this->email = $email;
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
}