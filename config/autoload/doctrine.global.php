<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => '1234',
                    'dbname' => 'zend_expressive_doctrine',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ],
        'driver' => [
            'App_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/App/src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'App\Entity' => 'App_driver'
                ]
            ]
        ]
    ]
];