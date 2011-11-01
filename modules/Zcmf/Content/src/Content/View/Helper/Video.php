<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Model\Video;

class Video extends AbstractHelper
{
    public function __invoke(Video $video)
    {
        return '<video src="' . $video->getSource() . '"></video>';
    }
}
