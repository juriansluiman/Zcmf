<?php

namespace Zcmf\Application\Navigation;

use ArrayAccess,
    Zend\Config\Config,
    Zend\Di\Locator,
    Zend\EventManager\EventCollection,
    Zend\EventManager\ListenerAggregate,
    Zend\Mvc\MvcEvent;

class Listener implements ListenerAggregate
{
    protected $locator;
    protected $listeners = array();

    public function __construct(Locator $locator)
    {
        $this->locator = $locator;
    }

    public function attach(EventCollection $events)
    {
        $this->listeners[] = $events->attach('dispatch', array($this, 'loadNavigation'), 100);
    }

    public function detach(EventCollection $events)
    {
        foreach ($this->listeners as $key => $listener) {
            $events->detach($listener);
            unset($this->listeners[$key]);
            unset($listener);
        }
    }

    public function loadNavigation(MvcEvent $e)
    {
        $em    = $this->locator->get('doctrine-em');
        $pages = $em->getRepository('Zcmf\Application\Model\Page')->getRootNodes();
        // Find the right node as tree for this environment

        $parser     = new Parser($pages);
        $navigation = $parser->parse();

        // Inject navigation into Navigation object
    }
}