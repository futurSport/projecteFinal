<?php

namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\CampController;


class CampControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new CampController();
    }
}

