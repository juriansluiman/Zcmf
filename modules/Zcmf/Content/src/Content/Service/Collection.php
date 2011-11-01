<?php

namespace Zcmf\Content\Service;

use Zend\Config\Config,
    Doctrine\ORM\EntityManager,
    Zcmf\Content\Model\Collection as CollectionModel;

class Collection
{
    protected $types;
    protected $em;
    
    public function setContentTypes (array $types)
    {
        $this->$types = $types;
    }
    
    public function setEntityManager (EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function getPage ($id)
    {
        return $this->em->find('Zcmf\Content\Model\Page', $id);
        //return $this->em->getRepository('Zcmf\Content\Model\Page')->find($id);;
    }
    
    public function getInlineContainer ($id)
    {
        return $this->em->getRepository('Zcmf\Content\Model\Container')->find($id);
    }
    
    public function getContainerItems (CollectionModel $container)
    {
        $items = array();
        foreach ($container->getItems() as $item) {
            $items[$item->getName()] = $item;
        }
        
        // @todo check if all types are available?
        
        return $items;
    }
}