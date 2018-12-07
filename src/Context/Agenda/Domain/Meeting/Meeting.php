<?php

namespace Babilonia\Context\Agenda\Domain\Meeting;

use Babilonia\Context\Agenda\Domain\User\PublicUser;

class Meeting
{
    private $id;

    private $organizer;

    private $date;

    private $startAt;

    private $finishAt;

    private $guests = array();

    public function __construct(string $id, PublicUser $organizer, string $date, string $startAt, string $finishAt)
    {
        $this->id = $id;
        $this->organizer = $organizer;
        $this->date = $date;
        $this->startAt = $startAt;
        $this->finishAt = $finishAt;
    }

    public function addGuest(PublicUser $guestUser)
    {
        $this->guests[] = $guestUser;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function organizer(): PublicUser
    {
        return $this->organizer;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function startAt(): string
    {
        return $this->startAt;
    }

    public function finishAt(): string
    {
        return $this->finishAt;
    }

    public function guests():array
    {
        return $this->guests;
    }
}