<?php

namespace Book;

use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class
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
                    'defaukts' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ],
                ],
            ],
        ],
    ],


];
