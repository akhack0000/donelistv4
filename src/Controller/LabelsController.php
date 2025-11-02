<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Labels Controller
 *
 * ラベル管理機能を提供
 */
class LabelsController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $labelsTable = $this->fetchTable('Labels');

        $label = $labelsTable->newEmptyEntity();
        $label = $labelsTable->patchEntity($label, $this->request->getData());

        if ($labelsTable->save($label)) {
            $this->Flash->success('ラベルが登録されました。');
        } else {
            $this->Flash->error('ラベルの登録に失敗しました。');
        }

        return $this->redirect(['controller' => 'Home', 'action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Label id.
     * @return \Cake\Http\Response|null Redirects to index.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $labelsTable = $this->fetchTable('Labels');
        $label = $labelsTable->get($id);

        if ($labelsTable->delete($label)) {
            $this->Flash->success('ラベルが削除されました。');
        } else {
            $this->Flash->error('ラベルの削除に失敗しました。');
        }

        return $this->redirect(['controller' => 'Home', 'action' => 'index']);
    }
}
