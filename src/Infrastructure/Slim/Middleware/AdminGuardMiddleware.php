<?php

namespace Babilonia\Infrastructure\Slim\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class AdminGuardMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $userData = $request->getAttribute('user');

        if($userData->type !== 'Admin') {

            echo json_encode(['errors' => 'Denied access, insufficient permissions']);
            http_response_code(401);
            exit();
        }

        $requestWithValidation = $request->withAttribute('isAdmin', true);

        $response = $next($requestWithValidation, $response);

        return $response;
    }
}