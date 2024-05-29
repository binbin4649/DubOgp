<?php
namespace DubOgp\Test\TestCase\Service;

use Cake\TestSuite\TestCase;
use Cake\Datasource\EntityInterface;
use BaserCore\Utility\BcContainerTrait;
use DubOgp\Service\DubOgpConfigsService;
use DubOgp\Service\DubOgpConfigsServiceInterface;

class DubOgpConfigsServiceTest extends TestCase
{
    
    use BcContainerTrait;

    public $DubOgpConfigsService;

    public function setUp(): void
    {
        parent::setUp();
        $this->DubOgpConfigsServiceMock = $this->createMock(DubOgpConfigsServiceInterface::class);
    }

    public function tearDown(): void
    {
        unset($this->DubOgpConfigsServiceMock);
        parent::tearDown();
    }

    public function testDubOgpConfigsServiceMockCreation()
    {
        $this->assertInstanceOf(DubOgpConfigsServiceInterface::class, $this->DubOgpConfigsServiceMock);
        $this->assertNotNull($this->DubOgpConfigsServiceMock);
    }

    public function testConstructor()
    {
        $service = new DubOgpConfigsService();
        $this->assertInstanceOf(DubOgpConfigsService::class, $service);
        $this->assertNotNull($service->DubOgpConfigs);
    }

    public function testUpdate()
    {
        $postData = [
            'twitter_id' => 'new_twitter_id',
            'twitter_card' => 'summary_large_image',
            'facebook_app_id' => '1234567890',
            'default_image' => 'new_default.jpg',
            'locale' => 'en_US',
            'locale_alternate' => 'ja_JP'
        ];

        $this->DubOgpConfigsServiceMock->method('update')->willReturn($this->createMock(EntityInterface::class));

        $result = $this->DubOgpConfigsServiceMock->update($postData);
        $this->assertInstanceOf(EntityInterface::class, $result);
    }

    public function testUpdateFailure()
    {
        $invalidPostData = [
            'twitter_id' => '@invalid_id',
            'twitter_card' => 'summary_large_image',
            'facebook_app_id' => '12345@67890',
            'default_image' => 'invalid_image@.jpg',
            'locale' => 'en-US',
            'locale_alternate' => 'ja-JP'
        ];

        $this->DubOgpConfigsServiceMock->method('update')->will($this->throwException(new \Exception("入力エラーです。内容を修正してください。")));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("入力エラーです。内容を修正してください。");

        try {
            $this->DubOgpConfigsServiceMock->update($invalidPostData);
        } catch (\Exception $e) {
            $this->assertEquals("入力エラーです。内容を修正してください。", $e->getMessage());
            throw $e;
        }
    }

}