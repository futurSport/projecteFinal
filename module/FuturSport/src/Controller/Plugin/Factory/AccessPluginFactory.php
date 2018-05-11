<?php

namespace FuturSport\Controller\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use FuturSport\Controller\Plugin\AccessPlugin;



class AccessPluginFactory implements FactoryInterface{
    public function __invoke(ContainerInterface $container, $requestedName, array $options=null) {
         return new AccessPlugin();
    } 
}