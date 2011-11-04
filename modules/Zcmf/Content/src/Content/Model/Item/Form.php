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

namespace Zcmf\Content\Model\Item;

use Doctrine\ORM\Mapping as ORM,
    Zcmf\Content\Model\Item\Item,
    Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Form
 *
 * @package    
 * @subpackage Model
 * @author     Jurian Sluiman <jurian@soflomo.com>
 * @ORM\Entity
 * @ORM\Table(name="content_forms")
 */
class Form extends Item
{
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $recipientEmail;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $recipientName;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $subject;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    protected $cc;

    /**
     * @ORM\OneToMany(targetEntity="Zcmf\Content\Model\Item\FormElement", mappedBy="form")
     * @var ArrayCollection
     */
    protected $elements;

    protected function __construct ()
    {
        $this->elements = new ArrayCollection;
    }

    public function getRecipientEmail ()
    {
        return $this->recipientEmail;
    }

    public function setRecipientEmail ($recipientEmail)
    {
        $this->recipientEmail = (string) $recipientEmail;
    }

    public function getRecipientName ()
    {
        return $this->recipientName;
    }

    public function setRecipientName ($recipientName)
    {
        $this->recipientName = (string) $recipientName;
    }

    public function getSubject ()
    {
        return $this->subject;
    }

    public function setSubject ($subject)
    {
        $this->subject = (string) $subject;
    }

    public function getCc ()
    {
        return $this->cc;
    }

    public function setCc ($cc)
    {
        $this->cc = (bool) $cc;
    }

    public function getElements ()
    {
        return $this->elements;
    }

    public function setElements ($elements)
    {
        $this->elements = $elements;
    }
}
