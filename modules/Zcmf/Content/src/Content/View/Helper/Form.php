<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Controller\IndexController,
    Zend\Form\Form as ZendForm,
    Zend\Json\Decoder as Json,
    Zcmf\Content\Model\Item\Form as FormModel;

class Form extends AbstractHelper
{    
    public function __invoke(FormModel $model, $route)
    {
        $form = new ZendForm;

        foreach ($model->getElements() as $element) {
            $type    = $element->getType();
            $name    = $element->getName();
            $options = (array) Json::decode($element->getOptions());

            $form->addElement($type, $name, $options);
        }

        $form->addElement('hidden', IndexController::ID, array(
            'value' => $model->getId()
        ));

        $url = $this->getView()->url(array(), array('name' => $route . '/send'));

        $form->setView($this->getView())
             ->setAction($url);

        return $form;
    }
}
