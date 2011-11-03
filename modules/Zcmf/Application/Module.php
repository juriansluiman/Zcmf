<?php

namespace Zcmf\Application;

use Zend\Module\Manager,
    Zend\Config\Config,
    Zend\Di\Locator,
    Zend\EventManager\StaticEventManager,
    Zend\EventManager\Event,
    Zend\Loader\AutoloaderFactory;

class Module
{
    protected $routerListener;
    protected $view;
    protected $viewListener;

    public function init(Manager $moduleManager)
    {
        $this->initAutoloader($moduleManager->getOptions()->getApplicationEnv());
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap', array($this, 'initializeRouter'), 100);
        $events->attach('bootstrap', 'bootstrap', array($this, 'initializeView'), 100);
    }

    protected function initAutoloader($env = null)
    {
        AutoloaderFactory::factory(array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/Application',
                ),
            ),
        ));
    }

    public function getConfig()
    {
        return new Config(include __DIR__ . '/configs/module.config.php');
    }

    public function initializeRouter(Event $e)
    {
        $app            = $e->getParam('application');
        $config         = $e->getParam('modules')->getMergedConfig();
        $routerListener = $this->getRouterListener($app->getLocator(), $config->route_segments);
        $app->events()->attachAggregate($routerListener);
    }

    protected function getRouterListener(Locator $locator, Config $config = null)
    {
        if ($this->routerListener instanceof Router\Listener) {
            return $this->routerListener;
        }

        $routerListener       = new Router\Listener($locator, $config);

        $this->routerListener = $routerListener;
        return $routerListener;
    }
    
    public function initializeView(Event $e)
    {
        $app          = $e->getParam('application');
        $locator      = $app->getLocator();
        $config       = $e->getParam('modules')->getMergedConfig();
        $view         = $this->getView($app);
        $viewListener = $this->getViewListener($view, $config);
        $app->events()->attachAggregate($viewListener);
        $events       = StaticEventManager::getInstance();
        $viewListener->registerStaticListeners($events, $locator);
    }

    protected function getViewListener($view, $config)
    {
        if ($this->viewListener instanceof View\Listener) {
            return $this->viewListener;
        }

        $viewListener       = new View\Listener($view, $config->script_paths, $config->layout);
        $viewListener->setDisplayExceptionsFlag($config->display_exceptions);

        $this->viewListener = $viewListener;
        return $viewListener;
    }

    protected function getView($app)
    {
        if ($this->view) {
            return $this->view;
        }

        $di     = $app->getLocator();
        $view   = $di->get('view');
        $url    = $view->plugin('url');
        $url->setRouter($app->getRouter());

        $view->plugin('headTitle')->setSeparator(' - ')
                                  ->setAutoEscape(false)
                                  ->append('Application');
        $this->view = $view;
        return $view;
    }    
}