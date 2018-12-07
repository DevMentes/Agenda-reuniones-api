<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Infrastructure/Slim/bootstrap/app.php';


header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$app->run();