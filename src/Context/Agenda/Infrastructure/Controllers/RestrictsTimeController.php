<?php

namespace Babilonia\Context\Agenda\Infrastructure\Controllers;

use Babilonia\Context\Agenda\Application\Services\RestrictsTimes\RestrictsTimeRequest;
use Babilonia\Context\Agenda\Application\Services\RestrictsTimes\RestrictsTimeService;
use Babilonia\Context\Agenda\Application\Validations\RestrictsTimeValidator;
use Babilonia\Context\Agenda\Infrastructure\Persistence\Repositories\Eloquent\EloquentRestrictedHourRepository;
use Babilonia\Shared\Errors\MissingFieldException;
use Slim\Http\Request;
use Slim\Http\Response;
use Babilonia\Infrastructure\Slim\Controller\Controller;

class RestrictsTimeController extends Controller
{
    public function byBlock(Request $request, Response $response)
    {
        $input = $request->getParsedBody();
        $userObj = $request->getAttribute('user');

        $user = [
            'id' => $userObj->id,
            'name' => $userObj->name,
            'surnames' => $userObj->surnames,
            'email' => $userObj->email
        ];

        $weekdays = $input['weekdays'];
        $startAt = $input['startAt'];
        $finishAt = $input['finishAt'];

        $restrictsTimeRequest = new RestrictsTimeRequest(
            $user, $weekdays, $startAt, $finishAt
        );

        $validator = new RestrictsTimeValidator();
        try {
            $errors = $validator->validate($restrictsTimeRequest);
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

        $service = new RestrictsTimeService(
            new EloquentRestrictedHourRepository()
        );
        try{
            $service->execute($restrictsTimeRequest);

            return $response->withJson([
                'data' => [
                    'message' => 'Resource created successfully.'
                ]
            ], 200);

        }catch(\Exception $exception){
            return $response->withJson([
                'errors' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }

    }
}