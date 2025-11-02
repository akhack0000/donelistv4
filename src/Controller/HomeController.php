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
     * Initialize method
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('LabelsManager', ['className' => 'Labels']);
        $this->loadComponent('DonesManager', ['className' => 'Dones']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // 新規ラベルエンティティを作成（フォーム表示用）
        $label = $this->LabelsManager->newEmptyEntity();

        // 登録済みラベルを取得
        $labels = $this->LabelsManager->getAllLabels();

        // 今日の実績を取得
        $todayDones = $this->DonesManager->getTodayDones();

        $this->set(compact('label', 'labels', 'todayDones'));
        $this->set('title', 'DonelistV4');
    }
}
