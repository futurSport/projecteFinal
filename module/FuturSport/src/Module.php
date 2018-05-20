<?php

namespace FuturSport;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;

class Module implements ConfigProviderInterface {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig() {
        return [
            'factories' => [
                Model\UsersTable::class => function($container) {
                    $tableGateway = $container->get(Model\UsersTableGateway::class);
                    return new Model\UsersTable($tableGateway);
                },
                Model\UsersTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Users());
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                Model\RolTable::class => function($container) {
                    $tableGateway = $container->get(Model\RolTableGateway::class);
                    return new Model\RolTable($tableGateway);
                },
                Model\RolTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Rol());
                    return new TableGateway('rol', $dbAdapter, null, $resultSetPrototype);
                },
                Model\ProfilesTable::class => function($container) {
                    $tableGateway = $container->get(Model\ProfilesTableGateway::class);
                    return new Model\ProfilesTable($tableGateway);
                },
                Model\ProfilesTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Profiles());
                    return new TableGateway('profiles', $dbAdapter, null, $resultSetPrototype);
                },
                Model\ProvinciesTable::class => function($container) {
                    $tableGateway = $container->get(Model\ProvinciesTableGateway::class);
                    return new Model\ProvinciesTable($tableGateway);
                },
                Model\ProvinciesTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Provincies());
                    return new TableGateway('provincies', $dbAdapter, null, $resultSetPrototype);
                },
                Model\ComarquesTable::class => function($container) {
                    $tableGateway = $container->get(Model\ComarquesTableGateway::class);
                    return new Model\ComarquesTable($tableGateway);
                },
                Model\ComarquesTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Comarques());
                    return new TableGateway('comarques', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function onBootstrap(MvcEvent $event) {
        $application = $event->getApplication();
        $serviceManager = $application->getServiceManager();

        // The following line instantiates the SessionManager and automatically
        // makes the SessionManager the 'default' one.
        $sessionManager = $serviceManager->get(SessionManager::class);
    }

}
