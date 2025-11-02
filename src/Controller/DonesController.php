<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dones Controller
 *
 * 実績の登録、編集、削除を管理
 *
 * @property \App\Model\Table\DonesTable $Dones
 */
class DonesController extends AppController
{
    /**
     * Add method
     * 実績を登録
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);

        $done = $this->Dones->newEmptyEntity();
        $done = $this->Dones->patchEntity($done, $this->request->getData());

        if ($this->Dones->save($done)) {
            $this->Flash->success(__('実績を登録しました。'));
        } else {
            $this->Flash->error(__('実績の登録に失敗しました。もう一度お試しください。'));
        }

        return $this->redirect(['controller' => 'Home', 'action' => 'index']);
    }
}
