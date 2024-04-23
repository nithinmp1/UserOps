<?php

require __DIR__ . '/vendor/autoload.php';
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

use Slim\App;
use App\Service\UserService;
// Create Slim app instance
try {
    $app = new App();

    // Include dependencies
    require __DIR__ . '/dependencies.php';

    // Include routes
    $routes = require __DIR__ . '/src/Config/routes.php';

    foreach ($routes as $routePath => $routeConfig) {
        foreach ($routeConfig as $method => $handlerConfig) {
            $serviceName = $handlerConfig['service_name'];
            $methodName = $handlerConfig['method_name'];

            switch ($method) {
                case 'GET':
                    $app->get($routePath, function ($request, $response, $args) use ($app, $serviceName, $methodName) {
                        $service = $app->getContainer()->get($serviceName);
                        return $service->$methodName($request, $response, $args);
                    });
                    break;

                case 'POST':
                    $app->post($routePath, function ($request, $response, $args) use ($app, $serviceName, $methodName) {
                        $service = $app->getContainer()->get($serviceName);
                        return $service->$methodName($request, $response, $args);
                    });
                    break;

                case 'PUT':
                    $app->put($routePath, function ($request, $response, $args) use ($app, $serviceName, $methodName) {
                        $service = $app->getContainer()->get($serviceName);
                        return $service->$methodName($request, $response, $args);
                    });
                    break;

                case 'DELETE':
                    $app->delete($routePath, function ($request, $response, $args) use ($app, $serviceName, $methodName) {
                        $service = $app->getContainer()->get($serviceName);
                        return $service->$methodName($request, $response, $args);
                    });
                    break;

                // Add more cases for other HTTP methods as needed (e.g., PATCH, OPTIONS, etc.)
            }
        }
    }

    $app->run();
} catch (Exception $e) {
    die('index');
    var_dump($e);
    // Code to handle the exception
    echo "Caught exception: " . $e->getMessage();
}