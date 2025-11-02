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

        // 新規ラベルエンティティを作成（フォーム表示用）
        $label = $labelsTable->newEmptyEntity();

        // 登録済みラベルを取得
        $labels = $labelsTable->find('all', [
            'order' => ['Labels.created' => 'DESC']
        ]);

        $this->set(compact('label', 'labels'));
        $this->set('title', 'DonelistV4');
    }
}
