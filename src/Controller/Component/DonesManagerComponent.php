<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\I18n\DateTime;
use Cake\ORM\TableRegistry;

/**
 * Dones Component
 *
 * 実績関連の機能を提供するコンポーネント
 */
class DonesManagerComponent extends Component
{
    /**
     * 実績テーブル
     *
     * @var \App\Model\Table\DonesTable
     */
    protected $donesTable;

    /**
     * Initialize method
     *
     * @param array $config The configuration settings provided to this component.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->donesTable = TableRegistry::getTableLocator()->get('Dones');
    }

    /**
     * 今日の実績を取得
     *
     * @return \Cake\ORM\Query
     */
    public function getTodayDones()
    {
        $today = new DateTime('today');

        return $this->donesTable->find('all', [
            'contain' => ['Labels'],
            'conditions' => [
                'DATE(Dones.created)' => $today->format('Y-m-d')
            ],
            'order' => ['Dones.created' => 'DESC']
        ]);
    }

    /**
     * 実績を追加
     *
     * @param array $data 実績データ
     * @return \App\Model\Entity\Done|false
     */
    public function add(array $data)
    {
        $done = $this->donesTable->newEmptyEntity();
        $done = $this->donesTable->patchEntity($done, $data);

        return $this->donesTable->save($done);
    }

    /**
     * 実績を削除
     *
     * @param string $id 実績ID
     * @return bool
     */
    public function delete(string $id): bool
    {
        $done = $this->donesTable->get($id);
        return $this->donesTable->delete($done);
    }

    /**
     * 実績を取得
     *
     * @param string $id 実績ID
     * @return \App\Model\Entity\Done
     */
    public function get(string $id)
    {
        return $this->donesTable->get($id);
    }

    /**
     * 新規実績エンティティを作成
     *
     * @return \App\Model\Entity\Done
     */
    public function newEmptyEntity()
    {
        return $this->donesTable->newEmptyEntity();
    }
}
