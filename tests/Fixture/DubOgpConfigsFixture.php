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

namespace DubOgp\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DubOgpConfigsFixture
 */
class DubOgpConfigsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'name' => 'twitter_id',
                'value' => 'binbin4649',
                'created' => '2024-04-09 11:21:54',
                'modified' => '2024-04-09 11:21:54',
            ],
            [
                'name' => 'twitter_card',
                'value' => 'summary',
                'created' => '2024-04-09 11:21:54',
                'modified' => '2024-04-09 11:21:54',
            ],
            [
                'name' => 'facebook_app_id',
                'value' => '',
                'created' => '2024-04-09 11:21:54',
                'modified' => '2024-04-09 11:21:54',
            ],
            [
                'name' => 'default_image',
                'value' => '',
                'created' => '2024-04-09 11:21:54',
                'modified' => '2024-04-09 11:21:54',
            ],
            [
                'name' => 'locale',
                'value' => '',
                'created' => '2024-04-09 11:21:54',
                'modified' => '2024-04-09 11:21:54',
            ],
            [
                'name' => 'locale_alternate',
                'value' => '',
                'created' => '2024-04-09 11:21:54',
                'modified' => '2024-04-09 11:21:54',
            ],
        ];
        parent::init();
    }
}
