<?php

namespace App\Service;

use Slim\App;

class YourService
{
    protected $app;

    public function __construct()
    {
        // $this->app = $app;
    }

    public function getHello($request, $response, $args)
    {
        die('hit');
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    }

    public function postHello($request, $response, $args)
    {
        die('hit');
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    }

    function getUser() {
        die('hit');
        
    }

    function updateUser() {
        die('hit');
        
    }

    function deleteUser() {
        die('hit');
        
    }

    function getUsers() {
        die('hit');
        
    }
}
