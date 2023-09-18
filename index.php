<?php

require 'vendor/autoload.php';

use App\Controller\ErrorController;
use FastRoute\Dispatcher;
use GuzzleHttp\Psr7\ServerRequest;

$dispatcher = FastRoute\simpleDispatcher(require 'src/config/routes.php');

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

$errorController = new ErrorController();

try {
    switch ($routeInfo[0]) {
        case Dispatcher::NOT_FOUND:
            // ... 404 Not Found
            throw new \Exception('404 Not Found');
        case Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            // ... 405 Method Not Allowed
            throw new \Exception('405 Method Not Allowed');
        case Dispatcher::FOUND:
            $handler = $routeInfo[1];
            $vars = $routeInfo[2];
            $request = ServerRequest::fromGlobals();
            foreach ($vars as $key => $value) {
                $request = $request->withAttribute($key, $value);
            }
            $response = $handler($request);
            echo $response->getBody();
            break;
    }
} catch (\Exception $e) {
    $response = $errorController->handleException($e);
    echo $response->getBody();
}
