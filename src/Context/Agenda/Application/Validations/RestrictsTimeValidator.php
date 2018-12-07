<?php

namespace Babilonia\Context\Agenda\Application\Validations;

use Babilonia\Shared\Errors\MissingFieldException;
use Babilonia\Shared\Validators\WeekdaysValidator;
use Babilonia\Shared\Validators\TimeEntriesValidator;
use Babilonia\Context\Agenda\Application\Services\RestrictsTimes\RestrictsTimeRequest;

class RestrictsTimeValidator
{
    private $errors = array();

    public function validate(RestrictsTimeRequest $request):array
    {
        try {
            $this->validateWeekdays($request->weekdays());
            $this->validateTimeEntries($request->startAt(), $request->finishAt());
        } catch (MissingFieldException $exception) {
            throw $exception;
        }

        return $this->errors;
    }


    private function validateWeekdays(array $weekdays)
    {
        $weekdaysValidator = new WeekdaysValidator($weekdays);
        if ($weekdaysValidator->hasErrors()){
            $this->errors [] = $weekdaysValidator->errors();
        }
    }


    private function validateTimeEntries(?string $startAt, ?string $finishAt):void
    {
        $timeEntriesValidator = new TimeEntriesValidator($startAt, $finishAt);
        if ($timeEntriesValidator->hasErrors()){
            $this->errors [] = $timeEntriesValidator->errors();
        }
    }
}