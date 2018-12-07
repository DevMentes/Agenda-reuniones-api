<?php

namespace Babilonia\Context\Account\Infrastructure\Persistence\Exceptions;

use Babilonia\Shared\Errors\Errors;

class InvalidCredentialsException extends \Exception
{
    public function __construct()
    {
        parent::__construct(Errors::INVALID_CREDENTIALS['message'], Errors::INVALID_CREDENTIALS['code']);
    }
}