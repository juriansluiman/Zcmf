<?php

namespace Zcmf\Content\Repository;

use Doctrine\ORM\EntityRepository,
    Zcmf\Model\Container as ContainerModel;

class Container extends EntityRepository
{
    /**
     * Get inline container
     * 
     * @param type $id
     * @return Zcmf\Content\Model\Container 
     */
    public function getInlineContainer ($id)
    {
        return $this->_em->find('Zcmf\Content\Model\Container', $id);
    }
    
    public function getContainerItems (ContainerModel $container)
    {
        // @todo Get all items for Container
    }
}