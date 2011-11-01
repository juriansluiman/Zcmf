<?php

namespace Zcmf\Content\Repository;

use Doctrine\ORM\EntityRepository,
    Zcmf\Model\Page as PageModel;

class Page extends EntityRepository
{
    /**
     * Get inline container
     * 
     * @param type $id
     * @return Zcmf\Content\Model\Page
     */
    public function getPage ($id)
    {
        return $this->_em->find('Zcmf\Content\Model\Page', $id);
    }
    
    public function getContainerItems (PageModel $container)
    {
        // @todo Get all items for Container
    }
}