<?php

namespace Babilonia\Context\Agenda\Domain\Meeting;

use Babilonia\Context\Agenda\Domain\User\PublicUser;

interface MeetingRepository
{
    public function userHasMeetingInDate(PublicUser $publicUser, string $date, string $startAt, string $finishAt):bool;

    public function schedule(Meeting $newMeeting):void;

    public function forMonth(PublicUser $publicUser, int $year,int $month):array;
}