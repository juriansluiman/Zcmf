<?php
return array(
    'layout' => 'layouts/layout.phtml',
    'head_title' => 'Application',
    
    'di' => array(
        'instance' => array(
            'alias' => array(
                'view'  => 'Zend\View\PhpRenderer',
                'router' => 'Zcmf\Application\Router\Listener',
            ),
            
            'doctrine' => array(
                'parameters' => array(
                    'conn' => array(
                        'host'     => '127.0.0.1',
                        'user'     => 'root',
                        'password' => 'root',
                        'dbname'   => 'zf2',
                    ),
                    'config' => array(
                        'proxy-dir'          => __DIR__ . '/../../../../data/proxies',
                        'proxy-namespace'    => 'Zcmf\Proxy',

                        'metadata-driver-impl' => array(
                            'application-annotation-driver' => array(
                                'class'       => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                                'namespace'   => 'Zcmf\Application\Model',
                                'paths'       => array(__DIR__ . '/../src/Application/Model'),
                                'cache-class' => 'Doctrine\Common\Cache\ArrayCache',
                            ),
                        ),
                    ),
                    'evm' => array(
                        'subscribers' => array(
                            'Gedmo\Tree\TreeListener'
                        ),
                    )  ,
                ),
            ),

            'router' => array(
                'parameters' => array(
                    'doctrine' => 'doctrine',
                    'routes' => array(),
                ),
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
        ),
    ),
);
