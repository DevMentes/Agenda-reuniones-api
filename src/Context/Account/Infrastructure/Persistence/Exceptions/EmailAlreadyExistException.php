<?php

namespace Babilonia\Context\Account\Infrastructure\Persistence\Exceptions;

use Babilonia\Shared\Errors\Errors;

class EmailAlreadyExistException extends \Exception
{
    public function __construct()
    {
        parent::__construct(Errors::EMAIL_ALREADY_IN_USE['message'], Errors::EMAIL_ALREADY_IN_USE['code']);
    }
}