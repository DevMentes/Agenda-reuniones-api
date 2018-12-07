<?php

namespace Babilonia\Shared\Validators;

abstract class Validator
{
    protected $errors = array();

    public function addError(array $error)
    {
        $this->errors [] = $error;
    }

    public function hasErrors():bool
    {
        $this->validate();

        return !empty($this->errors);
    }

    public function errors():array
    {
        return $this->errors;
    }

    protected abstract function validate():void;
}