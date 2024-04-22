<?php

namespace App\Factory;

use Psr\Container\ContainerInterface;
use App\Service\YourService;

class YourFactory
{
    public function __invoke(ContainerInterface $container): YourService
    {
        // You can implement your logic here to create and configure the service
        return new YourService(/* pass any dependencies */);
    }
}
