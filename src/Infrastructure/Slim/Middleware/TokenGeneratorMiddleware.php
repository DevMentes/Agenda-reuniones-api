<?php

namespace Babilonia\Infrastructure\Slim\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use Babilonia\Infrastructure\JWT\TokenGenerator;

class TokenGeneratorMiddleware
{

    public function __invoke(Request $request, Response $response, $next)
    {
        $response = $next($request, $response);
        $result = json_decode($response->getBody());

        if(isset($result->errors)){
            return $response;
        }

        $response->withJson([
            'data' => TokenGenerator::generate($result->data)
        ]);

        return $response;
    }
}