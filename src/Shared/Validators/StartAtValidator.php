<?php

namespace Babilonia\Shared\Validators;

use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;

class StartAtValidator extends Validator
{

    private $startAt;

    public function __construct(?string $startAt)
    {
        $this->startAt = $startAt;
    }

    protected function validate(): void
    {
        if (is_null($this->startAt)){
            throw new MissingFieldException('startAt');
        }

        if (empty($this->startAt)){
            $this->addError(Errors::EMPTY_START_AT);
        }

        if (!$this->validateTimeFormat($startAt)){
            $this->errors [] = Errors::INVALID_START_AT_FORMAT;
        }
    }
}