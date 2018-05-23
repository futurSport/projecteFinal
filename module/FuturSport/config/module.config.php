<?php
namespace FuturSport;

use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;


return [
    'controllers'=>[
        'factories'=>[
            Controller\IndexController::class=> Controller\Factory\IndexControllerFactory::class,
            Controller\CampController::class=> Controller\Factory\CampControllerFactory::class,
            Controller\AdminController::class=> Controller\Factory\AdminControllerFactory::class,
            Controller\AdminUsersController::class=> Controller\Factory\AdminUsersControllerFactory::class,
            Controller\ProfileController::class=> Controller\Factory\ProfileControllerFactory::class,
        ],
    ],
    /*'router' => [
        'routes' => [
            'album' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],*/
    'router' => [
        'routes' => [
            'index' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/index[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'camp' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/camp[/:action[/:busqueda]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'busqueda' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        
                    ],
                    'defaults' => [
                        'controller' => Controller\CampController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
             'admin' => [
                'type'    => Literal::class,
                'options' => [
                    'route' => '/admin',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'admin-users' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/admin-users[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminUsersController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'profile' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/profile[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ProfileController::class,
                        'action'     => 'profile',
                    ],
                ],
            ],
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            Controller\Plugin\AccessPlugin::class => Controller\Plugin\Factory\AccessPluginFactory::class,
        ],
        'aliases' => [
            'access' => Controller\Plugin\AccessPlugin::class,
        ]
    ],
    'view_manager'=>[
        'template_path_stack'=>[
            'futur-sport'=>__DIR__.'/../view',
        ],
    ],
    'session_containers' => [
        'usuariConectat'
    ],
];
