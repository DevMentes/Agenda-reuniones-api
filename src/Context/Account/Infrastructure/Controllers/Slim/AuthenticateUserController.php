<?php

namespace Babilonia\Context\Account\Infrastructure\Controllers\Slim;

use Slim\Http\Request;
use Slim\Http\Response;
use Babilonia\Infrastructure\Slim\Controller\Controller;
use Babilonia\Context\Account\Application\Validations\AuthenticationValidator;
use Babilonia\Context\Account\Application\Services\Authenticate\AuthenticationRequest;
use Babilonia\Context\Account\Application\Services\Authenticate\AuthenticationService;
use Babilonia\Context\Account\Infrastructure\Persistence\Exceptions\EmailNotFoundException;
use Babilonia\Context\Account\Infrastructure\Persistence\Exceptions\InvalidCredentialsException;
use Babilonia\Context\Account\Infrastructure\Persistence\Repositories\Eloquent\EloquentUserRepository;

class AuthenticateUserController extends Controller
{
    public function authenticate(Request $request, Response $response)
    {
        $input = $request->getParsedBody();

        $authenticationRequest = new AuthenticationRequest(
            $input['email'],
            $input['password']
        );

        $validator = new AuthenticationValidator();

        $errors = $validator->validate($authenticationRequest);

        if (!empty($errors)){
            return $response->withJson(['errors' => $errors], 400);
        }

        $service = new AuthenticationService(
            new EloquentUserRepository()
        );

        try{
            $authenticatedUser = $service->execute($authenticationRequest);

            return $response->withJson([
                'data' => [
                    'id' => $authenticatedUser->id(),
                    'name' => $authenticatedUser->name(),
                    'surnames' => $authenticatedUser->surnames(),
                    'email' => $authenticatedUser->email(),
                    'type' => $authenticatedUser->type()
                ]
            ], 200);

        }catch(EmailNotFoundException $exception){
            return $response->withJson([
                'errors' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }catch(InvalidCredentialsException $exception){
            return $response->withJson([
                'errors' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }
}