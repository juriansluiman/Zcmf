<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Model\Item\Text as TextModel;

class Text extends AbstractHelper
{
    public function __invoke(TextModel $text)
    {
        return $text->getBody();
    }
}
