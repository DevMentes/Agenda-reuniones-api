<?php

namespace Babilonia\Context\Search\Domain\User;

interface UserRepository
{
    public function filter(string $query);
}