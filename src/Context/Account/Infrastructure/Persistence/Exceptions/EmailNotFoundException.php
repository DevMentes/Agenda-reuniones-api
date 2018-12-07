<?php

namespace Babilonia\Context\Account\Infrastructure\Persistence\Exceptions;

use Babilonia\Shared\Errors\Errors;

class EmailNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct(Errors::UNKNOWN_EMAIL['message'], Errors::UNKNOWN_EMAIL['code']);
    }
}