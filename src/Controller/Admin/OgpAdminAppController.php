<?php

namespace DubOgp\Controller\Admin;

use BaserCore\Controller\Admin\BcAdminAppController;
use Cake\Event\EventInterface;

class OgpAdminAppController extends BcAdminAppController
{
    public function beforeRender(EventInterface $event): void
    {
        parent::beforeRender($event);
        // $this->viewBuilder()->setClassName('BcMail.MailAdminApp');
    }
}


