<?php
/* 
 * This is free and unencumbered software released into the public domain.
 * 
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 * 
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 * 
 * For more information, please refer to <http://unlicense.org/>
 * 
 * @category
 * @package
 * @copyright  Copyright (c) 2009-2011 Soflomo (http://www.soflomo.com)
 * @license    http://unlicense.org Unlicense
 */

namespace Zcmf\Blog\Service;

use SpiffyDoctrine\Service\Doctrine,
    Doctrine\ORM\EntityManager;

/**
 * Description of Article
 *
 * @package    
 * @subpackage 
 * @author     Jurian Sluiman <jurian@soflomo.com>
 */
class Article
{
    /**
     * @var Doctrine
     */
    protected $doctrine;

    protected $blog;
    
    public function setDoctrine (Doctrine $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function setBlog ($blogId)
    {
        $this->blog = $blogId;

        return $this;
    }

    public function getRecentArticles ()
    {
        /** @todo Create selection based on "recent" criteria */
        return $this->getEntityManager()
                    ->getRepository('Zcmf\Blog\Model\Article')
                    ->findBy(array('blog' => $this->blog));
    }

    public function getArticle ($id)
    {
        return $this->getEntityManager()
                    ->getRepository('Zcmf\Blog\Model\Article')
                    ->findOneBy(array('blog' => $this->blog, 'id' => $id));
    }

    public function getPaginatedArticles ($offset, $window)
    {
        /** @todo Instantiate a Paginator to calculate offset and window */
        return $this->getEntityManager()
                    ->getRepository('Zcmf\Blog\Model\Article')
                    ->findBy(array('blog' => $this->blog));
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager ()
    {
        return $this->doctrine->getEntityManager();
    }
}
