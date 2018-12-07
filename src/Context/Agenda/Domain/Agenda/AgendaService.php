<?php

namespace Babilonia\Context\Agenda\Domain\Agenda;

use Babilonia\Context\Agenda\Domain\Meeting\MeetingRepository;
use Babilonia\Context\Agenda\Domain\RestrictedHour\RestrictedHourRepository;
use Babilonia\Context\Agenda\Domain\User\PublicUser;

class AgendaService
{
    private $meetingRepository;

    private $restrictedHourRepository;

    public function __construct(
        MeetingRepository $meetingRepository, RestrictedHourRepository $restrictedHourRepository
    )
    {
        $this->meetingRepository = $meetingRepository;
        $this->restrictedHourRepository = $restrictedHourRepository;
    }

    public function availabilityForUser(PublicUser $user, $date, string $startAt, string $finishAt):bool
    {

        $userAvailability = $this->meetingRepository->userHasMeetingInDate($user, $date, $startAt, $finishAt);

        if(!$userAvailability){
            return false;
        }

        $userAvailability = $this->restrictedHourRepository->userHasRestrictedHoursInDate(
                $user, Weekdays::dayFromDate($date), $startAt, $finishAt
            );

        if (!$userAvailability){
            return false;
        }

        return true;
    }
}