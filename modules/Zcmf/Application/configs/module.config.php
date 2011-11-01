<?php
return array(
    'layout' => 'layouts/layout.phtml',
    'di' => array(
        'instance' => array(
            'alias' => array(
                'view'  => 'Zend\View\PhpRenderer',
            ),

            'Zend\View\HelperLoader' => array(
                'parameters' => array(
                    'map' => array(
                        'url' => 'Zcmf\Application\View\Helper\Url',
                    ),
                ),
            ),

            'Zend\View\HelperBroker' => array(
                'parameters' => array(
                    'loader' => 'Zend\View\HelperLoader',
                ),
            ),

            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'resolver' => 'Zend\View\TemplatePathStack',
                    'options'  => array(
                        'script_paths' => array(
                            'application' => __DIR__ . '/../views',
                        ),
                    ),
                    'broker' => 'Zend\View\HelperBroker',
                ),
            ),
            'doctrine-container' => array(
                'parameters' => array(
                    'connection' => array(
                        'default' => array(
                            'dbname'   => 'zf2',
                            'user'     => 'root',
                            'password' => 'root',
                            'host'     => '127.0.0.1',
                        )
                    ),
                    'cache' => array(
                        'default' => array(
                            'class' => 'Doctrine\Common\Cache\ArrayCache'
                        )
                    ),
                    'evm' => array(
                        'default' => array(
                            'subscribers' => array(
                                'Gedmo\Tree\TreeListener',
                            )
                        )
                    ),
                    'em' => array(
                        'default' => array(
                            //'logger' => 'Doctrine\DBAL\Logging\EchoSQLLogger',
                            'proxy' => array(
                                'generate'  => true,
                                'dir'       => __DIR__ . '/../../../../data/proxies',
                                'namespace' => 'Zcmf\Application\Proxy'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
