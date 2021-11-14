<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

//$a = new \app\lib\Services\AnswerUsers\AnswerUsersServices();
//$a->getResultTest();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$responseFactory = new Laminas\Diactoros\ResponseFactory();

$strategy = new League\Route\Strategy\JsonStrategy($responseFactory);
$router = (new League\Route\Router)->setStrategy($strategy);

$router->map('GET', '/question', '\app\api\v1\Survey::getQuestion');
$router->map('GET', '/result-test', '\app\api\v1\Survey::getResultTest');
$router->map('POST', '/save-user', '\app\api\v1\Survey::saveUser');
$router->map('POST', '/save-test', '\app\api\v1\Survey::saveTest');

/** @var Laminas\Diactoros\Response $response */

$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);
