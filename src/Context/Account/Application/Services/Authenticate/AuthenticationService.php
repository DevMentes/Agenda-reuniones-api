<?php

namespace Babilonia\Context\Account\Application\Services\Authenticate;

use Babilonia\Context\Account\Domain\User\UserRepository;

class AuthenticationService
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function execute(AuthenticationRequest $request)
    {
        return $this->userRepository->authenticate($request->email(), $request->password());
    }
}