<?php

namespace Babilonia\Context\Agenda\Application\Services\VerifyAvailabilities;

class VerifyAvailabilitiesRequest
{
    protected $publicUsers;

    protected $date;

    protected $startAt;

    protected $finishAt;

    public function __construct(?array $publicUsers, ?string $date, ?string $startAt, ?string $finishAt)
    {
        $this->publicUsers = $publicUsers;
        $this->date = $date;
        $this->startAt = $startAt;
        $this->finishAt = $finishAt;
    }

    public function publicUsers():?array
    {
        return $this->publicUsers;
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