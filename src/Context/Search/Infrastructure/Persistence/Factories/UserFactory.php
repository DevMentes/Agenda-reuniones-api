<?php

namespace Babilonia\Context\Search\Infrastructure\Persistence\Factories;

use Babilonia\Context\Search\Domain\User\PublicUser;
use Babilonia\Context\Search\Infrastructure\Persistence\Models\Eloquent\EloquentUser;

class UserFactory
{
    public function makePublicUser(EloquentUser $eloquentUser):PublicUser
    {
        return new PublicUser(
            $eloquentUser->id,
            $eloquentUser->name,
            $eloquentUser->surnames,
            $eloquentUser->email
        );
    }
}