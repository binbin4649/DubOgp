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

namespace DubOgp\View\Helper;

use BaserCore\View\Helper\BcPluginBaserHelperInterface;
use Cake\View\Helper;

/**
 * DubOgp Baser Helper
 */
class DubOgpBaserHelper extends Helper implements BcPluginBaserHelperInterface
{

    /**
     * Helper
     * @var array
     */
    public $helpers = ['DubOgp.DubOgp'];

    /**
     * Method
     * @return array[]
     */
    public function methods(): array
    {
        return [
            'showOgp' => ['DubOgp', 'showOgp'],
        ];
    }
}
