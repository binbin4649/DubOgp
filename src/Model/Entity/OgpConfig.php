<?php

namespace DubOgp\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

class OgpConfig extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
    
}