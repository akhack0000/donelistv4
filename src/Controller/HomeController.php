<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Home Controller
 *
 * DonelistV4のホームページを表示
 */
class HomeController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $labelsTable = $this->fetchTable('Labels');

        // 新規ラベルエンティティを作成
        $label = $labelsTable->newEmptyEntity();

        // フォーム送信時の処理
        if ($this->request->is('post')) {
            $label = $labelsTable->patchEntity($label, $this->request->getData());
            if ($labelsTable->save($label)) {
                $this->Flash->success('ラベルが登録されました。');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('ラベルの登録に失敗しました。');
        }

        // 登録済みラベルを取得
        $labels = $labelsTable->find('all', [
            'order' => ['Labels.created' => 'DESC']
        ]);

        $this->set(compact('label', 'labels'));
        $this->set('title', 'DonelistV4');
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

        return $this->redirect(['action' => 'index']);
    }
}
