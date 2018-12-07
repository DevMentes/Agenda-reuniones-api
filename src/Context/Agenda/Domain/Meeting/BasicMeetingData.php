<?php

namespace Babilonia\Context\Agenda\Domain\Meeting;

class BasicMeetingData
{
    private $id;

    private $date;

    private $startAt;

    private $finishAt;

    public function __construct(string $id, string $date, string $startAt, string $finishAt)
    {
        $this->id = $id;
        $this->date = $date;
        $this->startAt = $startAt;
        $this->finishAt = $finishAt;
    }

    public function id():string
    {
        return $this->id;
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