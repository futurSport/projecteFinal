<?php
namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\AdminUsersController;
use FuturSport\Model\UsersTable;

class AdminUsersControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new AdminUsersController($container->get(UsersTable::class));
    }
}
