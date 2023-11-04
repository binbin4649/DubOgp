<?php
declare(strict_types=1);
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace DubOgp;

use BaserCore\BcPlugin;
use DubOgp\ServiceProvider\DubOgpServiceProvider;
use Cake\Core\ContainerInterface;

/**
 * plugin for BcPluginSample
 */
class Plugin extends BcPlugin {

    public function services(ContainerInterface $container): void
    {
        $container->addServiceProvider(new DubOgpServiceProvider());
    }

}
