<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dones Controller
 *
 * 実績の登録、編集、削除を管理
 */
class DonesController extends AppController
{
    /**
     * Initialize method
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('DonesManager');
    }

    /**
     * Add method
     * 実績を登録
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);

        if ($this->DonesManager->add($this->request->getData())) {
            $this->Flash->success(__('実績を登録しました。'));
        } else {
            $this->Flash->error(__('実績の登録に失敗しました。もう一度お試しください。'));
        }

        return $this->redirect(['controller' => 'Home', 'action' => 'index']);
    }

    /**
     * Delete method
     * 実績を削除
     *
     * @param string|null $id Done id.
     * @return \Cake\Http\Response|null Redirects to index.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        if ($this->DonesManager->delete($id)) {
            $this->Flash->success(__('実績を削除しました。'));
        } else {
            $this->Flash->error(__('実績の削除に失敗しました。'));
        }

        return $this->redirect(['controller' => 'Home', 'action' => 'index']);
    }
}
