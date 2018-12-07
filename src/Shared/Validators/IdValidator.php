<?php

namespace Babilonia\Shared\Validators;

use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;

class IdValidator extends Validator
{

    private $id;

    public function __construct(?string  $id)
    {
        $this->id = $id;
    }

    protected function validate(): void
    {
        if (is_null($this->id)){
            throw new MissingFieldException('id');
        }

        if (empty($this->id)){
            $this->addError(Errors::NULL_USER_ID);
        }
    }
}