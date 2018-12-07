<?php

namespace Babilonia\Context\Agenda\Application\Services\ScheduleMeeting;

class ScheduleMeetingRequest
{
    private $organizerUser;

    private $guestUsers;

    private $date;

    private $startAt;

    private $finishAt;

    public function __construct(
        array $organizerUser, array $guestUsers, string $date, string $startAt, string $finishAt
    )
    {
        $this->organizerUser = $organizerUser;
        $this->guestUsers= $guestUsers;
        $this->date = $date;
        $this->startAt = $startAt;
        $this->finishAt = $finishAt;
    }

    public function organizerUser():array
    {
        return $this->organizerUser;
    }

    public function guestUsers():array
    {
        return $this->guestUsers;
    }

    public function date():string
    {
        return $this->date;
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