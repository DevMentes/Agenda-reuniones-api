<?php

namespace Babilonia\Shared\Validators;

use DateTime;
use Babilonia\Shared\Errors\Errors;
use Babilonia\Shared\Errors\MissingFieldException;

class TimeEntriesValidator extends Validator
{
    private $startAt;

    private $finishAt;

    public function __construct(?string $startAt, ?string $finishAt)
    {
        $this->startAt = $startAt;
        $this->finishAt = $finishAt;
    }

    protected function validate(): void
    {
        $this->validateStartAt($this->startAt);
        $this->validateFinishAt($this->finishAt);
        $this->validateTimesOrders($this->startAt, $this->finishAt);
    }

    private function validateStartAt(?string $startAt):void
    {
        if (is_null($startAt)){
            throw new MissingFieldException('startAt');
        }

        if (empty($startAt)){
            $this->addError(Errors::EMPTY_START_AT);
        }

        if (!$this->validateTimeFormat($startAt)){
            $this->addError(Errors::INVALID_START_AT_FORMAT);
        }
    }

    private function validateFinishAt(?string $finishAt):void
    {
        if (is_null($finishAt)){
            throw new MissingFieldException('finishAt');
        }

        if (empty($finishAt)){
            $this->addError(Errors::EMPTY_FINISH_AT);
        }

        if (!$this->validateTimeFormat($finishAt)){
            $this->addError(Errors::INVALID_FINISH_AT_FORMAT);
        }
    }

    private function validateTimeFormat(string $time, $format = 'H:i'):bool
    {
        $d = DateTime::createFromFormat($format, $time);
        return $d && $d->format($format) === $time;
    }

    private function validateTimesOrders(string $startAt, string $finishAt):void
    {
        if (strtotime($startAt) >= strtotime($finishAt)){
            $this->addError(Errors::INVALID_TIMES);
        }
    }
}