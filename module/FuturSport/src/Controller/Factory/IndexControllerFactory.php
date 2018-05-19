<?php

namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\IndexController;
use FuturSport\Model\UsersTable;
use FuturSport\Model\RolTable;


class IndexControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new IndexController($container->get(UsersTable::class),
                $container->get(RolTable::class),
                $container->get('usuariConectat'));
    }
}

