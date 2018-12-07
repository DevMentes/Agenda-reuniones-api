<?php

namespace Babilonia\Context\Account\Application\Services\RegisterUser;

use Babilonia\Context\Account\Domain\User\User;
use Babilonia\Context\Account\Domain\User\UserRepository;

class RegisterUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(RegisterUserRequest $request)
    {
        $user = new User(
            $request->id(),
            $request->name(),
            $request->surnames(),
            $request->email(),
            $request->password()
        );

        $this->userRepository->register($user);

    }
}