<?php

namespace Babilonia\Context\Account\Infrastructure\Controllers\Slim;

use Slim\Http\Request;
use Slim\Http\Response;
use Babilonia\Infrastructure\Uuid\UuidGenerator;
use Babilonia\Shared\Errors\MissingFieldException;
use Babilonia\Infrastructure\Slim\Controller\Controller;
use Babilonia\Context\Account\Application\Validations\RegisterUserValidator;
use Babilonia\Context\Account\Application\Services\RegisterUser\RegisterUserRequest;
use Babilonia\Context\Account\Application\Services\RegisterUser\RegisterUserService;
use Babilonia\Context\Account\Infrastructure\Persistence\Exceptions\EmailAlreadyExistException;
use Babilonia\Context\Account\Infrastructure\Persistence\Repositories\Eloquent\EloquentUserRepository;

class AdminRegisterNewUserController extends Controller
{
    public function register(Request $request, Response $response)
    {
        $input = $request->getParsedBody();

        $registerUserRequest = new RegisterUserRequest(
            UuidGenerator::generate(),
            $input['name'],
            $input['surnames'],
            $input['email'],
            $input['password']
        );

        $validator = new RegisterUserValidator();

        try {
            $errors = $validator->validate($registerUserRequest);

        } catch (MissingFieldException $exception) {
            return $response->withJson([
                'errors' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ],400);
        }

        if (!empty($errors)){
            return $response->withJson(['errors' => $errors], 400);
        }

        $service = new RegisterUserService(
            new EloquentUserRepository()
        );

        try{

            $service->execute($registerUserRequest);

            return $response
                ->withJson(
                    [
                        'success' => [
                            'message' => 'user was successfully registered.'
                        ]
                    ],
                    200
                );

        }catch(EmailAlreadyExistException $exception){

            return $response->withJson([
                'errors' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }
}