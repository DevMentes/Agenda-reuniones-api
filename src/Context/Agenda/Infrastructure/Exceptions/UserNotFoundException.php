<?php

namespace Babilonia\Context\Agenda\Infrastructure\Exceptions;

use Babilonia\Shared\Errors\Errors;

class UserNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct(Errors::USER_NOT_FOUND['message'], Errors::USER_NOT_FOUND['code']);
    }
}