<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Model\Form;

class Form extends AbstractHelper
{
    public function __invoke(Form $form)
    {
        return $form->render();
    }
}
