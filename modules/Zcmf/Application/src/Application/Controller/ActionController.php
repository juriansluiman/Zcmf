<?php

namespace Zcmf\Application\Controller;

use Zend\Mvc\Controller\ActionController as ZendActionController,
    Zend\Mvc\MvcEvent;

abstract class ActionController extends ZendActionController
{
    private   $routeMatch;
    protected $page;
    
    protected function attachDefaultListeners()
    {
        parent::attachDefaultListeners();

        $this->events()->attach('dispatch', array($this, 'loadPage'), 100);
    }

    public function loadPage (MvcEvent $e)
    {
        $this->routeMatch = $e->getRouteMatch();
        $this->page       = $e->getParam('page', null);
    }

    protected function getParam ($key, $default = null)
    {
        return $this->routeMatch->getParam($key, $default);
    }

    protected function setParam ($key, $value)
    {
        $this->routeMatch->setParam($key, $value);
        return $this;
    }
}