<?php

namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\AdminCompeticionsController;
use FuturSport\Model\CompeticionsTable;




class AdminCompeticionsControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new AdminCompeticionsController($container->get(CompeticionsTable::class));
    }
}

