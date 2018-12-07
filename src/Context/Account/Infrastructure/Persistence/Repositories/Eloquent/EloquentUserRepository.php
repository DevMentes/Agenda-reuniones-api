<?php

namespace Babilonia\Context\Account\Infrastructure\Persistence\Repositories\Eloquent;

use Babilonia\Context\Account\Domain\User\User;
use Babilonia\Context\Account\Domain\User\UserRepository;
use Babilonia\Context\Account\Domain\User\AuthenticatedUser;
use Babilonia\Context\Account\Infrastructure\Persistence\Factories\UserFactory;
use Babilonia\Context\Account\Infrastructure\Persistence\Models\Eloquent\EloquentUser;
use Babilonia\Context\Account\Infrastructure\Persistence\Exceptions\EmailNotFoundException;
use Babilonia\Context\Account\Infrastructure\Persistence\Exceptions\EmailAlreadyExistException;
use Babilonia\Context\Account\Infrastructure\Persistence\Exceptions\InvalidCredentialsException;

class EloquentUserRepository implements UserRepository
{
    private $userFactory;

    public function __construct()
    {
        $this->userFactory = new UserFactory();
    }

    public function register(User $user): void
    {
        $userExist = EloquentUser::where('email', $user->email())->exists();

        if ($userExist){
            throw new EmailAlreadyExistException();
        }

        $eloquentUser = $this->userFactory->makeNewEloquentUser($user);

        $eloquentUser->save();
    }

    public function authenticate(string $email, string $password):AuthenticatedUser
    {
        $eloquentUser = EloquentUser::where('email', $email)->first();

        if ($eloquentUser === null){
            throw new EmailNotFoundException();
        }

        if (!password_verify($password, $eloquentUser->password)){
            throw new InvalidCredentialsException();
        }

        return $this->userFactory->makeAuthenticatedUser($eloquentUser);
    }
}