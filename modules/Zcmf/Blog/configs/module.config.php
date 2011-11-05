<?php

$route = array(
    'type' => 'literal',
    'options' => array(
        'defaults' => array(
            'controller' => 'blog-article',
            'action'     => 'index',
        ),
    ),
    'may_terminate' => true,
    'child_routes' => array(
        'view' => array(
            'type' => 'segment',
            'options' => array(
                'route'    => '/article/:id',
                'defaults' => array(
                    'controller' => 'blog-article',
                    'action'     => 'view',
                ),
                'constraints' => array(
                    'id'         => '[0-9]+'
                ),
            ),
        ),
        'archive' => array(
            'type' => 'segment',
            'options' => array(
                'route'    => '/archive[/:offset]',
                'defaults' => array(
                    'controller' => 'blog-archive',
                    'action'     => 'index',
                    'offset'     => '0',
                ),
                'constraints' => array(
                    'offset'     => '[0-9]+'
                ),
            ),
        ),
    ),
);

return array(
    'script_paths' => array(
        'Zcmf\Blog' => __DIR__ . '/../views',
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'blog-article' => 'Zcmf\Blog\Controller\ArticleController',
                'blog-archive' => 'Zcmf\Blog\Controller\ArchiveController',
            ),
            'blog-article' => array(
                'parameters' => array(
                    'service' => 'Zcmf\Blog\Service\Article',
                ),
            ),
            'blog-archive' => array(
                'parameters' => array(
                    'service'        => 'Zcmf\Blog\Service\Article'
                ),
            ),
            'Zcmf\Blog\Service\Article' => array(
                'parameters' => array(
                    'doctrine' => 'doctrine',
                ),
            ),
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'options'  => array(
                        'script_paths' => array(
                            'blog' => __DIR__ . '/../views',
                        ),
                    ),
                ),
            ),
            'doctrine' => array(
                'parameters' => array(
                    'config' => array(
                        'metadata-driver-impl' => array(
                            'blog-annotation-driver' => array(
                                'class'       => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                                'namespace'   => 'Zcmf\Blog\Model',
                                'paths'       => array(__DIR__ . '/../src/Blog/Model'),
                                'cache-class' => 'Doctrine\Common\Cache\ArrayCache',
                            ),
                        ),
                    ),
                ),
            ),
            'router' => array(
                'parameters' => array(
                    'routes' => array(
                        'blog' => $route
                    ),
                ),
            ),
        ),
    ),
);