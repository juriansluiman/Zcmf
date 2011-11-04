<?php
$types   = array(
    'standard' => array(
        'text' => 'Text',
    ),
    'home' => array(
        'blitz' => 'Image',
        'text' => 'Text'
    ),
    'twocolumn' => array(
        'left' => 'Text',
        'right' => 'Text',
    ),
    'contact' => array(
        'text' => 'Text',
        'form' => 'Form',
    ),
);

return array(
    'di' => array(
        'instance' => array(
            'Zend\View\HelperLoader' => array(
                'parameters' => array(
                    'map' => array(
                        'text'  => 'Zcmf\Content\View\Helper\Text',
                        'form'  => 'Zcmf\Content\View\Helper\Form',
                        'image' => 'Zcmf\Content\View\Helper\Image',
                        'video' => 'Zcmf\Content\View\Helper\Video',
                    ),
                ),
            ),
            'Zcmf\Content\Service\Collection' => array(
                'parameters' => array(
                    'doctrine' => 'doctrine'
                ),
            ),
            'doctrine' => array(
                'parameters' => array(
                    'config' => array(
                        'metadata-driver-impl' => array(
                            'content-annotation-driver' => array(
                                'class'       => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                                'namespace'   => 'Zcmf\Content\Model',
                                'paths'       => array(__DIR__ . '/../src/Content/Model'),
                                'cache-class' => 'Doctrine\Common\Cache\ArrayCache',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'script_paths' => array(
        'Zcmf\Content' => __DIR__ . '/../views',
    ),
    'route_segments' => array(
        'content' => array(
            'type' => 'literal',
            'options' => array(
                'defaults' => array(
                    'controller' => 'Zcmf\Content\Controller\IndexController',
                    'action'     => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'send' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route'    => '/send',
                        'defaults' => array(
                            'controller' => 'Zcmf\Content\Controller\IndexController',
                            'action'     => 'send',
                        ),
                    ),
                ),
            ),
        ),
    ),
);