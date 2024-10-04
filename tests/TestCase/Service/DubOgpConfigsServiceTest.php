<?php

namespace DubOgp\Test\TestCase\Service;

use Cake\TestSuite\TestCase;
use Cake\Datasource\EntityInterface;
use DubOgp\Service\DubOgpConfigsService;
use Cake\ORM\Exception\PersistenceFailedException;

class DubOgpConfigsServiceTest extends TestCase
{
    public $DubOgpConfigsService;

    protected array $fixtures = [
        'plugin.DubOgp.DubOgpConfigs',
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->DubOgpConfigsService = new DubOgpConfigsService();
    }

    public function tearDown(): void
    {
        unset($this->DubOgpConfigsService);
        parent::tearDown();
    }

    public function testGet()
    {
        $result = $this->DubOgpConfigsService->get();
        $this->assertInstanceOf(EntityInterface::class, $result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey('twitter_id', $result);
        $this->assertArrayHasKey('twitter_card', $result);
        $this->assertArrayHasKey('facebook_app_id', $result);
        $this->assertArrayHasKey('default_image', $result);
    }

    public function testUpdate()
    {
        $postData = [
            'twitter_id' => 'new_twitter_id',
            'twitter_card' => 'summary_large_image',
            'facebook_app_id' => '1234567890',
            'default_image' => 'new_default_image.jpg',
            'locale' => 'en_US',
            'locale_alternate' => 'ja_JP'
        ];

        $result = $this->DubOgpConfigsService->update($postData);
        $this->assertInstanceOf(EntityInterface::class, $result);
        $this->assertEquals('new_twitter_id', $result->twitter_id);
        $this->assertEquals('summary_large_image', $result->twitter_card);
        $this->assertEquals('1234567890', $result->facebook_app_id);
        $this->assertEquals('new_default_image.jpg', $result->default_image);
        $this->assertEquals('en_US', $result->locale);
        $this->assertEquals('ja_JP', $result->locale_alternate);
    }

    public function testUpdateFailure()
    {
        $invalidPostData = [
            'twitter_id' => '@invalid_idお',
            'twitter_card' => 'large_image',
            'facebook_app_id' => '12345@67890お',
            'default_image' => 'invalid_image@.jpg',
            'locale' => 'en-USお',
            'locale_alternate' => 'ja-JPお'
        ];
        try {
            $this->DubOgpConfigsService->update($invalidPostData);
        } catch (PersistenceFailedException $e) {
            $errors = $e->getEntity()->getErrors();
            $this->assertArrayHasKey('twitter_id', $errors);
            $this->assertArrayHasKey('facebook_app_id', $errors);
            $this->assertArrayHasKey('default_image', $errors);
            $this->assertArrayHasKey('locale', $errors);
            $this->assertArrayHasKey('locale_alternate', $errors);
            $this->assertEquals('半角英数とドットのみ', $errors['default_image']['alphaNumericPlus']);
            $this->assertEquals('半角英数のみ', $errors['twitter_id']['alphaNumericPlus']);
            $this->assertEquals('半角英数のみ', $errors['facebook_app_id']['alphaNumericPlus']);
            $this->assertEquals('半角英数のみ', $errors['locale']['alphaNumericPlus']);
            $this->assertEquals('半角英数のみ', $errors['locale_alternate']['alphaNumericPlus']);
        }
    }
}
