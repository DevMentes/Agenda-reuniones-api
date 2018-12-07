<?php

namespace Babilonia\Shared\Errors;

class MissingFieldException extends \Exception
{
    public function __construct(string $field)
    {
        parent::__construct($field . ' is missing.', 0);
    }
}