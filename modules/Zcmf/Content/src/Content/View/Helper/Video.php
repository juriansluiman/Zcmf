<?php
namespace Zcmf\Content\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zcmf\Content\Model\Video as VideoModel;

class Video extends AbstractHelper
{
    public function __invoke(VideoModel $video)
    {
        return '<video src="' . $video->getSource() . '"></video>';
    }
}
