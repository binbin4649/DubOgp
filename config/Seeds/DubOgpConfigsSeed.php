<?php
declare(strict_types=1);

use BaserCore\Database\Migration\BcSeed;

class DubOgpConfigsSeed extends BcSeed
{
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'twitter_id',
                'value' => '',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => 2,
                'name' => 'twitter_card',
                'value' => '',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => 3,
                'name' => 'facebook_app_id',
                'value' => '',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => 4,
                'name' => 'default_image',
                'value' => '',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => 5,
                'name' => 'default_image',
                'value' => '',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => 6,
                'name' => 'locale',
                'value' => 'ja_JP',
                'created' => NULL,
                'modified' => NULL,
            ],
            [
                'id' => 7,
                'name' => 'locale_alternate',
                'value' => '',
                'created' => NULL,
                'modified' => NULL,
            ],
        ];

        $table = $this->table('dub_ogp_configs');
        $table->insert($data)->save();
    }
}