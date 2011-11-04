<?php

namespace Zcmf\Content\Service;

use SpiffyDoctrine\Service\Doctrine,
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
    
    public function setEntityManager (Doctrine $doctrine)
    {
        $this->em = $doctrine->getEntityManager();
    }
    
    public function getPage ($id)
    {
        return $this->em->find('Zcmf\Content\Model\Page', $id);
    }
    
    public function getInlineContainer ($id)
    {
        return $this->em->find('Zcmf\Content\Model\Container', $id);
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