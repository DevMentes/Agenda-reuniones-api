<?php

namespace Babilonia\Context\Search\Infrastructure\Persistence\Repositories\Eloquent;

use Babilonia\Context\Search\Domain\User\UserRepository;
use Babilonia\Context\Search\Infrastructure\Persistence\Factories\UserFactory;
use Babilonia\Context\Search\Infrastructure\Persistence\Models\Eloquent\EloquentUser;

class EloquentUserRepository implements UserRepository
{
    private $userFactory;

    public function __construct()
    {
        $this->userFactory = new UserFactory();
    }

    public function filter(string $query)
    {
        $eloquentUsers = EloquentUser::where('email', 'like', '%' . $query . '%')->get();

        $users = array();

        foreach ($eloquentUsers as $eloquentUser){
            $users[] = $this->userFactory->makePublicUser($eloquentUser);
        }

        return $users;
    }
}