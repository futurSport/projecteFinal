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
                Model\ProfilesPlayerTable::class => function($container) {
                    $tableGateway = $container->get(Model\ProfilesPlayerTableGateway::class);
                    return new Model\ProfilesPlayerTable($tableGateway);
                },
                Model\ProfilesPlayerTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\ProfilesPlayer());
                    return new TableGateway('player_profile', $dbAdapter, null, $resultSetPrototype);
                },
                Model\PlayerPositionTable::class => function($container) {
                    $tableGateway = $container->get(Model\PlayerPositionTableGateway::class);
                    return new Model\PlayerPositionTable($tableGateway);
                },
                Model\PlayerPositionTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\PlayerPosition());
                    return new TableGateway('player_position', $dbAdapter, null, $resultSetPrototype);
                },
                Model\CategoriesTable::class => function($container) {
                    $tableGateway = $container->get(Model\CategoriesTableGateway::class);
                    return new Model\CategoriesTable($tableGateway);
                },
                Model\CategoriesTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Categories());
                    return new TableGateway('categories', $dbAdapter, null, $resultSetPrototype);
                },
                Model\CompeticionsTable::class => function($container) {
                    $tableGateway = $container->get(Model\CompeticionsTableGateway::class);
                    return new Model\CompeticionsTable($tableGateway);
                },
                Model\CompeticionsTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Competicions());
                    return new TableGateway('competicio', $dbAdapter, null, $resultSetPrototype);
                },
                Model\PosicionsTable::class => function($container) {
                    $tableGateway = $container->get(Model\PosicionsTableGateway::class);
                    return new Model\PosicionsTable($tableGateway);
                },
                Model\PosicionsTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Posicions());
                    return new TableGateway('player_position', $dbAdapter, null, $resultSetPrototype);
                },
                Model\RelationsTable::class => function($container) {
                    $tableGateway = $container->get(Model\RelationsTableGateway::class);
                    return new Model\RelationsTable($tableGateway);
                },
                Model\RelationsTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Relations());
                    return new TableGateway('relations', $dbAdapter, null, $resultSetPrototype);
                },
                Model\NewsTable::class => function($container) {
                    $tableGateway = $container->get(Model\NewsTableGateway::class);
                    return new Model\NewsTable($tableGateway);
                },
                Model\NewsTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\News());
                    return new TableGateway('news', $dbAdapter, null, $resultSetPrototype);
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
