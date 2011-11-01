<?php

namespace Zcmf\Application\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class Page extends NestedTreeRepository
{
    protected $nodes;

    /**
     * Use same instance of nodes during the requst
     *
     * @see parent::getRootNodes()
     * @return array
     */
    public function getRootNodes()
    {
        if (null === $this->nodes) {
            $this->nodes = parent::getRootNodes();
        }

        return $this->nodes;
    }
}