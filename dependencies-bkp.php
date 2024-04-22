<?php

use App\Service\YourService;
use App\Service\UserService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use App\Repository\UserRepository;

$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'user_management',
    'user'     => 'root',
    'password' => '',
];

$setup = ORMSetup::createAnnotationMetadataConfiguration([__DIR__ . '/src/Entity'], true);

$entityManager = EntityManager::create($dbParams, $setup);

$container = $app->getContainer();

$container['YourService'] = function ($container) {
    return new YourService(/* pass any dependencies */);
};

$container['entityManager'] = function ($container) use ($entityManager) {
    return $entityManager;
};

$container['userRepository'] = function ($container) use ($entityManager) {
    // Replace 'App\Entity\User' with the correct namespace and class name for your entity
    return $entityManager->getRepository(App\Entity\User::class);
};

$container['UserService'] = function ($container) {
    return new UserService($container['userRepository']);
};

