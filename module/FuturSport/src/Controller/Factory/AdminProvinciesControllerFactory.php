<?php
namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\AdminProvinciesController;
use FuturSport\Model\ProvinciesTable;


class AdminProvinciesControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new AdminProvinciesController($container->get(ProvinciesTable::class));
    }
}
