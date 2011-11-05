<?php

namespace Zcmf\Content\Service;

use SpiffyDoctrine\Service\Doctrine,
    Doctrine\ORM\EntityManager;

class Collection
{
    protected $types;
    protected $items;
    protected $em;
    
    public function setContentTypes (array $types)
    {
        $this->$types = $types;
    }

    public function setItemTypes (array $items)
    {
        $this->items = $items;
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
    
    public function getContainerItems ($id)
    {
        $items = array();

        foreach ($this->items as $item) {
            $result = $this->em->getRepository($item)->findBy(array('collection' => $id));

            if (count($result)) {
                foreach ($result as $item) {
                    $items[$item->getName()] = $item;
                }
            }
        }

        return $items;
    }
}