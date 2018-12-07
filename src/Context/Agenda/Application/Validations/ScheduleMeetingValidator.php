<?php

namespace Babilonia\Context\Agenda\Application\Validations;

use Babilonia\Shared\Validators\IdValidator;
use Babilonia\Shared\Validators\DateValidator;
use Babilonia\Shared\Validators\NameValidator;
use Babilonia\Shared\Validators\EmailValidator;
use Babilonia\Shared\Validators\SurnamesValidator;
use Babilonia\Shared\Errors\MissingFieldException;
use Babilonia\Shared\Validators\TimeEntriesValidator;
use Babilonia\Context\Agenda\Application\Services\ScheduleMeeting\ScheduleMeetingRequest;

class ScheduleMeetingValidator
{
    private $errors = array();

    public function validate(ScheduleMeetingRequest $request):array
    {
        try {
            $this->validatePublicUsers($request->guestUsers());
            $this->validateDate($request->date());
            $this->validateTimeEntries($request->startAt(), $request->finishAt());
        } catch (MissingFieldException $exception) {
            throw $exception;
        }

        return $this->errors;
    }

    private function validatePublicUsers(?array $publicUsers):void
    {
        for ($i = 0; $i < count($publicUsers); $i++){
            try{
                $this->validateId($publicUsers[$i]['id']);
                $this->validateName($publicUsers[$i]['name']);
                $this->validateSurnames($publicUsers[$i]['surnames']);
                $this->validateEmail($publicUsers[$i]['email']);
            }catch (MissingFieldException $exception){
                throw $exception;
            }
        }
    }

    private function validateId(?string $id):void
    {
        $idValidator = new IdValidator($id);
        if ($idValidator->hasErrors()){
            $this->errors = $idValidator->errors();
        }
    }

    private function validateName(?string $name):void
    {
        $nameValidator = new NameValidator($name);
        if ($nameValidator->hasErrors()){
            $this->errors = $nameValidator->errors();
        }
    }

    private function validateSurnames(?string $surnames):void
    {
        $surnamesValidator = new SurnamesValidator($surnames);
        if ($surnamesValidator->hasErrors()){
            $this->errors = $surnamesValidator->errors();
        }
    }

    private function validateEmail(?string $email):void
    {
        $emailValidator = new EmailValidator($email);
        if ($emailValidator->hasErrors()){
            $this->errors = $emailValidator->errors();
        }
    }

    private function validateDate(?string $date):void
    {
        $dateValidator = new DateValidator($date);
        if ($dateValidator->hasErrors()){
            $this->errors = $dateValidator->errors();
        }
    }

    private function validateTimeEntries(?string $startAt, ?string $finishAt):void
    {
        $timeEntriesValidator = new TimeEntriesValidator($startAt, $finishAt);
        if ($timeEntriesValidator->hasErrors()){
            $this->errors = $timeEntriesValidator->errors();
        }
    }
}