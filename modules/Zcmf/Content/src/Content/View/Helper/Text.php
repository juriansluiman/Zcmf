<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Model\Text;

class Text extends AbstractHelper
{
    public function __invoke(Text $text)
    {
        return $text->getBody();
    }
}
