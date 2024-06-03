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
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'twitter_card',
                'value' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'facebook_app_id',
                'value' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'name' => 'default_image',
                'value' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 5,
                'name' => 'default_image',
                'value' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'name' => 'locale',
                'value' => 'ja_JP',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 7,
                'name' => 'locale_alternate',
                'value' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('dub_ogp_configs');
        $table->insert($data)->save();
    }
}