<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use App\Entity\User;
use App\Service\UserService;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;
use Symfony\Component\Yaml\Yaml;
use App\Service\LoggerService;

$rdbmsData = Yaml::parseFile(__DIR__ . '/src/config/rdbms.yaml');
$config = Yaml::parseFile(__DIR__ . '/src/config/config.yaml');

// Create ORM setup
$setup = ORMSetup::createAnnotationMetadataConfiguration([__DIR__ . '/src/Entity'], true);

// Create entity manager
$entityManager = EntityManager::create($rdbmsData['rdbms'], $setup);

// Retrieve container
$container = $app->getContainer();

// Define services
$container['entityManager'] = function (ContainerInterface $container) use ($entityManager) {
    return $entityManager;
};

$container['userRepository'] = function (ContainerInterface $container) use ($entityManager) {
    return $entityManager->getRepository('App\Entity\User');
};

$container['loggerService'] = function ($container) use ($config) {
    return new LoggerService(__DIR__ . $config['log_file']);
};

$container['userService'] = function (ContainerInterface $container) {
    return new UserService(
        $container->get('userRepository'),
        $container->get('loggerService')
    );
};
// Return the container
// return $container;
