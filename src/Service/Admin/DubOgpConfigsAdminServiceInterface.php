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

namespace DubOgp\Service\Admin;

/**
 * DubOgpConfigs Admin Service Interface
 */
interface DubOgpConfigsAdminServiceInterface extends \DubOgp\Service\DubOgpConfigsServiceInterface
{

    /**
     * get view vars for index
     * @param \Cake\Datasource\ResultSetInterface $dubOgpConfigs
     * @return array
     */
    public function getViewVarsForIndex(\Cake\Datasource\ResultSetInterface $dubOgpConfigs): array;

    /**
     * get view vars for add
     * @param \Cake\Datasource\EntityInterface $dubOgpConfig
     * @return array
     */
    public function getViewVarsForAdd(\Cake\Datasource\EntityInterface $dubOgpConfig): array;

    /**
     * get view vars for edit
     * @param \Cake\Datasource\EntityInterface $dubOgpConfig
     * @return array
     */
    public function getViewVarsForEdit(\Cake\Datasource\EntityInterface $dubOgpConfig): array;

    /**
     * get view vars for view
     * @return array
     */
    public function getViewVarsForView(\Cake\Datasource\EntityInterface $dubOgpConfig): array;

}
