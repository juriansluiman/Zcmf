<?php

namespace Zcmf\Application\Router;

use Traversable;

class Parser
{
    protected $routes;
    protected $pages;

    /**
     * Constructor
     * 
     * @param Config $config
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Parse pages to route array
     *
     * @return array
     */
    public function parse(Traversable $pages)
    {
        $routes = array();
        foreach ($pages as $page) {
            /** @var $page Zcmf\Application\Model\Page */

            $route = $this->getModule($page->getModule());
            $route['options']['defaults']['page-id'] = $page->getId();

            /**
             * Place a slash as prefix when parent route doesn't end with slash
             *
             * For example, page "about" and subpage "me", should become /me to
             * seperate about from me with a slash. Only for the homepage (route
             * is /) we shouldn't add the additional slash, otherwise about would
             * have the //about route (this first slash is from /, the second
             * added).
             */
            if (0 !== strpos($page->getRoute(), '/')
                && 0 !== strrpos($page->getParent()->getRoute(), '/')) {
                $route['options']['route'] = '/' . $page->getRoutePath();
            } else {
                $route['options']['route'] = $page->getRoutePath();
            }

            /**
             * Remove all slashes from child routes when parent ends with slash
             *
             * Same as above, normally all module's subpages should start with
             * a slash (for example blog is at /blog, the article is /article/:id).
             * This doesn't hold for the homepage, because the article route
             * would become //article:id. So remove slashes when this is the
             * case.
             */
            if (0 === strrpos($page->getRoute(), '/')) {
                foreach ($route['child_routes'] as &$child) {
                    if (0 === strpos($child['options']['route'], '/')) {
                        $child['options']['route'] = substr($child['options']['route'], 1);
                    }
                }
            }

            $routes[$page->getId()] = $route;
            
            if ($page->hasChildren()) {
                $children = $page->getChildren();
                $routes += $this->parse($children);
            }
        }

        return $routes;
    }

    /**
     * Get config of route_segments for module
     * 
     * @param string $name
     * @return Config
     */
    protected function getModule($name)
    {
        if(!isset($this->routes[$name])) {
            throw new \RuntimeException('No module routes found for module ' . $name);
        }

        return $this->routes[$name];
    }
}