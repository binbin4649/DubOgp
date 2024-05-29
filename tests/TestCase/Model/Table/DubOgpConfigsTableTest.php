<?php
declare(strict_types=1);
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.7
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace DubOgp\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use DubOgp\Model\Table\DubOgpConfigsTable;
use Cake\Validation\Validator;

/**
 * DubOgp\Model\Table\DubOgpConfigsTable Test Case
 */
class DubOgpConfigsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \DubOgp\Model\Table\DubOgpConfigsTable
     */
    protected $DubOgpConfigs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'plugin.DubOgp.DubOgpConfigs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('DubOgpConfigs') ? [] : ['className' => DubOgpConfigsTable::class];
        $this->DubOgpConfigs = $this->getTableLocator()->get('DubOgpConfigs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->DubOgpConfigs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \DubOgp\Model\Table\DubOgpConfigsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $validator = new Validator();
        $this->DubOgpConfigs->validationDefault($validator);
        $data = [];
        $errors = $validator->validate($data);
        $this->assertNotEmpty($errors);
    }

    /**
     * テーブルが存在し、DBとの接続が確立していることを確認するテスト
     *
     * @return void
     */
    public function testTableExistsAndDbConnection(): void
    {
        $this->assertTrue($this->DubOgpConfigs->getConnection()->isConnected());
        $this->assertEquals('dub_ogp_configs', $this->DubOgpConfigs->getTable());
    }

    /**
     * データを取り出すテスト
     *
     * @return void
     */
    public function testFetchDataById(): void
    {
        $result = $this->DubOgpConfigs->get(1);
        $this->assertNotEmpty($result);
        $this->assertEquals(1, $result->id);
        $this->assertEquals('twitter_id', $result->name);
        $this->assertEquals('binbin4649', $result->value);
    }

    /**
     * BaserCore.BcKeyValue behaviorが読み込まれているかのテスト
     *
     * @return void
     */
    public function testBehaviorLoaded(): void
    {
        $this->assertTrue($this->DubOgpConfigs->hasBehavior('BcKeyValue'));
    }

    /**
     * validationKeyValueメソッドのテスト
     *
     * @return void
     */
    public function testValidationKeyValue(): void
    {
        $validator = new Validator();
        $this->DubOgpConfigs->validationKeyValue($validator);
        $data = [
            'twitter_id' => 'binbin4649',
            'twitter_card' => '',
            'facebook_app_id' => '1234567890',
            'default_image' => 'image.jpg',
            'locale' => 'en_US',
            'locale_alternate' => 'ja_JP'
        ];
        $errors = $validator->validate($data);
        $this->assertEmpty($errors);

        // 不正なデータでのテスト
        $invalidData = [
            'twitter_id' => 'binbin4649@',
            'facebook_app_id' => '12345@67890',
            'default_image' => 'image@.jpg',
            'locale' => 'en-US',
            'locale_alternate' => 'ja-JP'
        ];
        $errors = $validator->validate($invalidData);
        $this->assertNotEmpty($errors);
    }

}
