<?php
return array(
    'module_paths' => array(
        realpath(__DIR__ . '/../modules'),
    ),
    'modules' => array(
        'SpiffyDoctrine',
        'GedmoDoctrineExtensions',
        'Zcmf\Content',
        'Zcmf\Blog',
        'Zcmf\Admin',
        'Zcmf\Application',
    ),
    'module_manager_options' => array( 
        'enable_config_cache'      => false,
        'cache_dir'                => realpath(__DIR__ . '/../data/cache'),
        'enable_dependency_check'  => false,
        'enable_auto_installation' => false,
        'manifest_dir'             => realpath(__DIR__ . '/../data'),
    ),
);
