<?php

namespace Babilonia\Context\Search\Application\SearchUser;

class SearchUserRequest
{
    private $query;

    public function __construct(string $query)
    {
        $this->query = $query;
    }

    public function query():string
    {
        return $this->query;
    }
}