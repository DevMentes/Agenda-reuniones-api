<?php

use Babilonia\Infrastructure\Slim\Middleware\AdminGuardMiddleware;
use Babilonia\Infrastructure\Slim\Middleware\TokenGeneratorMiddleware;
use Babilonia\Infrastructure\Slim\Middleware\TokenValidationMiddleware;


$app->get('/', function(){
	echo "Api de Agenda Ciisa";
});

$app->group('/admin', function (){

    $this->group('/users', function (){

        $this->post('/register', 'AdminRegisterNewUserController:register');
    });
})->add(new AdminGuardMiddleware())->add(new TokenValidationMiddleware());



$app->post('/signin', 'AuthenticateUserController:authenticate')->add(new TokenGeneratorMiddleware);

$app->get('/users/search/{search}', 'SearchUserController:byEmail')
    ->add(new TokenValidationMiddleware);

$app->post('/agenda/availability/verify', 'VerifyAvailabilitiesController:forUsers');

$app->post('/agenda/schedule', 'ScheduleMeetingController:schedule')
->add(new TokenValidationMiddleware);

$app->post('/agenda/restricts', 'RestrictsTimeController:byBlock')
    ->add(new TokenValidationMiddleware);

$app->get('/agenda/get', 'GetMonthlyAgendaController:get')->add(new TokenValidationMiddleware());


