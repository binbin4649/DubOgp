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

namespace DubOgp\Controller\Admin;

use Cake\Core\Configure;
use BaserCore\Controller\Admin\BcAdminAppController;
use DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface;

/**
 * DubOgpConfigs Controller
 *
 * @property \DubOgp\Model\Table\DubOgpConfigsTable $DubOgpConfigs
 */
class DubOgpConfigsController extends BcAdminAppController
{
    
    public function index(DubOgpConfigsAdminServiceInterface $service)
    {
        if ($this->request->is('post')) {
            $entity = $service->update($this->getRequest()->getData());
            if (!$entity->getErrors()) {
                $this->BcMessage->setInfo(__d('baser_core', '設定を保存しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
        } else {
            $entity = $service->get();
        }
        $this->set(['entity' => $entity]);
        $this->set(['twitterCards' => Configure::read('DubOgp.twitterCards')]);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    // public function index(\DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service)
    // {
	// 	$this->set($service->getViewVarsForIndex(
	// 		$this->paginate($service->getIndex())
	// 	));
    // }

    /**
     * View method
     *
     * @param \DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service
     * @param string|null $id Dub Ogp Config id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(\DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service, int $id = null)
    {
        $this->set($service->getViewVarsForView($service->get((int) $id)));
    }

    /**
     * Add method
     *
     * @param \DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add(\DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service)
    {
        if ($this->request->is('post', 'patch', 'put')) {
            // EVENT DubOgpConfigs.beforeAdd
            $event = $this->dispatchLayerEvent('beforeAdd', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }

            try {
                $entity = $service->create($this->getRequest()->getData());

                // EVENT DubOgpConfigs.afterAdd
                $this->dispatchLayerEvent('afterAdd', [
                    'data' => $entity
                ]);

                $this->BcMessage->setSuccess(__d('baser_core', "DubOgpConfigs「{0}」を登録しました。", $entity->name));
                return $this->redirect(['action' => 'edit', $entity->id]);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $entity = $e->getEntity();
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。' . $e->getMessage()));
            }
        }
        $this->set($service->getViewVarsForAdd($entity ?? $service->getNew()));
    }

    /**
     * Edit method
     *
     * @param \DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service
     * @param string|null $id Dub Ogp Config id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(\DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service, $id = null)
    {
        $entity = $service->get((int) $id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            // EVENT DubOgpConfigs.beforeEdit
            $event = $this->dispatchLayerEvent('beforeEdit', [
                'data' => $this->getRequest()->getData()
            ]);
            if ($event !== false) {
                $data = ($event->getResult() === null || $event->getResult() === true) ? $event->getData('data') : $event->getResult();
                $this->setRequest($this->getRequest()->withParsedBody($data));
            }

            try {
                $entity = $service->update($entity, $this->request->getData());

                // EVENT DubOgpConfigs.afterEdit
                $this->dispatchLayerEvent('afterEdit', [
                    'data' => $entity
                ]);

                $this->BcMessage->setSuccess(__d('baser_core', "DubOgpConfigs「{0}」を更新しました。", $entity->name));
                return $this->redirect(['action' => 'edit', $id]);
            } catch (\Cake\ORM\Exception\PersistenceFailedException $e) {
                $entity = $e->getEntity();
                $this->BcMessage->setError(__d('baser_core', '入力エラーです。内容を修正してください。'));
            } catch (\Throwable $e) {
                $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。' . $e->getMessage()));
            }
        }

        $this->set($service->getViewVarsForEdit($entity));
    }

    /**
     * Delete method
     *
     * @param \DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service
     * @param string|null $id Dub Ogp Config id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(\DubOgp\Service\Admin\DubOgpConfigsAdminServiceInterface $service, $id = null)
    {
        $this->getRequest()->allowMethod(['post', 'delete']);
        try {
            $entity = $service->get((int) $id);
            if ($service->delete((int) $id)) {
                $this->BcMessage->setSuccess(__d('baser_core',
                    'エントリー「{0}」を削除しました。',
                    $entity->name
                ));
            }
        } catch (\Throwable $e) {
            $this->BcMessage->setError(__d('baser_core', 'データベース処理中にエラーが発生しました。') . $e->getMessage());
        }
        return $this->redirect(['action' => 'index']);
    }
}
