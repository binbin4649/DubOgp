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
use Cake\TestSuite\TestCase;
use DubOgp\Controller\Admin\DubOgpConfigsController;

/**
 * DubOgp\Controller\Admin\DubOgpConfigsController Test Case
 *
 * @uses \DubOgp\Controller\Admin\DubOgpConfigsController
 */
class DubOgpConfigsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    protected $fixtures = [
        'plugin.DubOgp.DubOgpConfigs',
    ];
    
    /**
     * Test index method
     */
    public function testIndex(): void
    {
        $this->get('/baser/admin/dub-ogp/dub_ogp_configs/index');
        $this->assertResponseOk();
        // 成功時とエラー時のレスポンスを確認するために、条件分岐を模擬する必要があります。
        // 以下は成功時のテストケース
        $this->assertResponseContains('設定を保存しました。'); // 成功メッセージが表示されることを確認

        // 以下はエラー時のテストケース
        // エラー時のレスポンスを確認するためには、エラーを引き起こすようなリクエストを模擬する必要があります。
        // この部分はコメントアウトしておき、実際のエラーケースをテストする際に適切なリクエストデータを設定してください。
        // $this->post('/admin/dub-ogp/configs', $errorData); // エラーを引き起こすデータをPOST
        // $this->assertResponseContains('入力エラーです。内容を修正してください。'); // エラーメッセージが表示されることを確認
    }
}
