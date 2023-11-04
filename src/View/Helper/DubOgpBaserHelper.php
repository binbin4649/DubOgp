<?php

namespace DubOgp\View\Helper;

use BaserCore\View\Helper\BcPluginBaserHelperInterface;
use Cake\View\Helper;

/**
 * BlogBaserヘルパー
 *
 * BcBaserHelper より透過的に呼び出される
 *
 * 《利用例》
 * $this->BcBaser->blogPosts('news')
 *
 * BcBaserHeleper へのインターフェイスを提供する役割だけとし、
 * 実装をできるだけこのクラスで持たないようにし、BlogHelper 等で実装する
 *
 * @property BlogHelper $Blog
 */
class DubOgpBaserHelper extends Helper implements BcPluginBaserHelperInterface
{
    public $helpers = ['DubOgp.Ogp'];

    public function methods(): array {
        return [];
    }
    

}