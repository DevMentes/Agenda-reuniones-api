<?php

namespace Babilonia\Context\Agenda\Application\Services\ScheduleMeeting;

use Babilonia\Infrastructure\Uuid\UuidGenerator;
use Babilonia\Context\Agenda\Domain\Meeting\Meeting;
use Babilonia\Context\Agenda\Domain\User\PublicUser;
use Babilonia\Context\Agenda\Domain\Meeting\MeetingRepository;
use Babilonia\Context\Agenda\Domain\RestrictedHour\RestrictedHourRepository;

class ScheduleMeetingService
{
    private $meetingRepository;

    private $restrictedHourRepository;

    public function __construct(
        MeetingRepository $meetingRepository,
        RestrictedHourRepository $restrictedHourRepository
    )
    {
        $this->meetingRepository = $meetingRepository;
        $this->restrictedHourRepository = $restrictedHourRepository;
    }

    public function execute(ScheduleMeetingRequest $request)
    {

        $organizer = new PublicUser(
            $request->organizerUser()['id'],
            $request->organizerUser()['name'],
            $request->organizerUser()['surnames'],
            $request->organizerUser()['email']
        );

        $guestUsers = array();

        $guestUsersInput = $request->guestUsers();

        foreach ($guestUsersInput as $guestUserInput){
            $guestUsers[] = new PublicUser(
                $guestUserInput['id'],
                $guestUserInput['name'],
                $guestUserInput['surnames'],
                $guestUserInput['email']
            );
        }

        $date = $request->date();
        $startAt = $request->startAt();
        $finishAt = $request->finishAt();


        $meeting = new Meeting(
            UuidGenerator::generate(),
            $organizer,
            $date,
            $startAt,
            $finishAt
        );

        foreach ($guestUsers as $guestUser){
            $meeting->addGuest($guestUser);
        }

        $this->meetingRepository->schedule($meeting);
    }
}