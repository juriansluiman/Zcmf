<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Model\Image as ImageModel;

class Image extends AbstractHelper
{
    public function __invoke(ImageModel $image)
    {
        return '<img src="' . $image->getSource() . '">';
    }
}
