<?php

return [
    'BcApp' => [
        /**
         * システムナビ
         * メールコンテンツ系のメニューは BcMailViewEventListener::beforeRender() にて実装
         */
        'adminNavigation' => [
            'Plugins' => [
                'menus' => [
                    'OgpConfigs' => [
                        'title' => __d('baser_core', 'Ogp設定'),
                        'url' => [
                            'prefix' => 'Admin',
                            'plugin' => 'DubOgp',
                            'controller' => 'OgpConfigs',
                            'action' => 'index'
                        ]
                    ]
                ]
            ]
        ]
    ]
];