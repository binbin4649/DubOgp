<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       https://basercms.net/license/index.html MIT License
 */

$viewFilesPath = str_replace(ROOT, '', WWW_ROOT) . 'files';
return [
    'type' => 'Plugin',
    'title' => __d('baser_core', 'OGPプラグイン [DubOgp]'),
    'description' => __d('baser_core', 'ヘッダーにOGPタグを出力するためのプラグイン。'),
    'author' => 'dubmilli LLC.',
    'url' => 'https://dubmilli.com/',
];
