<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Model\Image;

class Image extends AbstractHelper
{
    public function __invoke(Image $image)
    {
        return '<img src="' . $image->getSource() . '">';
    }
}
