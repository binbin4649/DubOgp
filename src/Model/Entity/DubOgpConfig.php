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

namespace DubOgp\Model\Entity;

use Cake\ORM\Entity;

/**
 * DubOgpConfig Entity
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class DubOgpConfig extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    // protected $_accessible = [
    //     '*' => true,
    // ];
    protected $_accessible = [
        'twitter_id' => true,
        'twitter_card' => true,
        'facebook_app_id' => true,
        'default_image' => true,
        'locale' => true,
        'locale_alternate' => true,
        'title' => true,
        'site_name' => true,
        'type' => true,
        'description' => true,
        'url' => true,
        'img_url' => true,
        'img_height' => true,
        'img_width' => true
    ];
}
