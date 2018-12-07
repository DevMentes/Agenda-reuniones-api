<?php

namespace Babilonia\Context\Agenda\Infrastructure\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Babilonia\Shared\Errors\MissingFieldException;
use Babilonia\Infrastructure\Slim\Controller\Controller;
use Babilonia\Context\Agenda\Application\Validations\VerifyAvailabilitiesValidator;
use Babilonia\Context\Agenda\Application\Services\VerifyAvailabilities\VerifyAvailabilitiesService;
use Babilonia\Context\Agenda\Application\Services\VerifyAvailabilities\VerifyAvailabilitiesRequest;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent\EloquentMeetingRepository;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent\EloquentRestrictedHourRepository;

class VerifyAvailabilitiesController extends Controller
{
    public function forUsers(Request $request, Response $response)
    {
        $input = $request->getParsedBody();

        $verifyAvailabilitiesRequest = new VerifyAvailabilitiesRequest(
            $input['users'],
            $input['date'],
            $input['startAt'],
            $input['finishAt']
        );

        $validator = new VerifyAvailabilitiesValidator();

        try {
            $errors = $validator->validate($verifyAvailabilitiesRequest);
        } catch (MissingFieldException $exception) {
            return $response->withJson([
                'errors' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }

        if (!empty($errors)){
            return $response->withJson(['errors' => $errors], 400);
        }

        $service = new VerifyAvailabilitiesService(
            new EloquentMeetingRepository(),
            new EloquentRestrictedHourRepository()
        );

        $availabilitiesByUser = $service->execute($verifyAvailabilitiesRequest);

        $userAvailabilities = array();

        foreach ($availabilitiesByUser as $availabilityByUser){
            $userAvailabilities [] = [
                'user' => [
                    'id' => $availabilityByUser['user']->id(),
                    'name' => $availabilityByUser['user']->name(),
                    'surnames' => $availabilityByUser['user']->surnames(),
                    'email' => $availabilityByUser['user']->email()
                ],
                'isAvailable' => $availabilityByUser['availability']
            ];
        }

        return $response->withJson([
            'data' => $userAvailabilities
        ], 200);
    }
}