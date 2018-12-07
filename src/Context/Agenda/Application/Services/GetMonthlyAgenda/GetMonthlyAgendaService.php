<?php

namespace Babilonia\Context\Agenda\Application\Services\GetMonthlyAgenda;

use Babilonia\Context\Agenda\Domain\User\PublicUser;
use Babilonia\Context\Agenda\Domain\Meeting\MeetingRepository;
use Babilonia\Context\Agenda\Domain\RestrictedHour\RestrictedHourRepository;

class GetMonthlyAgendaService
{

    private $meetingRepository;

    private $restrictedHourRepository;

    public function __construct(MeetingRepository $meetingRepository, RestrictedHourRepository $restrictedHourRepository)
    {
        $this->meetingRepository = $meetingRepository;
        $this->restrictedHourRepository = $restrictedHourRepository;
    }

    public function execute(GetMonthlyAgendaRequest $request):array
    {

        $user = $request->user();
        $year = $request->year();
        $month = $request->month();

        $publicUser = new PublicUser(
            $user['id'],
            $user['name'],
            $user['surnames'],
            $user['email']
        );

        $meetings = $this->meetingRepository->forMonth($publicUser, $year, $month);

        $restrictedHours = $this->restrictedHourRepository->week($publicUser);

        return [
            'meetings' => $meetings,
            'restrictedHours' => $restrictedHours
        ];
    }
}