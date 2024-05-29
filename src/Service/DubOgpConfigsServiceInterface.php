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

namespace DubOgp\Service;

use \Cake\Datasource\EntityInterface;

/**
 * DubOgpConfigs Service Interface
 */
interface DubOgpConfigsServiceInterface
{

    /**
     * get new
     * @return \Cake\Datasource\EntityInterface
     */
    public function getNew(): \Cake\Datasource\EntityInterface;

    /**
     * get
     * @param 
     * @return \Cake\Datasource\EntityInterface
     */
    public function get(): \Cake\Datasource\EntityInterface;

    /**
     * get list
     * @param array $queryParams
     * @return array
     */
    public function getList(array $queryParams = []): array;

    /**
     * get index
     * @return \Cake\Datasource\QueryInterface
     */
	  public function getIndex(array $queryParams = []): \Cake\Datasource\QueryInterface;

    /**
     * create conditions
     * @param \Cake\Datasource\QueryInterface $query
     * @return \Cake\Datasource\QueryInterface
     */
	  public function createConditions(\Cake\Datasource\QueryInterface $query, array $queryParams = []);

    /**
     * create
     * @param array $postData
     * @return \Cake\Datasource\EntityInterface|null
     */
    public function create(array $postData): ?\Cake\Datasource\EntityInterface;

    /**
     * edit
     * @param array $postData
     * @return \Cake\Datasource\EntityInterface|null
     */
    public function update(array $postData): ?EntityInterface;

    /**
     * delete
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

}