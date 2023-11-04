<?php

namespace DubOgp\View\Helper;

use BaserCore\Error\BcException;
use BaserCore\Event\BcEventDispatcherTrait;
use BaserCore\Model\Entity\Content;
use BaserCore\Service\ContentsService;
use BaserCore\Service\ContentsServiceInterface;
use BaserCore\Service\SitesService;
use BaserCore\Service\SitesServiceInterface;
use BaserCore\Utility\BcContainerTrait;
use BaserCore\Utility\BcUtil;
use BaserCore\View\Helper\BcBaserHelper;
use BaserCore\View\Helper\BcContentsHelper;
use BaserCore\View\Helper\BcTimeHelper;
use BcBlog\Model\Entity\BlogPost;
use BcBlog\Service\BlogContentsService;
use BcBlog\Service\BlogContentsServiceInterface;
use BcBlog\Service\BlogPostsService;
use BcBlog\Service\BlogPostsServiceInterface;
use BcBlog\Service\Front\BlogFrontService;
use BcBlog\Service\Front\BlogFrontServiceInterface;
use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\Filesystem\Folder;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\View\Helper;
use Cake\View\View;

class OgpHelper extends Helper
{
    use BcContainerTrait;
    use BcEventDispatcherTrait;

    public function showOgp()
    {
        
    }

}


