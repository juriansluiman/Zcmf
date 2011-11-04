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

namespace Zcmf\Content\Controller;

use Zcmf\Application\Controller\ActionController,
    Zcmf\Content\Service\Container as ContainerService,
    Zcmf\Content\Model\Item\Form,
    Zend\Mvc\Exception\DomainException;

/**
 * Index controller
 *
 * @package    Content
 * @subpackage Controller
 * @author     Jurian Sluiman <jurian@soflomo.com>
 * @version    SVN: $Id:  $
 */
class IndexController extends ActionController
{
    const ID = 'ZcmfContentFormId';
    
    /**
     * Render content page
     */
    public function indexAction ()
    {
        $service = $this->getLocator()->get('Zcmf\Content\Service\Collection');
        $page    = $service->getPage($this->page->getModuleId());
        $items   = $service->getContainerItems($page);

        $this->setParam('script', $page->getType());

        $return = $items + array('current_route' => $this->getMatchedRouteName());
        
        if ($this->flashMessenger()->hasMessages()) {
            $return['messages'] = $this->flashMessenger()->getMessages();
        }
        return $return;
    }

    /**
     * Send the result of a contact form
     */
    public function sendAction ()
    {
        if (!$this->request->isPost()) {
            throw new DomainException('Page not found', 404);
        }
        
        $service = $this->getLocator()->get('Zcmf\Content\Service\Collection');
        $page    = $service->getPage($this->page->getModuleId());
        $items   = $service->getContainerItems($page);

        $id      = (int) $this->request->post()->get(self::ID);
        
        foreach ($items as $item) {
            if ($item instanceof Form && $id === $item->getId()) {
                return $this->send($item);
            }
        }

        throw new DomainException('Could not find form object to send message');
    }

    protected function send (Form $form)
    {
        $this->flashMessenger()->addMessage('We will send you a message, I mean it!');
        // @todo Find form object
        // @todo Send email

        /** @todo Need proper way to remove child of this route */
        $route = str_replace('/send', '', $this->getMatchedRouteName());
        return $this->redirect()->toRoute($route);
    }
}
