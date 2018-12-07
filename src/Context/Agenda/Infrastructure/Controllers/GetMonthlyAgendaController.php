<?php

namespace Babilonia\Context\Agenda\Infrastructure\Controllers;

use Babilonia\Context\Agenda\Application\Services\GetMonthlyAgenda\GetMonthlyAgendaRequest;
use Babilonia\Context\Agenda\Application\Services\GetMonthlyAgenda\GetMonthlyAgendaService;
use Slim\Http\Request;
use Slim\Http\Response;
use Babilonia\Infrastructure\Slim\Controller\Controller;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent\EloquentMeetingRepository;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent\EloquentRestrictedHourRepository;

class GetMonthlyAgendaController extends Controller
{
    public function get(Request $request, Response $response)
    {
        $userObj = $request->getAttribute('user');

        $user = [
            'id' => $userObj->id,
            'name' => $userObj->name,
            'surnames' => $userObj->surnames,
            'email' => $userObj->email
        ];

        $input = $request->getParsedBody();

        $year = $input['year'];

        $month = $input['month'];

        $getAgendaRequest = new GetMonthlyAgendaRequest($user, $year, $month);

        $service = new GetMonthlyAgendaService(
            new EloquentMeetingRepository(),
            new EloquentRestrictedHourRepository()
        );

        $eventsForMonth = $service->execute($getAgendaRequest);

        $meetingsForMonth = $eventsForMonth['meetings'];
        $restrictedHoursForMonth = $eventsForMonth['restrictedHours'];

        $meetings = array();

        foreach ($meetingsForMonth as $meeting){
            $meetings [] = [
                'id' => $meeting->id(),
                'date' => $meeting->date(),
                'startAt' => $meeting->startAt(),
                'finishAt' => $meeting->finishAt()
            ];
        }

        $restrictedHours = array();

        foreach ($restrictedHoursForMonth as $restrictedHour){
            $restrictedHours [] = [
                'id' => $restrictedHour->id(),
                'weekday' => $restrictedHour->weekday(),
                'startAt' => $restrictedHour->startAt(),
                'finishAt' => $restrictedHour->finishAt()
            ];
        }

        return $response->withJson([
            'data' => [
                'meetings' => $meetings,
                'restrictedHours' => $restrictedHours
            ]
        ], 200);
    }
}