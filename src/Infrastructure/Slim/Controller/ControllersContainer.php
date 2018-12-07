<?php

use Babilonia\Context\Agenda\Infrastructure\Controllers\GetMonthlyAgendaController;
use Babilonia\Context\Search\Infrastructure\Controllers\SearchUserController;
use Babilonia\Context\Agenda\Infrastructure\Controllers\RestrictsTimeController;
use Babilonia\Context\Agenda\Infrastructure\Controllers\ScheduleMeetingController;
use Babilonia\Context\Agenda\Infrastructure\Controllers\VerifyAvailabilitiesController;
use Babilonia\Context\Account\Infrastructure\Controllers\Slim\AuthenticateUserController;
use Babilonia\Context\Account\Infrastructure\Controllers\Slim\AdminRegisterNewUserController;


$container['AdminRegisterNewUserController'] = function ($container){
    return new AdminRegisterNewUserController($container);
};

$container['AuthenticateUserController'] = function ($container){
    return new AuthenticateUserController($container);
};

$container['SearchUserController'] = function ($container){
    return new SearchUserController($container);
};

$container['ScheduleMeetingController'] = function ($container){
    return new ScheduleMeetingController($container);
};

$container['VerifyAvailabilitiesController'] = function ($container){
    return new VerifyAvailabilitiesController($container);
};

$container['RestrictsTimeController'] = function ($container){
    return new RestrictsTimeController($container);
};

$container['GetMonthlyAgendaController'] = function ($container){
    return new GetMonthlyAgendaController($container);
};