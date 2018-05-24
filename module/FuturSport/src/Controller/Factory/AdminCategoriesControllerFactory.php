<?php
namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\AdminCategoriesController;
use FuturSport\Model\CategoriesTable;


class AdminCategoriesControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new AdminCategoriesController($container->get(CategoriesTable::class));
    }
}
