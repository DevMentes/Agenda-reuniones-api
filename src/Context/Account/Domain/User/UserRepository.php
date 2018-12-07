<?php

namespace Babilonia\Context\Account\Domain\User;

interface UserRepository
{
    public function register(User $user):void;

    public function authenticate(string $email, string $password):AuthenticatedUser;
}