<?php

namespace Babilonia\Shared\Validators;

use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;
use DateTime;

class DateValidator extends Validator
{
    private $date;

    public function __construct(?string $date)
    {
        $this->date = $date;
    }

    protected function validate(): void
    {
        if (is_null($this->date)){
            throw new MissingFieldException('date');
        }

        if (empty($this->date)){
            $this->addError(Errors::EMPTY_DATE);
        }

        if (!$this->dateFormatIsValid($this->date)){
            $this->addError(Errors::INVALID_DATE_FORMAT);
        }
    }

    private function dateFormatIsValid(string $date, $format = 'Y-m-d'):bool
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}