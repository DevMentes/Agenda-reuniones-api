<?php

namespace Babilonia\Shared\Validators;

use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;

class SurnamesValidator extends Validator
{

    private $surnames;

    public function __construct(?string $surnames)
    {
        $this->surnames = $surnames;
    }

    protected function validate(): void
    {
        if (is_null($this->surnames)){
            throw new MissingFieldException('surnames');
        }

        if (empty($this->surnames)){
            $this->addError(Errors::EMPTY_SURNAMES);
        }
    }
}