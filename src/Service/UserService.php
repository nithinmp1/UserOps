<?php

namespace App\Service;

use Slim\App;
use App\Repository\UserRepository;
use App\Service\LoggerService;

class UserService
{
    protected $app;
    private $userRepository;
    private $logger;

    public function __construct(
        UserRepository $userRepository,
        LoggerService $logger
    ) {
        $this->userRepository = $userRepository;
        $this->logger = $logger;
    }

    function getUser() {
        die('getUser');
        
    }

    function updateUser() {
        die('updateUser');
        
    }

    function deleteUser() {
        die('deleteUser');
        
    }

    function getUsers() {
        $this->logger->info('Info message from UserService.');
        $allData = $this->userRepository->findAll();
        var_dump($allData);
        die('getUsers');
        
    }
}
