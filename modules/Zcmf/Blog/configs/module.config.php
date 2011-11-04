<?php
return array(
    'route_segments' => array(
        'blog' => array(
            'type' => 'literal',
            'options' => array(
                'defaults' => array(
                    'controller' => 'Zcmf\Blog\Controller\ArticleController',
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
                            'controller' => 'Zcmf\Blog\Controller\ArticleController',
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
                        'route'    => '/archive[/:page]',
                        'defaults' => array(
                            'controller' => 'Zcmf\Blog\Controller\ArchiveController',
                            'action'     => 'index',
                        ),
                        'constraints' => array(
                            'page'       => '[0-9]+'
                        ),
                    ),
                ),
            ),
        ),
    ),
    'script_paths' => array(
        'Zcmf\Blog' => __DIR__ . '/../views',
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'blog-service' => 'Zcmf\Blog\Service\Blog',
                'article-service' => 'Zcmf\Blog\Service\Article',
            ),
            'blog-service' => array(
                'parameters' => array(
                    'doctrine' => 'doctrine',
                ),
            ),
            'article-service' => array(
                'parameters' => array(
                    'doctrine' => 'doctrine',
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
        ),
    ),
);