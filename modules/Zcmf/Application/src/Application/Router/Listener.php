<?php

namespace Zcmf\Application\Router;

use ArrayAccess,
    ArrayObject,
    Zend\Config\Config,
    Zend\Di\Locator,
    Zend\EventManager\EventCollection,
    Zend\EventManager\ListenerAggregate,
    Zend\Mvc\MvcEvent,
    Zend\Mvc\Router\Http\Part,
    Zend\Mvc\Router\RouteBroker;

class Listener implements ListenerAggregate
{
    protected $events;
    protected $locator;
    protected $routeSegments;
    protected $listeners = array();

    public function __construct(Locator $locator, Config $routeSegments = null)
    {
        $this->locator       = $locator;
        $this->routeSegments = $routeSegments;
    }

    public function attach(EventCollection $events)
    {
        $this->events = $events;

        $this->listeners[] = $events->attach('route', array($this, 'initRoutes'), 100);

        // Early listener for loading routes, late listener for injection
        // Place an early listener for the cached routes
        $this->listeners[] = $events->attach('route.init', array($this, 'loadRoutes'), 100);
        $this->listeners[] = $events->attach('route.init', array($this, 'insertRoutes'), -100);
        // Place a late listener to save the routes in cache

        $this->listeners[] = $events->attach('dispatch', array($this, 'loadPage'), 1000);
    }

    public function detach(EventCollection $events)
    {
        foreach ($this->listeners as $key => $listener) {
            $events->detach($listener);
            unset($this->listeners[$key]);
            unset($listener);
        }
    }

    public function initRoutes (MvcEvent $e)
    {
        $event = clone($e);
        $e->setTarget($this);

        $this->events->trigger('route.init', $event);
    }

    public function loadRoutes(MvcEvent $e)
    {
        $em    = $this->locator->get('doctrine')->getEntityManager();

        $pages = $em->getRepository('Zcmf\Application\Model\Page')->getRootNodes();
        $pages = new ArrayObject($pages);
        
        // @todo Find the right node as tree for this environment
        $parser = new Parser($this->routeSegments);
        $routes = $parser->parse($pages);

        $e->setParam('routes', $routes);
    }

    public function insertRoutes(MvcEvent $e)
    {
        $router = $e->getRouter();
        $routes = $e->getParam('routes', array());
        $router->addRoutes($routes);
    }

    public function loadPage (MvcEvent $e)
    {
        $match  = $e->getRouteMatch();
        $pageId = $match->getParam('page-id', null);

        if (null !== $pageId && is_numeric($pageId)) {
            $em   = $this->locator->get('doctrine')->getEntityManager();
            $page = $em->find('Zcmf\Application\Model\Page', $pageId);

            $e->setParam('page', $page);
        }
    }
}
