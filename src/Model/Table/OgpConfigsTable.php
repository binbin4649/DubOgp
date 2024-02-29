<?php

namespace DubOgp\Model\Table;

use Cake\Validation\Validator;

class OgpConfigsTable extends OgpAppTable
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->addBehavior('BaserCore.BcKeyValue');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255, __d('baser_core', '255文字以内で入力してください。'))
            ->requirePresence('name', 'create', __d('baser_core', '設定名を入力してください。'))
            ->notEmptyString('name', __d('baser_core', '設定名を入力してください。'));
        $validator
            ->scalar('value')
            ->maxLength('value', 65535, __d('baser_core', '65535文字以内で入力してください。'));
        return $validator;
    }

    public function validationKeyValue(Validator $validator): Validator
    {
        $validator
            ->scalar('site_name')
            ->notEmptyString('site_name', __d('baser_core', 'Webサイト名を入力してください。'));
        return $validator;
    }
    
}