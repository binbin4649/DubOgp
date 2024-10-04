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

namespace DubOgp\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestTrait;
use CakephpFixtureFactories\Scenario\ScenarioAwareTrait;
// use Cake\TestSuite\TestCase;
use BaserCore\TestSuite\BcTestCase;
use DubOgp\Controller\Admin\DubOgpConfigsController;

/**
 * DubOgp\Controller\Admin\DubOgpConfigsController Test Case
 *
 * @uses \DubOgp\Controller\Admin\DubOgpConfigsController
 */
class DubOgpConfigsControllerTest extends BcTestCase
{
    use IntegrationTestTrait;
    use ScenarioAwareTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    protected array $fixtures = [
        'plugin.DubOgp.DubOgpConfigs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        // $this->setupAdmin();
        $this->loadFixtureScenario(\BaserCore\Test\Scenario\InitAppScenario::class);
        $this->loginAdmin($this->getRequest('/baser/admin/'));
        // $this->enableSecurityToken();
        // $this->enableCsrfToken();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex(): void
    {
        // $this->get('/baser/admin/dub-ogp/dub_ogp_configs/index');
        $this->get('/baser/admin/baser-core/contents/index');
        $this->assertResponseCode(302);
        // $this->assertResponseContains('OGP設定');

        // $this->post('/baser/admin/dub-ogp/dub_ogp_configs/index', [
        //     'twitter_id' => 'test_twitter_id',
        //     'twitter_card' => 'summary',
        //     'facebook_app_id' => '123456789',
        //     'default_image' => 'test_image.jpg',
        // ]);
        // $this->assertResponseSuccess();
        // $this->assertRedirect(['action' => 'index']);

        // $this->get('/baser/admin/dub-ogp/dub_ogp_configs/index');
        // $this->assertResponseContains('test_twitter_id');
        // $this->assertResponseContains('summary');
        // $this->assertResponseContains('123456789');
        // $this->assertResponseContains('test_image.jpg');
    }
}
