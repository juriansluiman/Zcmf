<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Model\Form as FormModel;

class Form extends AbstractHelper
{
    public function __invoke(FormModel $form)
    {
        return $form->render();
    }
}
