<?php
namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\AdminUsersController;
use FuturSport\Model\UsersTable;
use FuturSport\Model\RolTable;

class AdminUsersControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new AdminUsersController($container->get(UsersTable::class),
                $container->get(RolTable::class));
    }
}
