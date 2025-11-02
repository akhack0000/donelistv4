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
     * Edit method
     * 実績を編集
     *
     * @param string|null $id Done id.
     * @return \Cake\Http\Response|null JSON response.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->viewBuilder()->setClassName('Json');

        $data = $this->request->getData();

        try {
            if ($this->DonesManager->edit($id, $data)) {
                $response = [
                    'success' => true,
                    'message' => '実績を更新しました。'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => '実績の更新に失敗しました。'
                ];
            }
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => 'エラーが発生しました: ' . $e->getMessage()
            ];
        }

        $this->set('_serialize', array_keys($response));
        $this->set($response);

        return $this->response->withType('application/json')
            ->withStringBody(json_encode($response));
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
