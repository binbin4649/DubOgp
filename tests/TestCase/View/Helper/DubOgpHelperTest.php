<?php

namespace DubOgp\Test\TestCase\View\Helper;

use Cake\View\View;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;
use Cake\Http\ServerRequest;
use DubOgp\View\Helper\DubOgpHelper;
use DubOgp\Service\DubOgpConfigsService;
use DubOgp\Service\DubOgpConfigsServiceInterface;
use League\Container\Container;

use BaserCore\Test\Factory\ContentFactory;
use BcBlog\Test\Factory\BlogContentFactory;
use BcBlog\View\BlogFrontAppView;
use BcBlog\Test\Scenario\BlogContentScenario;
use BcBlog\View\Helper\BlogHelper;
use CakephpFixtureFactories\Scenario\ScenarioAwareTrait;

class DubOgpHelperTest extends TestCase
{   
    use ScenarioAwareTrait;
    
    private $container;
    private $DubOgpHelper;

    protected $fixtures = [
        'plugin.DubOgp.DubOgpConfigs',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->DubOgpHelper = new DubOgpHelper($view);
    }

    public function tearDown(): void
    {
        unset($this->DubOgpHelper);
        parent::tearDown();
    }

    public function testShowOgp()
    {
        $this->DubOgpHelper->showOgp();
        $output = $this->view->fetch('content');
        $this->assertStringContainsString('<meta property="og:', $output, 'OGPメタタグが出力されていません。');
    }

    public function testOgpInfo()
    {
        $request = new ServerRequest();
        $sitesTable = TableRegistry::getTableLocator()->get('Sites');
        $site = $sitesTable->newEntity([
            'title' => 'Test Site',
            'lang' => 'ja'
        ]);
        $request = $request->withAttribute('currentSite', $site);
        $requestMock = $this->getMockBuilder('Cake\Http\ServerRequest')
                            ->setMethods(['getUri'])
                            ->getMock();
        $requestMock->method('getUri')
                    ->willReturn(new \Laminas\Diactoros\Uri('/'));
        $requestMock = $requestMock->withAttribute('currentSite', $site);
        $this->DubOgpHelper->getView()->setRequest($requestMock);
        
        $result = $this->DubOgpHelper->ogpInfo();
        var_dump($result);
        die;
    }

    public function testOgpInfoRequestPath()
    {
        $request = new ServerRequest(['url' => '/test-path']);
        $sitesTable = TableRegistry::getTableLocator()->get('Sites');
        $site = $sitesTable->newEntity([
            'title' => 'Test Site',
            'lang' => 'ja',
            'display_name' => 'Test Site',
        ]);
        $request = $request->withAttribute('currentSite', $site);
        $requestMock = $this->getMockBuilder('Cake\Http\ServerRequest')
                            ->setMethods(['getUri', 'getPath'])
                            ->getMock();
        $requestMock->method('getUri')
                    ->willReturn(new \Laminas\Diactoros\Uri('/test-path'));
        $requestMock->method('getPath')
                    ->willReturn('/test-path');
        $requestMock = $requestMock->withAttribute('currentSite', $site);
        $this->DubOgpHelper->getView()->setRequest($requestMock);
        
        $result = $this->DubOgpHelper->ogpInfo();
        var_dump($result);
        die;
        $this->assertEquals('/test-path', $this->DubOgpHelper->getView()->getRequest()->getPath(), 'リクエストパスが正しく取得できませんでした。');
    }

}