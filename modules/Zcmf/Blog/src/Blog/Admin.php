<?php

namespace Zcmf\Blog;

use Zend\Mvc\LocatorAware,
    Zcmf\Admin\AdminAware,
    Zcmf\Application\Model\Page,
    Zcmf\Blog\Model\Blog as BlogModel;

class Admin implements AdminAware, LocatorAware
{
    const ADMIN_NAMESPACE = 'Zcmf\BlogAdmin';
    
    protected $locator;

    public function setLocator(Locator $locator)
    {
        $this->locator = $locator;
    }

    public function getLocator()
    {
        return $this->locator;
    }

    public function getNamespace ()
    {
        return self::ADMIN_NAMESPACE;
    }

    public function create (Page $page)
    {
        $blog = new BlogModel;
        $em   = $this->getLocator()->get('doctrine')->getEntityManager();
        $em->persist($blog);
        $em->flush();

        $page->setModuleId($blog->id);
    }

    public function delete(Page $page)
    {
        $em   = $this->getLocator()->get('doctrine')->getEntityManager();
        $blog = $em->find('Zcmf\Blog\Model\Blog', $page->getModuleId());
        $em->remove($blog);
        $em->flush();
    }
}