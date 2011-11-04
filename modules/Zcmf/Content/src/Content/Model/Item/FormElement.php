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

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of FormElement
 *
 * @package    
 * @subpackage Model
 * @author     Jurian Sluiman <jurian@soflomo.com>
 * @ORM\Entity
 * @ORM\Table(name="content_formelements")
 */
class FormElement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var integer
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Zcmf\Content\Model\Item\Form")
     * @var Form
     */
    protected $form;

    /**
     * @ORM\Column(name="`order`", type="integer")
     * @var integer
     */
    protected $order;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $type;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $options;

    /**
     * Get id
     * 
     * @return integer
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Get form
     *
     * @return Form
     */
    public function getForm ()
    {
        return $this->form;
    }

    /**
     * Set form
     * 
     * @param Form $form
     */
    public function setForm (Form $form)
    {
        $this->form = $form;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder ()
    {
        return $this->order;
    }

    /**
     * Set order
     * 
     * @param integer $order
     */
    public function setOrder ($order)
    {
        $this->order = (int) $order;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType ()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType ($type)
    {
        $this->type = (string) $type;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function setName ($name)
    {
        $this->name = (string) $name;
    }


    /**
     * Get options
     *
     * @return string
     */
    public function getOptions ()
    {
        return $this->options;
    }

    /**
     * Set options
     * 
     * @param string $options
     */
    public function setOptions ($options)
    {
        $this->options = (string) $options;
    }
}
