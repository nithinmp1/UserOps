<?php

use Slim\App;

return [
    '/' => [
        'GET' => ['service_name' => 'userService', 'method_name' => 'welcome'],
    ],
    '/user/{id}' => [
        'GET' => ['service_name' => 'userService', 'method_name' => 'getUser'],
        'PUT' => ['service_name' => 'userService', 'method_name' => 'updateUser'],
        'DELETE' => ['service_name' => 'userService', 'method_name' => 'deleteUser'],
    ],
    '/users' => [
        'GET' => ['service_name' => 'userService', 'method_name' => 'getUsers'],
    ],
    '/user' => [
        'POST' => ['service_name' => 'userService', 'method_name' => 'postUser'],
    ],
];

