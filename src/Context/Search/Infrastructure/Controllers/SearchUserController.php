<?php

namespace Babilonia\Context\Search\Infrastructure\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Babilonia\Infrastructure\Slim\Controller\Controller;
use Babilonia\Context\Search\Application\SearchUser\SearchUserRequest;
use Babilonia\Context\Search\Application\SearchUser\SearchUserService;
use Babilonia\Context\Search\Infrastructure\Persistence\Repositories\Eloquent\EloquentUserRepository;

class SearchUserController extends Controller
{
    public function byEmail(Request $request, Response $response, $args)
    {
        $search = $args['search'];

        if (empty($search)){
            return $response->withJson(['data' => []],200);
        }

        $searchUserService = new SearchUserService(
            new EloquentUserRepository()
        );

        $publicUsers = $searchUserService->execute(new SearchUserRequest($search));

        $users = array();

        foreach ($publicUsers as $publicUser){
            $users [] = [
                'id' => $publicUser->id(),
                'name' => $publicUser->name(),
                'surnames' => $publicUser->surnames(),
                'email' => $publicUser->email()
            ];
        }

        return $response->withJson([
            'data' => $users
        ], 200);
    }
}