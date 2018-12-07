<?php

namespace Babilonia\Context\Agenda\Application\Services\RestrictsTimes;

class RestrictsTimeRequest
{
    private $user;

    private $weekdays;

    private $startAt;

    private $finishAt;

    public function __construct(
        ?array $user, ?array $weekdays, ?string $startAt, ?string $finishAt
    )
    {
        $this->user = $user;
        $this->weekdays = $weekdays;
        $this->startAt = $startAt;
        $this->finishAt = $finishAt;
    }

    public function user():?array
    {
        return $this->user;
    }

    public function weekdays():?array
    {
        return $this->weekdays;
    }

    public function startAt():?string
    {
        return $this->startAt;
    }

    public function finishAt():?string
    {
        return $this->finishAt;
    }
}