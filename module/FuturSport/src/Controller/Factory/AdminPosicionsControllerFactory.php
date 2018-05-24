<?php
namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\AdminPosicionsController;
use FuturSport\Model\PosicionsTable;




class AdminPosicionsControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new AdminPosicionsController($container->get(PosicionsTable::class));
    }
}
