<?php

namespace Babilonia\Shared\Validators;

use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;

class EmailValidator extends Validator
{
    private $email;

    public function __construct(?string $email)
    {
        $this->email = $email;
    }


    protected function validate():void
    {
        if (is_null($this->email)){
            throw new MissingFieldException('email');
        }

        if (empty($this->email)){
            $this->addError(Errors::EMPTY_EMAIL);
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->addError(Errors::INVALID_EMAIL);
        }
    }
}