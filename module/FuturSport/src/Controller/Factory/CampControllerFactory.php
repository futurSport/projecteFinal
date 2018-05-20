<?php

namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\CampController;
use FuturSport\Model\UsersTable;
use FuturSport\Model\ProfilesTable;

class CampControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new CampController($container->get(UsersTable::class),
                $container->get(ProfilesTable::class));
    }
}

