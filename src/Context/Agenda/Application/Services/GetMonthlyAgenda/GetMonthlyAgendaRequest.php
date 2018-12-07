<?php

namespace Babilonia\Context\Agenda\Application\Services\GetMonthlyAgenda;

class GetMonthlyAgendaRequest
{
    private $user;

    private $year;

    private $month;

    public function __construct(?array $user, ?int $year, ?int $month)
    {
        $this->user = $user;
        $this->year = $year;
        $this->month = $month;
    }

    public function user():array
    {
        return $this->user;
    }

    public function year():int
    {
        return $this->year;
    }

    public function month():int
    {
        return $this->month;
    }
}