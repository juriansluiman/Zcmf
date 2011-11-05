<?php

namespace Zcmf\Content;

use Zend\Mvc\LocatorAware,
    Zcmf\Admin\AdminAware,
    Zcmf\Application\Model\Page,
    Zcmf\Content\Model\Page as Content;

class Admin implements AdminAware, LocatorAware
{
    const ADMIN_NAMESPACE = 'Zcmf\ContentAdmin';
    
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
        $content = new Content;
        $em      = $this->getLocator()->get('doctrine')->getEntityManager();
        $em->persist($content);
        $em->flush();

        $page->setModuleId($content->id);
    }

    public function delete(Page $page)
    {
        $em      = $this->getLocator()->get('doctrine')->getEntityManager();
        $content = $em->find('Zcmf\Content\Model\Page', $page->getModuleId());
        $em->remove($content);
        $em->flush();
    }
}