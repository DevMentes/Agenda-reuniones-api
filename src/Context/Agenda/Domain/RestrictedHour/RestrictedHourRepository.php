<?php

namespace Babilonia\Context\Agenda\Domain\RestrictedHour;

use Babilonia\Context\Agenda\Domain\User\PublicUser;

interface RestrictedHourRepository
{
    public function userHasRestrictedHoursInDate(PublicUser $publicUser, string $date, string $startAt, string $finishAt):bool;

    public function restrict(RestrictedHour $restrictedHour):void;

    public function week(PublicUser $user):array;
}