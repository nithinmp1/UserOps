<?php

use Slim\App;

/*
return [
    'hello/{name}' => ['http' => 'get', 'service_name' => 'YourService', 'method_name' => 'hello'],
    'hello' => ['http' => 'get', 'service_name' => 'YourService', 'method_name' => 'hello'],
    'hello' => ['http' => 'post', 'service_name' => 'YourService', 'method_name' => 'hello'],
];
*/

return [
    '/hello' => [
        'GET' => ['service_name' => 'YourService', 'method_name' => 'getHello'],
        'POST' => ['service_name' => 'YourService', 'method_name' => 'postHello'],
    ],
    '/user/{id}' => [
        'GET' => ['service_name' => 'userService', 'method_name' => 'getUser'],
        'PUT' => ['service_name' => 'userService', 'method_name' => 'updateUser'],
        'DELETE' => ['service_name' => 'userService', 'method_name' => 'deleteUser'],
    ],
    '/users' => [
        'GET' => ['service_name' => 'userService', 'method_name' => 'getUsers'],
    ],
    // Add more routes as needed...
];

