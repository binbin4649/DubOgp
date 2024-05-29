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

return [
    'BcApp' => [
        /**
          * System Navigation
          */
        'adminNavigation' => [
            'Plugins' => [
                'menus' => [
                    'DubOgpConfigs' => [
                        'title' => __d('baser_core', 'OGP設定'),
                        'url' => [
                            'prefix' => 'Admin',
                            'plugin' => 'DubOgp',
                            'controller' => 'DubOgpConfigs',
                            'action' => 'index'
                        ]
                    ]
                ]
            ]
        ]
    ],

    // Add your plugin's configuration here
    'DubOgp' => [
        'twitterCards' => [
            'summary' => 'summary',
            'summary_large_image' => 'summary_large_image',
            'app' => 'app',
            'player' => 'player'
        ]
    ]

];