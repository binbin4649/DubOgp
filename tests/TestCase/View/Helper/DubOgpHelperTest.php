<?php

namespace DubOgp\Test\TestCase\View\Helper;

use Cake\View\View;
use Cake\TestSuite\TestCase;
// use BaserCore\TestSuite\BcTestCase;
use BaserCore\Utility\BcUtil;
use Cake\ORM\TableRegistry;
use Cake\Http\ServerRequest;
use Cake\ORM\Entity;
use Cake\Core\Configure;
use Laminas\Diactoros\Uri;
use BcBlog\Test\Factory\BlogPostFactory;
use BcBlog\Test\Factory\BlogCategoryFactory;
use BcBlog\Test\Factory\BlogPostBlogTagFactory;
use BaserCore\Test\Factory\SiteFactory;
use BcBlog\Test\Factory\BlogTagFactory;
use BcBlog\Test\Factory\BlogContentFactory;
use BaserCore\Test\Factory\ContentFactory;
use BaserCore\Test\Factory\UserFactory;

use BcBlog\Service\BlogPostsService;
use DubOgp\View\Helper\DubOgpHelper;
use DubOgp\Service\DubOgpConfigsService;

use CakephpFixtureFactories\Scenario\ScenarioAwareTrait;

class DubOgpHelperTest extends TestCase
{
    private $container;
    private $DubOgpHelper;
    private $DubOgpConfigsService;

    use ScenarioAwareTrait;

    public array $fixtures = [
        'plugin.DubOgp.DubOgpConfigs',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->DubOgpHelper = new DubOgpHelper($view);
        $this->DubOgpConfigsService = new DubOgpConfigsService();
        Configure::write('BcApp.coreFrontTheme', 'test_case');
    }

    public function tearDown(): void
    {
        unset($this->DubOgpHelper);
        parent::tearDown();
    }

    /**
     * blogInfoのテスト
     */
    public function testBlogInfo()
    {
        BlogPostFactory::make(['id' => 1, 'blog_content_id' => 1, 'blog_category_id' => 1, 'status' => true])->persist();
        BlogCategoryFactory::make(['id' => 1, 'blog_content_id' => 1, 'name' => 'category name'])->persist();
        // SiteFactory::make(['id' => 1, 'name' => 'site name'])->persist();
        BlogContentFactory::make(['id' => 1, 'description' => 'baser blog description', 'tag_use' => true])->persist();
        ContentFactory::make(['id' => 1, 'site_id' => 1, 'type' => 'BlogContent', 'entity_id' => 1, 'title' => 'content title'])->persist();
        UserFactory::make(['id' => 2, 'name' => 'test user1'])->persist();
        BlogTagFactory::make(['id' => 1])->persist();
        BlogTagFactory::make(['id' => 2])->persist();
        BlogPostBlogTagFactory::make(['blog_post_id' => 1, 'blog_tag_id' => 1])->persist();
        BlogPostBlogTagFactory::make(['blog_post_id' => 1, 'blog_tag_id' => 2])->persist();

        $OgpConfig = $this->DubOgpConfigsService->get();

        $request = new ServerRequest([
            'uri' => new Uri('/news/archives/1')
        ]);
        $view = new View();
        $view->setRequest($request);
        $this->DubOgpHelper = new DubOgpHelper($view);

        $result = $this->DubOgpHelper->blogInfo($OgpConfig);

        $this->assertEquals('binbin4649', $result->twitter_id);
        $this->assertNotEmpty($result->title);
        $this->assertNotEmpty($result->description);
        $this->assertNotEmpty($result->img_height);
        $this->assertNotEmpty($result->img_width);
        $this->assertEquals('http://localhost/img/basercms.png', $result->img_url);
    }



    /**
     * contentInfoのテスト
     */
    public function testContentInfo()
    {
        // テスト用のデータを準備
        $content = [
            'eyecatch' => 'test_eyecatch.jpg',
            'title' => 'テストタイトル',
            'description' => 'テスト説明'
        ];

        // BcContentsHelperのモックを作成
        $mockBcContents = $this->getMockBuilder('BaserCore\View\Helper\BcContentsHelper')
            ->disableOriginalConstructor()
            ->getMock();

        // BcContentsHelperのメソッドの振る舞いを設定
        $mockBcContents->method('getCurrentContent')->willReturn((object)$content);

        // BcBaserHelperのモックを作成
        $mockBcBaser = $this->getMockBuilder('BaserCore\View\Helper\BcBaserHelper')
            ->disableOriginalConstructor()
            ->getMock();

        // BcBaserHelperのメソッドの振る舞いを設定
        $mockBcBaser->method('getTitle')->willReturn($content['title']);
        $mockBcBaser->method('getDescription')->willReturn($content['description']);

        // DubOgpHelperのモックを作成
        $mockHelper = $this->getMockBuilder(DubOgpHelper::class)
            ->setConstructorArgs([new View()])
            ->onlyMethods(['uploadImageInfo'])
            ->getMock();

        // モックをDubOgpHelperにセット
        $mockHelper->BcContents = $mockBcContents;
        $mockHelper->BcBaser = $mockBcBaser;

        $mockHelper->method('uploadImageInfo')
            ->willReturn([
                'img_url' => 'http://example.com/test_eyecatch.jpg',
                'img_height' => 300,
                'img_width' => 400
            ]);

        // テスト実行
        $OgpConfig = $this->DubOgpConfigsService->getNew();
        $result = $mockHelper->contentInfo($OgpConfig);

        // アサーション
        $this->assertEquals('テストタイトル', $result->title);
        $this->assertEquals('テスト説明', $result->description);
        $this->assertEquals('http://example.com/test_eyecatch.jpg', $result->img_url);
        $this->assertEquals(300, $result->img_height);
        $this->assertEquals(400, $result->img_width);
    }


    /**
     * uploadImageInfoのテスト
     */
    public function testUploadImageInfo()
    {
        $entity = [
            'image' => 'test_image.jpg'
        ];
        // テスト用の設定
        $options = [
            'table' => 'TestTable',
            'limited' => false
        ];

        // テスト用のディレクトリとファイルを作成
        $testDir = TMP . 'tests' . DS . 'upload' . DS;
        if (!file_exists($testDir)) {
            mkdir($testDir, 0777, true);
        }
        $testFile = $testDir . 'test_image.jpg';
        copy(WWW_ROOT . 'img' . DS . 'cake-logo.png', $testFile);

        // テスト用のテーブルを作成
        $table = TableRegistry::getTableLocator()->get('TestTable');
        $table->setTable('test_table');
        $table->addBehavior('BaserCore.BcUpload', [
            'saveDir' => $testDir,
            'fields' => ['image' => []]
        ]);

        // テスト実行
        $result = $this->DubOgpHelper->uploadImageInfo('image', $entity, $options);

        // アサーション
        $this->assertNotFalse($result['img_url']);
        $this->assertNotFalse($result['img_height']);
        $this->assertNotFalse($result['img_width']);

        // テスト用のファイルとディレクトリを削除
        unlink($testFile);
        rmdir($testDir);
    }


    /**
     * returnImgのテスト
     */
    public function testReturnImg()
    {
        // 存在する画像ファイルのテスト
        $fullUrl = 'http://localhost/img/cake-logo.png';
        $fullPath = '/var/www/html/webroot/img/cake-logo.png';
        $result = $this->DubOgpHelper->returnImg($fullUrl, $fullPath);
        $this->assertEquals($fullUrl, $result['img_url']);
        $this->assertEquals(226, $result['img_height']);
        $this->assertEquals(45, $result['img_width']);

        // 存在しない画像ファイルのテスト
        $nonExistentUrl = 'http://example.com/nonexistent.jpg';
        $nonExistentPath = TESTS . 'test_app' . DS . 'webroot' . DS . 'img' . DS . 'nonexistent.jpg';
        $result = $this->DubOgpHelper->returnImg($nonExistentUrl, $nonExistentPath);
        $this->assertFalse($result['img_url']);
        $this->assertFalse($result['img_height']);
        $this->assertFalse($result['img_width']);

        // ディレクトリのパスが与えられた場合のテスト
        $dirUrl = 'http://example.com/img/';
        $dirPath = TESTS . 'test_app' . DS . 'webroot' . DS . 'img';
        $result = $this->DubOgpHelper->returnImg($dirUrl, $dirPath);
        $this->assertFalse($result['img_url']);
        $this->assertFalse($result['img_height']);
        $this->assertFalse($result['img_width']);
    }

    /**
     * addImgのテスト
     */
    public function testAddImg()
    {
        // テスト用のOgpConfigオブジェクトを作成
        $OgpConfig = new \stdClass();

        // 画像情報がある場合のテスト
        $imgInfo = [
            'img_url' => 'http://example.com/test.jpg',
            'img_height' => 300,
            'img_width' => 400
        ];
        $result = $this->DubOgpHelper->addImg($OgpConfig, $imgInfo);
        $this->assertEquals('http://example.com/test.jpg', $result->img_url);
        $this->assertEquals(300, $result->img_height);
        $this->assertEquals(400, $result->img_width);

        // 画像情報がない場合のテスト
        $emptyImgInfo = [
            'img_url' => false,
            'img_height' => false,
            'img_width' => false
        ];
        $result = $this->DubOgpHelper->addImg($OgpConfig, $emptyImgInfo);
        $this->assertEquals('http://localhost/img/basercms.png', $result->img_url);
        $this->assertEquals(441, $result->img_height);
        $this->assertEquals(79, $result->img_width);
    }

    /**
     * getDefaultImageのテスト
     */
    public function testGetDefaultImage()
    {
        // テスト用のOgpConfigオブジェクトを作成
        $OgpConfig = new \stdClass();
        $OgpConfig->default_image = 'cake-logo.png';

        // WWW_ROOTとBcUtil::getCurrentTheme()をモック
        if (!defined('WWW_ROOT')) {
            define('WWW_ROOT', '/var/www/html/webroot/');
        }
        $viewMock = $this->getMockBuilder(View::class)
            ->onlyMethods(['element'])
            ->getMock();

        // DubOgpHelperのインスタンスを作成し、モックされたViewを使用
        /** @var \Cake\View\View|\PHPUnit\Framework\MockObject\MockObject $viewMock */
        $dubOgpHelper = new DubOgpHelper($viewMock);

        // ケース1: デフォルト画像が存在する場合
        $this->assertTrue(file_exists(WWW_ROOT . 'img/' . $OgpConfig->default_image));
        $result = $dubOgpHelper->getDefaultImage($OgpConfig);
        $this->assertEquals('http://localhost/img/cake-logo.png', $result['img_url']);

        // ケース2: デフォルト画像が存在しない場合
        unset($OgpConfig->default_image);
        $result = $dubOgpHelper->getDefaultImage($OgpConfig);
        $this->assertEquals('http://localhost/img/basercms.png', $result['img_url']);
    }

    /**
     * extractNumberFromTextのテスト
     */
    public function testExtractNumberFromText()
    {
        // 'archives'を含み、数字が存在するパス
        $pathWithNumber = '/blog/archives/123';
        $result = $this->DubOgpHelper->extractNumberFromText($pathWithNumber);
        $this->assertEquals(123, $result, '正しい数字が抽出されていません');

        // 'archives'を含むが、数字が存在しないパス
        $pathWithoutNumber = '/blog/archives/category/test';
        $result = $this->DubOgpHelper->extractNumberFromText($pathWithoutNumber);
        $this->assertNull($result, '数字が存在しない場合、nullが返されるべきです');

        // 'archives'を含まないパス
        $pathWithoutArchives = '/blog/category/test';
        $result = $this->DubOgpHelper->extractNumberFromText($pathWithoutArchives);
        $this->assertNull($result, "'archives'を含まないパスの場合、nullが返されるべきです");

        // 複数の数字を含むパス
        $pathWithMultipleNumbers = '/blog/archives/123/456';
        $result = $this->DubOgpHelper->extractNumberFromText($pathWithMultipleNumbers);
        $this->assertEquals(123, $result, '複数の数字がある場合、最初の数字が抽出されるべきです');

        // 0を含むパス
        $pathWithZero = '/blog/archives/0';
        $result = $this->DubOgpHelper->extractNumberFromText($pathWithZero);
        $this->assertNull($result, '0は有効な投稿IDとして扱われるべきではありません');
    }

    /**
     * removeCacheBusterのテスト
     */
    public function testRemoveCacheBuster()
    {
        // キャッシュバスターを含むパス
        $pathWithCacheBuster = '/img/logo.png?v=1234567890';
        $expectedPath = '/img/logo.png';
        $result = $this->DubOgpHelper->removeCacheBuster($pathWithCacheBuster);
        $this->assertEquals($expectedPath, $result, 'キャッシュバスターが正しく削除されていません');

        // キャッシュバスターを含まないパス
        $pathWithoutCacheBuster = '/img/logo.png';
        $result = $this->DubOgpHelper->removeCacheBuster($pathWithoutCacheBuster);
        $this->assertEquals($pathWithoutCacheBuster, $result, 'キャッシュバスターがない場合、パスは変更されるべきではありません');

        // 複数のクエリパラメータを含むパス
        $pathWithMultipleParams = '/img/logo.png?v=1234567890&test=true';
        $result = $this->DubOgpHelper->removeCacheBuster($pathWithMultipleParams);
        $this->assertEquals($expectedPath, $result, '複数のクエリパラメータがある場合でも、正しく処理されるべきです');

        // 空のパス
        $emptyPath = '';
        $result = $this->DubOgpHelper->removeCacheBuster($emptyPath);
        $this->assertEquals($emptyPath, $result, '空のパスが正しく処理されるべきです');
    }
}
