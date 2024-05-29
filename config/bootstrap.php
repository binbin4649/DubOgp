<?php

use Cake\Validation\Validator;

Validator::addDefaultProvider('bc', 'BaserCore\Model\Validation\BcValidation');