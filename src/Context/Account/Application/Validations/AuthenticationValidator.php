<?php

namespace Babilonia\Context\Account\Application\Validations;

use Babilonia\Shared\Validators\EmailValidator;
use Babilonia\Shared\Errors\MissingFieldException;
use Babilonia\Shared\Validators\PasswordValidator;
use Babilonia\Context\Account\Application\Services\Authenticate\AuthenticationRequest;

class AuthenticationValidator
{
    private $errors = array();

    public function validate(AuthenticationRequest $request):array
    {
        try {
            $this->validateEmail($request->email());
            $this->validatePassword($request->password());
        } catch (MissingFieldException $exception) {
            throw $exception;
        }

        return $this->errors;
    }

    private function validateEmail(?string $email):void
    {
        $emailValidator = new EmailValidator($email);
        if ($emailValidator->hasErrors()){
            $this->errors = $emailValidator->errors();
        }
    }

    private function validatePassword(?string $password):void
    {
        $passwordValidator = new PasswordValidator($password);
        if ($passwordValidator->hasErrors()){
            $this->errors = $passwordValidator->errors();
        }
    }
}