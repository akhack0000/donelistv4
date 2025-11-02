<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * Labels Component
 *
 * ラベル関連の機能を提供するコンポーネント
 */
class LabelsManagerComponent extends Component
{
    /**
     * ラベルテーブル
     *
     * @var \App\Model\Table\LabelsTable
     */
    protected $labelsTable;

    /**
     * Initialize method
     *
     * @param array $config The configuration settings provided to this component.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->labelsTable = TableRegistry::getTableLocator()->get('Labels');
    }

    /**
     * 全ラベルを取得
     *
     * @return \Cake\ORM\Query
     */
    public function getAllLabels()
    {
        return $this->labelsTable->find('all', [
            'order' => ['Labels.created' => 'DESC']
        ]);
    }

    /**
     * 新規ラベルエンティティを作成
     *
     * @return \App\Model\Entity\Label
     */
    public function newEmptyEntity()
    {
        return $this->labelsTable->newEmptyEntity();
    }

    /**
     * ラベルを追加
     *
     * @param array $data ラベルデータ
     * @return \App\Model\Entity\Label|false
     */
    public function add(array $data)
    {
        $label = $this->labelsTable->newEmptyEntity();
        $label = $this->labelsTable->patchEntity($label, $data);

        return $this->labelsTable->save($label);
    }

    /**
     * ラベルを削除
     *
     * @param string $id ラベルID
     * @return bool
     */
    public function delete(string $id): bool
    {
        $label = $this->labelsTable->get($id);
        return $this->labelsTable->delete($label);
    }

    /**
     * ラベルを取得
     *
     * @param string $id ラベルID
     * @return \App\Model\Entity\Label
     */
    public function get(string $id)
    {
        return $this->labelsTable->get($id);
    }
}
