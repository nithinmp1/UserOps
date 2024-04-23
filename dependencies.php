<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use App\Entity\User;
use App\Service\UserService;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;
use Symfony\Component\Yaml\Yaml;
use App\Service\LoggerService;
use App\Service\ResponseBuilder;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

$rdbmsData = Yaml::parseFile(__DIR__ . '/src/config/rdbms.yaml');
$config = Yaml::parseFile(__DIR__ . '/src/config/config.yaml');

// Create ORM setup
$setup = ORMSetup::createAnnotationMetadataConfiguration([__DIR__ . '/src/Entity'], true);

// Create entity manager
$entityManager = EntityManager::create($rdbmsData['rdbms'], $setup);

// Retrieve container
$container = $app->getContainer();

$container['config'] = function (ContainerInterface $container) use ($config) {
    return $config;
};

$container['filesystem'] = function (ContainerInterface $container) use ($config){
    $filesystemConfig = $config['filesystem'];

    $adapterType = $filesystemConfig['adapter'];
    $adapterConfig = $filesystemConfig['adapter_config'];

    $adapter = new League\Flysystem\Local\LocalFilesystemAdapter(__DIR__.$adapterConfig['root']);
    return $filesystem = new League\Flysystem\Filesystem($adapter);
};

// Define services
$container['entityManager'] = function (ContainerInterface $container) use ($entityManager) {
    return $entityManager;
};


$container['userRepository'] = function (ContainerInterface $container) {
    $entityManager = $container->get('entityManager');
    return new UserRepository($entityManager);
};

// $container['userRepository'] = function (ContainerInterface $container) use ($entityManager) {
//     return $entityManager->getRepository('App\Entity\User');
// };

$container['loggerService'] = function ($container) use ($config) {
    return new LoggerService(__DIR__ . $config['log_file']);
};

$container['responseBuilder'] = function (ContainerInterface $container) {
    return new ResponseBuilder(
        $container->get('config'),
        $container->get('filesystem')
    );
};

$container['userService'] = function (ContainerInterface $container) {
    return new UserService(
        $container->get('userRepository'),
        $container->get('responseBuilder'),
        $container->get('config'),
        $container->get('loggerService')
    );
};

