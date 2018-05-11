<?php
namespace FuturSport;

use Zend\Router\Http\Segment;


return [
    'controllers'=>[
        'factories'=>[
            Controller\IndexController::class=> Controller\Factory\IndexControllerFactory::class,
            Controller\CampController::class=> Controller\Factory\CampControllerFactory::class,
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
                    'route' => '/camp[/:action]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        
                    ],
                    'defaults' => [
                        'controller' => Controller\CampController::class,
                        'action'     => 'index',
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
