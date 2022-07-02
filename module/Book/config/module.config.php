<?php

namespace Book;

use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
            Controller\PostController::class => Controller\Factory\PostControllerFactory::class
        ]
    ],

    'router' => [
        'routes' => [
            'book' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/book[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ],
                ],
            ],
            'post' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/post[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\PostController::class,
                        'action' => 'index'
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'book' => __DIR__ . '/../view'
        ]
    ],

    'service_manager' => [
        'factories' => [
            Service\IndexManager::class => Service\Factory\IndexManagerFactory::class,
            Service\PostManager::class => Service\Factory\PostManagerFactory::class
        ]
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
    ],
];
