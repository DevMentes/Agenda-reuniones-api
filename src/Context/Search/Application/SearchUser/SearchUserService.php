<?php

namespace Babilonia\Context\Search\Application\SearchUser;

use Babilonia\Context\Search\Domain\User\UserRepository;

class SearchUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(SearchUserRequest $request)
    {
        return $this->userRepository->filter($request->query());
    }
}