<?php

namespace Babilonia\Shared\Validators;

use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;

class NameValidator extends Validator
{
    private $name;

    public function __construct(?string $name)
    {
        $this->name = $name;
    }


    protected function validate(): void
    {
        if (is_null($this->name)){
            throw new MissingFieldException('name');
        }

        if (empty($this->name)){
            $this->addError(Errors::NULL_NAME_FIELD);
        }
    }
}