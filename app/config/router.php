<?php

$router = $di->getRouter();

$router->add(
    '/profile',
    [

        'controller' => 'profile',
        'action'     => 'index',
    ]
);

// Define your routes here

$router->handle();
