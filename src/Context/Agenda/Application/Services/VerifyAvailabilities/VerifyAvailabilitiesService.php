<?php

namespace Babilonia\Context\Agenda\Application\Services\VerifyAvailabilities;

use Babilonia\Context\Agenda\Domain\Agenda\AgendaService;
use Babilonia\Context\Agenda\Domain\Meeting\MeetingRepository;
use Babilonia\Context\Agenda\Domain\RestrictedHour\RestrictedHourRepository;
use Babilonia\Context\Agenda\Domain\User\PublicUser;

class VerifyAvailabilitiesService
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

    public function execute(VerifyAvailabilitiesRequest $request)
    {
        $users = $request->publicUsers();
        $date = $request->date();
        $startAt = $request->startAt();
        $finishAt = $request->finishAt();

        $publicUsers = array();

        foreach ($users as $user)
        {
            $publicUsers [] = new PublicUser(
                $user['id'],
                $user['name'],
                $user['surnames'],
                $user['email']
            );
        }

        $agenda = new AgendaService(
            $this->meetingRepository,
            $this->restrictedHourRepository
        );

        $publicUsersAvailabilities = array();

        foreach ($publicUsers as $publicUser){

            $publicUsersAvailabilities [] = [
                'user' => $publicUser,
                'availability' =>$agenda->availabilityForUser(
                    $publicUser,
                    $date,
                    $startAt,
                    $finishAt
                )
            ];
        }

        return $publicUsersAvailabilities;
    }
}