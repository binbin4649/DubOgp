<?php

namespace DubOgp\View\Helper;

use BaserCore\Error\BcException;
use BaserCore\Event\BcEventDispatcherTrait;
use BcBlog\Service\BlogPostsService;
use BaserCore\Utility\BcUtil;
use BaserCore\View\Helper\BcUploadHelper;
// use BaserCore\Utility\BcContainerTrait;
use Cake\View\Helper;
use Cake\View\View;
use Cake\Utility\Hash;
use Cake\ORM\TableRegistry;
use DubOgp\Service\DubOgpConfigsService;
use DubOgp\Utility\FileSearch;
// use DubOgp\Service\DubOgpConfigsServiceInterface;

class DubOgpHelper extends Helper
{
    // use BcContainerTrait;
    use BcEventDispatcherTrait;

    private $dubOgpConfigsService;

    public $helpers = [
        'Url',
        'BaserCore.BcBaser',
        'BcBlog.Blog',
        'BaserCore.BcUpload'
    ];

    /**
     * Undocumented function
     *
     * @param View $view
     * @param array $config
     */
    public function __construct(View $view, array $config = [])
    {
        parent::__construct($view, $config);
        $this->DubOgpConfigsService = new DubOgpConfigsService();
    }

    /**
     * 
     *
     * @return void
     */
    public function showOgp()
    {
        $this->BcBaser->element('DubOgp.show_ogp', array('plugin' => 'DubOgp'));
    }

    //https://webma.xscore.co.jp/study/ogp-seo/
    //を参考に文字数等を調整
    // @todo custom_content 対応してるか？確認する
    public function ogpInfo()
    {
        $OgpConfig = $this->DubOgpConfigsService->get();
        if ($this->Blog->isBlog()) {
            $OgpConfig = $this->blogInfo($OgpConfig);
        } else {
            $OgpConfig = $this->contentInfo($OgpConfig);
        }
        $OgpConfig->title = mb_substr(strip_tags($OgpConfig->title), 0, 20, 'UTF-8');
        $OgpConfig->description = preg_replace('/\s+/', '', $OgpConfig->description); //改行・空白除去
        $OgpConfig->description = mb_substr(strip_tags($OgpConfig->description), 0, 90, 'UTF-8');
        $OgpConfig->site_name = $this->BcBaser->getSiteName();
        if ($this->BcBaser->isHome()) {
            $OgpConfig->type = 'website';
        } else {
            $OgpConfig->type = 'article';
        }
        $OgpConfig->url = $this->BcBaser->getUrl($this->BcBaser->getHere(), true);
        return $OgpConfig;
    }

    // @todo どうしてもファイルが見つからない時に FileSearch::searchFiles() してる。応答悪くなるからやめたい、キャッシュでも挟めば良いのかね？そもそも見つからないって、
    public function uploadImageInfo($fieldName, $entity, $options = [])
    {
        $return = [
            'img_url' => false,
            'img_height' => false,
            'img_width' => false
        ];
        $options = array_merge([
            'limited' => false,  // 公開制限フォルダを利用する場合にフォルダ名を設定する
        ], $options);
        $this->table = TableRegistry::getTableLocator()->get($options['table']);
        $settings = $this->table->getSettings();
        $fileName = Hash::get($entity, $fieldName);
        $fileUrl = $this->BcUpload->getBasePath($settings);
        $url = $this->Url->image($fileUrl . $fileName);
        $saveDir = $this->table->getSaveDir(false, $options['limited']);
        $home_url = $this->BcBaser->getUrl('/', true);
        $img_url = preg_replace('#(?<!:)//+#', '/', $home_url . $url);
        if (file_exists($saveDir . $fileName)) {
            $return = $this->returnImg($img_url, $saveDir . $fileName);
        } else {
            $saveDirInTheme = $this->table->getSaveDir(true, $options['limited']) ?? '';
            if (file_exists($saveDirInTheme . $fileName)) {
                $fileUrlInTheme = $this->BcUpload->getBasePath($settings, true);
                $url = $this->Url->image($fileUrlInTheme . $fileName);
                $img_url = preg_replace('#(?<!:)//+#', '/', $home_url . $fileUrlInTheme);
                $return = $this->returnImg($img_url, $saveDirInTheme . $fileName);
            } else {
                $pathInfo = pathinfo(parse_url($img_url, PHP_URL_PATH));
                $foundFiles = FileSearch::searchFiles(ROOT, basename($fileName));
                if (!empty($foundFiles[0]) && isset($pathInfo['extension'])) {
                    $return = $this->returnImg($img_url, $foundFiles[0]);
                }
            }
        }
        return $return;
    }

    public function returnImg($full_url, $full_path)
    {
        $return = [
            'img_url' => false,
            'img_height' => false,
            'img_width' => false
        ];
        if (file_exists($full_path) && !is_dir($full_path)) {
            $image_info = getimagesize($full_path);
            $return = [
                'img_url' => $full_url,
                'img_height' => $image_info[0],
                'img_width' => $image_info[1]
            ];
        }
        return $return;
    }

    public function addImg($OgpConfig, $img_info)
    {
        if (empty($img_info['img_url'])) {
            $img_info = $this->getDefaultImage($OgpConfig);
        }
        $OgpConfig->img_url = $img_info['img_url'];
        $OgpConfig->img_height = $img_info['img_height'];
        $OgpConfig->img_width = $img_info['img_width'];
        return $OgpConfig;
    }

    public function getDefaultImage($OgpConfig)
    {
        $return = [
            'img_url' => false,
            'img_height' => false,
            'img_width' => false
        ];
        $home_url = $this->BcBaser->getUrl('/', true);
        if (isset($OgpConfig->default_image)) {
            $path = 'img/' . $OgpConfig->default_image;
            if (file_exists(WWW_ROOT . $path)) {
                $img_url = $home_url . $path;
                $return = $this->returnImg($img_url, WWW_ROOT . $path);
            } else {
                $theme = BcUtil::getCurrentTheme();
                $path = $theme . '/img/' . $OgpConfig->default_image;
                if (file_exists(WWW_ROOT . $path)) {
                    $img_url = $home_url . $path;
                    $return = $this->returnImg($img_url, WWW_ROOT . $path);
                }
            }
        }
        if (!$return['img_url']) {
            $theme = BcUtil::getCurrentTheme();
            $path = $theme . '/img/logo.png';
            if (file_exists(WWW_ROOT . $path)) {
                $img_url = $home_url . $path;
                $return = $this->returnImg($img_url, WWW_ROOT . $path);
            }
        }
        if (!$return['img_url']) {
            $path = 'img/basercms.png';
            if (file_exists(WWW_ROOT . $path)) {
                $img_url = $home_url . $path;
                $return = $this->returnImg($img_url, WWW_ROOT . $path);
            }
        }
        return $return;
    }

    public function contentInfo($OgpConfig)
    {
        $content = $this->BcBaser->getCurrentContent();
        $img_info = $this->uploadImageInfo('eyecatch', $content, ['table' => 'BaserCore.Contents']);
        $OgpConfig = $this->addImg($OgpConfig, $img_info);
        $OgpConfig->title = $this->BcBaser->getTitle();
        $OgpConfig->description = $this->BcBaser->getDescription();
        return $OgpConfig;
    }

    // @todo 無理やり post_id 取得してる、もっと良いやり方ないんかな
    public function blogInfo($OgpConfig)
    {
        $request = $this->getView()->getRequest();
        $uri = $request->getUri();
        $path = $uri->getPath();
        $post_id = $this->extractNumberFromText($path);
        if ($post_id) {
            $blogPostsService = new BlogPostsService();
            $blogPost = $blogPostsService->get($post_id);
            $img_info = $this->uploadImageInfo('eye_catch', $blogPost, ['table' => 'BcBlog.BlogPosts']);
            $OgpConfig = $this->addImg($OgpConfig, $img_info);
            $OgpConfig->title = $blogPost->title;
            $OgpConfig->description = $blogPost->detail;
        } else {
            $OgpConfig = $this->contentInfo($OgpConfig);
        }
        return $OgpConfig;
    }

    /**
     * リクエストからpost_idを、無理やり抽出
     *
     * @param [type] $text
     * @return int 
     */
    public function extractNumberFromText($text)
    {
        if (strpos($text, 'archives') !== false) {
            $parts = explode('/', $text);
            foreach ($parts as $part) {
                if (is_numeric($part) && intval($part) > 0) {
                    return intval($part);
                }
            }
        }
        return null;
    }

    /**
     * ?から後ろを削除
     *
     * @param [type] $path
     * @return string
     */
    public function removeCacheBuster($path)
    {
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }
}
