<?php

namespace App\Service;

use Slim\App;
use App\Repository\UserRepository;
use App\Service\ResponseBuilder;
use App\Service\LoggerService;
use App\Exception\Exception;
use App\Exception\CustomException;

class UserService
{
    protected $app;
    private $userRepository;
    private $responseBuilder;
    private $logger;

    public function __construct(
        UserRepository $userRepository,
        ResponseBuilder $responseBuilder,
        $config,
        LoggerService $logger
    ) {
        $this->userRepository = $userRepository;
        $this->responseBuilder = $responseBuilder;
        $this->config = $config;
        $this->logger = $logger;
    }

    function welcome($request, $response, $args) {
        try {
            $data = [
                'message' => 'Welcome to '.$this->config['app'].' version '.$this->config['version'] ,
                'status' => 'success'
            ];
            $responseData = $this->responseBuilder->create($data);

            $response = $response->withStatus(200); 

            return $response->withJson($responseData);
        } catch (Exception $e) {
            $customException = new CustomException($e->getMessage());
            $customException->sendEmailToAdmin();
            $data = [
                'message' => $e->getMessage() ,
                'status' => 'failure'
            ];
            $responseData = $this->responseBuilder->create($data);

            $response = $response->withStatus(200); 
            return $response->withJson($responseData);
        }
    }
    
    function postUser($request, $response, $args) {

        try {
            $data = $request->getParsedBody();
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) ) {
                throw new \InvalidArgumentException('Invalid email format');
            }

            $existingUser = $this->userRepository->findOneBy(['email' => $data['email']]);
            if ($existingUser) {
                throw new \InvalidArgumentException('Email already exists');
            }

            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $data['hashedPassword'] = $hashedPassword; 
            $this->userRepository->insert($data);

            $data = [
                'message' => 'user added',
                'status' => 'sucess'
            ];
            $responseData = $this->responseBuilder->create($data);

            $response = $response->withStatus(200); 
            return $response->withJson($responseData);
        } catch (\InvalidArgumentException $e) {
            $data = [
                'message' => $e->getMessage() ,
                'status' => 'failure'
            ];
            $responseData = $this->responseBuilder->create($data);

            $response = $response->withStatus(200); 
            return $response->withJson($responseData);
        } catch (Exception $e) {
            $customException = new CustomException($e->getMessage());
            $customException->sendEmailToAdmin();
            $data = [
                'message' => $e->getMessage() ,
                'status' => 'failure'
            ];
            $responseData = $this->responseBuilder->create($data);

            $response = $response->withStatus(200); 
            return $response->withJson($responseData);
        }

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
