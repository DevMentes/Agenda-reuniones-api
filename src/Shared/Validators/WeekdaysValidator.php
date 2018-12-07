<?php

namespace Babilonia\Shared\Validators;

use Babilonia\Context\Agenda\Domain\Agenda\Weekdays;
use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;

class WeekdaysValidator extends Validator
{

    private $weekdays;

    public function __construct(array $weekdays)
    {
        $this->weekdays = $weekdays;
    }

    protected function validate(): void
    {
        foreach ($this->weekdays as $weekday){

            if (is_null($weekday)){
                throw new MissingFieldException('weekday');
            }

            if (empty($this->weekdays)){
                $this->addError(Errors::EMPTY_WEEKDAYS_FIELD);
            }

            if (
                $weekday !== Weekdays::MONDAY &&
                $weekday !== Weekdays::TUESDAY &&
                $weekday !== Weekdays::WEDNESDAY &&
                $weekday !== Weekdays::THURSDAY &&
                $weekday !== Weekdays::FRIDAY &&
                $weekday !== Weekdays::SUNDAY &&
                $weekday !== Weekdays::SATURDAY
            ){
                $this->addError(Errors::INVALID_WEEKDAYS);
            }

        }
    }
}