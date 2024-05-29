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

use DubOgp\Model\Entity\DubOgpConfig;
use DubOgp\Model\Table\DubOgpConfigsTable;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Exception\PersistenceFailedException;

/**
 * DubOgpConfigs Service
 */
class DubOgpConfigsService implements DubOgpConfigsServiceInterface
{
    /**
     * MailConfigs Table
     * @var MailConfigsTable
     */
    public DubOgpConfigsTable|Table $DubOgpConfigs;

    /**
     * キャッシュ用 Entity
     * @var MailConfig
     */
    protected $entity;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->DubOgpConfigs = TableRegistry::getTableLocator()->get('DubOgp.DubOgpConfigs');
    }

    /**
     * get new
     * @return \Cake\Datasource\EntityInterface
     */
    public function getNew(): \Cake\Datasource\EntityInterface
    {
        return $this->DubOgpConfigs->newEntity([], [
			'validate' => false,
		]);
    }

    /**
     * get
     * @param 
     * @return \Cake\Datasource\EntityInterface
     */
    // public function get(int $id, array $options = []): \Cake\Datasource\EntityInterface
    // {
    //     return $this->DubOgpConfigs->get($id, [
    //         'contain' => [],
    //     ]);
    // }
    public function get(): EntityInterface
    {
        if (!$this->entity) {
            $this->entity = $this->DubOgpConfigs->newEntity(
                $this->DubOgpConfigs->getKeyValue(),
                ['validate' => 'keyValue']
            );
        }
        return $this->entity;
    }

    /**
     * get list
     * @param array $queryParams
     * @return array
     */
    public function getList(array $queryParams = []): array
    {
        return $this->createConditions($this->DubOgpConfigs->find('list'), $queryParams)->toArray();
    }

    /**
     * get index
     * @return \Cake\Datasource\QueryInterface
     */
    public function getIndex(array $queryParams = []): \Cake\Datasource\QueryInterface
    {
        return $this->createConditions($this->DubOgpConfigs->find(), $queryParams);
    }

    /**
     * create conditions
     * @param \Cake\Datasource\QueryInterface $query
     * @return \Cake\Datasource\QueryInterface
     */
    public function createConditions(\Cake\Datasource\QueryInterface $query, array $queryParams = [])
    {
        return $query;
    }

    /**
     * create
     * @param array $postData
     * @return \Cake\Datasource\EntityInterface|null
     */
    public function create(array $postData): ?\Cake\Datasource\EntityInterface
    {
        $entity = $this->DubOgpConfigs->newEntity($postData);
        return $this->DubOgpConfigs->saveOrFail($entity);
    }

    /**
     * edit
     * @param \Cake\Datasource\EntityInterface $target
     * @param array $postData
     * @return \Cake\Datasource\EntityInterface|null
     */
    // public function update(EntityInterface $target, array $postData): ?EntityInterface
    // {
    //     $user = $this->DubOgpConfigs->patchEntity($target, $postData);
    //     return $this->DubOgpConfigs->saveOrFail($user);
    // }

    public function update(array $postData): ?EntityInterface
    {
        $entity = $this->DubOgpConfigs->newEntity($postData, ['validate' => 'keyValue']);
        if ($entity->hasErrors()) {
            throw new PersistenceFailedException($entity, __d('baser_core', '入力エラーです。内容を修正してください。'));
        }

        $entityArray = $entity->toArray();
        if ($this->DubOgpConfigs->saveKeyValue($entityArray)) {
            $this->entity = null;
            return $this->get();
        }
        return false;
    }

    /**
     * delete
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $user = $this->get($id);
        return $this->DubOgpConfigs->delete($user);
    }

}