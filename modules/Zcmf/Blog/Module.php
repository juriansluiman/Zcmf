<?php

namespace Zcmf\Blog;

use Zend\Module\Manager,
    Zend\Config\Config,
    Zend\Loader\AutoloaderFactory;

class Module
{
    public function init(Manager $moduleManager)
    {
        $this->initAutoloader($moduleManager->getOptions()->getApplicationEnv());
    }

    protected function initAutoloader($env = null)
    {
        AutoloaderFactory::factory(array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/Blog',
                ),
            ),
        ));
    }
    
    public function getConfig()
    {
        return new Config(include __DIR__ . '/configs/module.config.php');
    }
}