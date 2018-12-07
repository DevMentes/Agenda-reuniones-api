<?php

namespace Babilonia\Context\Agenda\Infrastructure\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Babilonia\Infrastructure\Slim\Controller\Controller;
use Babilonia\Context\Agenda\Application\Services\ScheduleMeeting\ScheduleMeetingRequest;
use Babilonia\Context\Agenda\Application\Services\ScheduleMeeting\ScheduleMeetingService;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent\EloquentMeetingRepository;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent\EloquentRestrictedHourRepository;

class ScheduleMeetingController extends Controller
{
    public function schedule(Request $request, Response $response)
    {
        $input = $request->getParsedBody();

        $organizer = [
            'id' => $request->getAttribute('user')->id,
            'name' => $request->getAttribute('user')->name,
            'surnames' => $request->getAttribute('user')->surnames,
            'email' => $request->getAttribute('user')->email
        ];

        $guestUsers = array();


        $userScheduleMeetingRequest = new ScheduleMeetingRequest(
            $organizer,
            $guestUsers,
            $input['date'],
            $input['startAt'],
            $input['finishAt']
        );

        $userScheduleMeetingService = new ScheduleMeetingService(
            new EloquentMeetingRepository(),
            new EloquentRestrictedHourRepository()
        );

        $userScheduleMeetingService->execute($userScheduleMeetingRequest);

        return $response->withJson([
            'data' => [
                'message' => 'Meeting was successfully scheduled.'
            ]
        ], 200);
    }
}