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

namespace DubOgp\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use BaserCore\Model\Behavior\BcKeyValueBehavior;

/**
 * DubOgpConfigs Model
 *
 * @method \DubOgp\Model\Entity\DubOgpConfig newEmptyEntity()
 * @method \DubOgp\Model\Entity\DubOgpConfig newEntity(array $data, array $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig[] newEntities(array $data, array $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig get($primaryKey, $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \DubOgp\Model\Entity\DubOgpConfig[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DubOgpConfigsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('dub_ogp_configs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('BaserCore.BcKeyValue');
    }

    /**
     * beforeMarshal イベントのコード
     *
     * @param \Cake\Event\EventInterface $event イベントオブジェクト
     * @param \ArrayObject $data データ
     * @param \ArrayObject $options オプション
     * @return void
     */
    public function beforeMarshal(\Cake\Event\EventInterface $event, \ArrayObject $data, \ArrayObject $options): void
    {
        if (isset($data['twitter_id']) && strpos($data['twitter_id'], '@') === 0) {
            $data['twitter_id'] = substr($data['twitter_id'], 1);
        }
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('value')
            ->maxLength('value', 255);

        return $validator;
    }

    public function validationKeyValue(Validator $validator): Validator
    {
        $validator
            ->allowEmptyString('twitter_id')
            ->add('twitter_id', [
                'alphaNumericPlus' => [
                    'rule' => ['alphaNumericPlus'],
                    'provider' => 'bc',
                    'message' => '半角英数のみ'
                ]
            ]);
        
        $validator->allowEmptyString('twitter_card');
        
        $validator
            ->allowEmptyString('facebook_app_id')
            ->add('facebook_app_id', [
                'alphaNumericPlus' => [
                    'rule' => ['alphaNumericPlus', ' \.:\/\(\)#,@\[\]\+=&;\{\}!\$\*'],
                    'provider' => 'bc',
                    'message' => '半角英数のみ'
                ]
            ]);
        
        $validator
            ->allowEmptyString('default_image')
            ->add('default_image', [
                'alphaNumericPlus' => [
                    'rule' => ['alphaNumericPlus', ' \.'],
                    'provider' => 'bc',
                    'message' => '半角英数とドットのみ'
                ]
            ]);
        
        $validator
            ->allowEmptyString('locale')
            ->add('locale', [
                'alphaNumericPlus' => [
                    'rule' => ['alphaNumericPlus'],
                    'provider' => 'bc',
                    'message' => '半角英数のみ'
                ]
            ]);
        
        $validator
            ->allowEmptyString('locale_alternate')
            ->add('locale_alternate', [
                'alphaNumericPlus' => [
                    'rule' => ['alphaNumericPlus'],
                    'provider' => 'bc',
                    'message' => '半角英数のみ'
                ]
            ]);
        return $validator;
    }
}
