<?php

namespace DubOgp\View\Helper;

use BaserCore\Error\BcException;
use BaserCore\Event\BcEventDispatcherTrait;
// use BaserCore\Utility\BcContainerTrait;
use Cake\View\Helper;
use Cake\View\View;
use DubOgp\Service\DubOgpConfigsService;
// use DubOgp\Service\DubOgpConfigsServiceInterface;

class DubOgpHelper extends Helper
{
    // use BcContainerTrait;
    use BcEventDispatcherTrait;

    private $dubOgpConfigsService;

    public $helpers = [
        'BaserCore.BcBaser',
        'BcBlog.Blog'
    ];

    public function __construct(View $view, array $config = [])
    {
        parent::__construct($view, $config);
        $this->DubOgpConfigsService = new DubOgpConfigsService();
    }

    public function showOgp()
    {
        $this->BcBaser->element('DubOgp.show_ogp', array('plugin' => 'DubOgp'));
    }

    public function ogpInfo(){
		$OgpConfig = $this->DubOgpConfigsService->get();

        // $content = $this->getView()->getRequest()->getAttribute('currentContent');
        // var_dump($content);
        // die;


        // $site = $this->getView()->getRequest()->getAttribute('currentSite');
        // if($site->has('display_name') && !is_null($site->get('display_name'))){
        //     $return['title'] = $site->display_name;
        // }elseif($site->has('title') && !is_null($site->get('title'))){
        //     $return['title'] = $site->title;
        // }
        $OgpConfig->title = $this->BcBaser->getTitle();
        $OgpConfig->site_name = $this->BcBaser->getSiteName();
        if($this->BcBaser->isHome()){
            $OgpConfig->type = 'website';
        }else{
            $OgpConfig->type = 'article';
        }
        $OgpConfig->description = $this->BcBaser->getDescription(); 
        $OgpConfig->url = $this->BcBaser->getUrl($this->BcBaser->getHere(), true);
        
        // var_dump($this->BcBaser->getSiteUrl());
        // var_dump($this->BcBaser->getSiteName());
        // var_dump($this->BcBaser->getHere());
        
		return $OgpConfig;
	}
}
