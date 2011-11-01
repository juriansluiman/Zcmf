<?php
return array(
    'routes' => array(
        'admin' => array(
            'type' => 'literal',
            'options' => array(
                'route'    => '/admin',
                'defaults' => array(
                    'controller' => 'Zcmf\Admin\Controller\IndexController',
                    'action'     => 'index',
                ),
            ),
        ),
        'admin-page' => array(
            'type' => 'segment',
            'options' => array(
                'route'    => '/admin/page/:action[/:id[/:subcontroller[/:subaction]]]',
                'defaults' => array(
                    'controller' => 'Zcmf\Admin\Controller\PageController',
                    'action'     => 'index',
                ),
                'constraints' => array(
                    'action'     => '([A-Za-z][A-Za-z0-9-_])*',
                    'id'         => '[0-9]*'
                ),
            ),
        ),
        'admin-users' => array(
            'type' => 'segment',
            'options' => array(
                'route'    => '/admin/users[/:action[/:id]]',
                'defaults' => array(
                    'controller' => 'Zcmf\Admin\Controller\UserController',
                    'action'     => 'index',
                ),
                'constraints' => array(
                    'action'     => '([A-Za-z][A-Za-z0-9-_])*',
                    'id'         => '[0-9]*'
                ),
            ),
        ),
        'admin-settings' => array(
            'type' => 'segment',
            'options' => array(
                'route'    => '/admin/settings[/:action]',
                'defaults' => array(
                    'controller' => 'Zcmf\Admin\Controller\SettingsController',
                    'action'     => 'index',
                ),
                'constraints' => array(
                    'action'     => '([A-Za-z][A-Za-z0-9-_])*',
                ),
            ),
        ),
    ),
    'script_paths' => array(
        'Zcmf\Admin' => __DIR__ . '/../views',
    ),
);