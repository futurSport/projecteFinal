<?php
namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\AdminComarquesController;
use FuturSport\Model\ProvinciesTable;
use FuturSport\Model\ComarquesTable;



class AdminComarquesControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new AdminComarquesController($container->get(ProvinciesTable::class),
                $container->get(ComarquesTable::class));
    }
}