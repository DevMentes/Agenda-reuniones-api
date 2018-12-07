<?php

namespace Babilonia\Context\Account\Application\Validations;

use Babilonia\Shared\Validators\NameValidator;
use Babilonia\Shared\Validators\EmailValidator;
use Babilonia\Shared\Errors\MissingFieldException;
use Babilonia\Shared\Validators\PasswordValidator;
use Babilonia\Shared\Validators\SurnamesValidator;
use Babilonia\Context\Account\Application\Services\RegisterUser\RegisterUserRequest;

class RegisterUserValidator
{
    private $errors = array();

    public function validate(RegisterUserRequest $request):array
    {
        try {
            $this->validateName($request->name());
            $this->validateSurnames($request->surnames());
            $this->validateEmail($request->email());
            $this->validatePassword($request->password());
        } catch (MissingFieldException $e) {
            throw $e;
        }
        return $this->errors;

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

        if ($emailValidator->hasErrors())
        {
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