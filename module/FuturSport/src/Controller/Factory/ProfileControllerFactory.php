<?php

namespace FuturSport\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\ProfileController;

use FuturSport\Model\ProfilesTable;
use FuturSport\Model\ProvinciesTable;
use FuturSport\Model\ComarquesTable;

class ProfileControllerFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new ProfileController(
                $container->get(ProfilesTable::class),
                $container->get(ProvinciesTable::class),
                $container->get(ComarquesTable::class));
    }
}