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
 * @version    $Id:  $
 */

namespace Zcmf\Blog\Controller;

use Zcmf\Application\Controller\ActionController,
    Zcmf\Blog\Service\Article as ArticleService,
    Zend\Mvc\Exception\DomainException;

/**
 * Index controller
 *
 * @package    Blog
 * @subpackage Controller
 * @author     Jurian Sluiman <jurian@soflomo.com>
 * @version    SVN: $Id:  $
 */
class ArchiveController extends ActionController
{
    /**
     * @var ArticleService
     */
    protected $service;

    protected $itemsPerPage;

    public function __construct (ArticleService $service, $items_per_page = 10)
    {
        $this->service      = $service;
        $this->itemsPerPage = $items_per_page;
    }
    
    /**
     * Render content page
     */
    public function indexAction ()
    {
        $offset   = $this->getParam('offset', 0);
        $articles = $this->service
                         ->setBlog($this->page->getModuleId())
                         ->getPaginatedArticles($offset, $this->itemsPerPage);

        return array('articles' => $articles, 'current_route' => $this->getMatchedRouteName());
    }
}
