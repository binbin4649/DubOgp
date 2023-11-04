<?php

namespace DubOgp\Controller\Admin;

use DubOgp\Service\OgpConfigsServiceInterface;
use Psr\Http\Message\ResponseInterface;

class OgpConfigsController extends OgpAdminAppController
{
    public function index(OgpConfigsServiceInterface $service)
    {
        if ($this->request->is('post')) {
            $entity = $service->update($this->getRequest()->getData());
            if (!$entity->getErrors()) {
                $this->BcMessage->setInfo(__d('baser_core', 'OGPプラグイン設定を保存しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
        } else {
            $entity = $service->get();
        }
        $this->set(['entity' => $entity]);
    }
}