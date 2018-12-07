<?php

namespace Babilonia\Shared\Validators;

use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;

class PasswordValidator extends Validator
{

    private $password;

    public function __construct(?string $password)
    {
        $this->password = $password;
    }

    protected function validate(): void
    {
        if (is_null($this->password)){
            throw new MissingFieldException('password');
        }

        if (empty($this->password)){
            $this->addError(Errors::EMPTY_PASSWORD);
        }

        if (strlen($this->password) < 8){
            $this->addError(Errors::INVALID_PASSWORD_LENGTH);
        }
    }
}