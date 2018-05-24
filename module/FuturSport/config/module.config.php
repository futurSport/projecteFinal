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
            Controller\AdminProvinciesController::class=> Controller\Factory\AdminProvinciesControllerFactory::class,
            Controller\AdminComarquesController::class=> Controller\Factory\AdminComarquesControllerFactory::class,
            Controller\AdminCategoriesController::class=> Controller\Factory\AdminCategoriesControllerFactory::class,
            Controller\AdminCompeticionsController::class=> Controller\Factory\AdminCompeticionsControllerFactory::class,
            Controller\AdminPosicionsController::class=> Controller\Factory\AdminPosicionsControllerFactory::class,

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
                        
                    ],
                ],
            ],
            'admin-provincies' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/admin-provincies[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminProvinciesController::class,
                        'action'=>'index',
                    ],
                ],
            ],
            'admin-comarques' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/admin-comarques[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminComarquesController::class,
                        'action'=>'index',
                    ],
                ],
            ],
             'admin-categories' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/admin-categories[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminCategoriesController::class,
                        'action'=>'index',
                    ],
                ],
            ],
            'admin-competicions' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/admin-competicions[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminCompeticionsController::class,
                        'action'=>'index',
                    ],
                ],
            ],
            'admin-posicions' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/admin-posicions[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminPosicionsController::class,
                        'action'=>'index',
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
