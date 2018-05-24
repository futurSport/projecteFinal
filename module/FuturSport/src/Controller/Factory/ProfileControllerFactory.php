<?php

namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\ProfileController;

use FuturSport\Model\ProfilesTable;
use FuturSport\Model\ProvinciesTable;
use FuturSport\Model\ComarquesTable;
use FuturSport\Model\UsersTable;
use FuturSport\Model\ProfilesPlayerTable;
use FuturSport\Model\CategoriesTable;
use FuturSport\Model\PlayerPositionTable;


class ProfileControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new ProfileController(
                $container->get(ProfilesTable::class),
                $container->get(ProfilesPlayerTable::class),
                $container->get(ProvinciesTable::class),
                $container->get(ComarquesTable::class),
                $container->get(UsersTable::class),
                $container->get(CategoriesTable::class),
                $container->get(PlayerPositionTable::class)
                );
    }
}