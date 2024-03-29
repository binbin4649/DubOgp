<?php

namespace DubOgp\Service;

use DubOgp\Model\Entity\OgpConfig;
use DubOgp\Model\Table\OgpConfigsTable;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;

class OgpConfigsService implements OgpConfigsServiceInterface
{
    /**
     * OgpConfigs Table
     * @var OgpConfigsTable
     */
    public $OgpConfigs;

    /**
     * キャッシュ用 Entity
     * @var OgpConfig
     */
    protected $entity;

    public function __construct()
    {
        $this->OgpConfigs = TableRegistry::getTableLocator()->get('DubOgp.OgpConfigs');
    }

    public function getValue($fieldName): ?string
    {
        $entity = $this->get();
        return $entity->{$fieldName};
    }

    public function get(): OgpConfig
    {
        if (!$this->entity) {
            $this->entity = $this->OgpConfigs->newEntity(
                $this->OgpConfigs->getKeyValue(),
                ['validate' => 'keyValue']
            );
        }
        return $this->entity;
    }

    public function update(array $postData)
    {
        $entity = $this->OgpConfigs->newEntity($postData, ['validate' => 'keyValue']);
        if ($entity->hasErrors()) {
            return $entity;
        }
        $entityArray = $entity->toArray();
        if ($this->OgpConfigs->saveKeyValue($entityArray)) {
            $this->clearCache();
            return $this->get();
        }
        return false;
    }

    public function setValue($name, $value)
    {
        return $this->update([$name => $value]);
    }

    public function resetValue($name)
    {
        return $this->setValue($name, '');
    }

    public function clearCache()
    {
        $this->entity = null;
    }    

}
