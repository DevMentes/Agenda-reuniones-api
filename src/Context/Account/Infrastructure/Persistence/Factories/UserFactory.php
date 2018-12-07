<?php

namespace Babilonia\Context\Account\Infrastructure\Persistence\Factories;

use Babilonia\Context\Account\Domain\User\User;
use Babilonia\Context\Account\Domain\User\AuthenticatedUser;
use Babilonia\Context\Account\Infrastructure\Persistence\Models\Eloquent\EloquentUser;

class UserFactory
{
    private $adminCode = 1;

    private $userCode = 0;

    private $adminType = 'Admin';

    private $userType = 'PublicUser';

    public function makeNewEloquentUser(User $user):EloquentUser
    {
        $eloquentUser = new EloquentUser();

        $eloquentUser->id = $user->id();
        $eloquentUser->name = $user->name();
        $eloquentUser->surnames = $user->surnames();
        $eloquentUser->email = $user->email();
        $eloquentUser->password = password_hash($user->password(), PASSWORD_BCRYPT);

        return $eloquentUser;
    }

    public function makeAuthenticatedUser(EloquentUser $eloquentUser):AuthenticatedUser
    {

        return new AuthenticatedUser(
            $eloquentUser->id,
            $eloquentUser->name,
            $eloquentUser->surnames,
            $eloquentUser->email,
            $this->resolveUserType($eloquentUser->type)
        );
    }

    private function resolveUserType(int $typeCode):string
    {
        if ($typeCode === $this->adminCode){
            return $this->adminType;
        }

        return $this->userType;
    }
}