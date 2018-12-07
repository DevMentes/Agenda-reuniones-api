<?php

namespace Babilonia\Context\Agenda\Domain\RestrictedHour;

use Babilonia\Context\Agenda\Domain\User\PublicUser;

class RestrictedHour
{
    private $id;

    private $user;

    private $weekday;

    private $startAt;

    private $finishAt;

    public function __construct(string $id, PublicUser $user, string $weekday, string $startAt, string $finishAt)
    {
        $this->id = $id;
        $this->user = $user;
        $this->weekday = $weekday;
        $this->startAt = $startAt;
        $this->finishAt = $finishAt;
    }

    public function id():string
    {
        return $this->id;
    }

    public function user():PublicUser
    {
        return $this->user;
    }

    public function weekday():string
    {
        return $this->weekday;
    }

    public function startAt():string
    {
        return $this->startAt;
    }

    public function finishAt():string
    {
        return $this->finishAt;
    }
}