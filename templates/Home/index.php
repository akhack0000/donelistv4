<?php
/**
 * @var \App\View\AppView $this
 * @var string $title
 * @var \App\Model\Entity\Label $label
 * @var \Cake\Collection\CollectionInterface|\App\Model\Entity\Label[] $labels
 */
?>
<div class="home index content">
    <div class="text-center">
        <h1><?= h($title) ?></h1>
        <p class="lead">実績記録Webサービス</p>
    </div>

    <!-- 今日の実績一覧 -->
    <div class="today-dones-section">
        <h2>今日の実績</h2>
        <?php if ($todayDones->count() > 0): ?>
            <div class="today-dones-list">
                <?php foreach ($todayDones as $done): ?>
                    <div class="done-item">
                        <div class="done-header">
                            <span class="done-label-name"><?= h($done->label->name) ?></span>
                            <span class="done-time"><?= $done->created->format('H:i') ?></span>
                        </div>
                        <?php if ($done->message): ?>
                            <div class="done-message"><?= h($done->message) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-dones">今日の実績はまだありません。</p>
        <?php endif; ?>
    </div>

    <!-- 登録済みラベル一覧 -->
    <div class="labels-list-section">
        <h2>登録済みラベル</h2>
        <?php if ($labels->count() > 0): ?>
            <div class="labels-grid">
                <?php foreach ($labels as $labelItem): ?>
                    <div class="label-card">
                        <?= $this->Form->postLink(
                            '×',
                            ['controller' => 'Labels', 'action' => 'delete', $labelItem->id],
                            [
                                'confirm' => '本当に削除しますか?',
                                'class' => 'btn-delete',
                                'escape' => false
                            ]
                        ) ?>
                        <div class="label-info">
                            <span class="label-name"><?= h($labelItem->name) ?></span>
                            <span class="label-date"><?= $labelItem->created->format('Y-m-d H:i') ?></span>
                        </div>
                        <?= $this->Form->create(null, [
                            'url' => ['controller' => 'Dones', 'action' => 'add'],
                            'class' => 'done-form'
                        ]) ?>
                            <?= $this->Form->hidden('label_id', ['value' => $labelItem->id]) ?>
                            <?= $this->Form->control('message', [
                                'label' => false,
                                'placeholder' => 'メッセージ（任意）',
                                'class' => 'message-input',
                                'required' => false
                            ]) ?>
                            <?= $this->Form->button('記録', [
                                'type' => 'submit',
                                'class' => 'btn-add-done'
                            ]) ?>
                        <?= $this->Form->end() ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-labels">まだラベルが登録されていません。</p>
        <?php endif; ?>
    </div>

    <!-- ラベル登録フォーム -->
    <div class="label-form-section">
        <h2>ラベル登録</h2>
        <?= $this->Form->create($label, ['url' => ['controller' => 'Labels', 'action' => 'add'], 'class' => 'label-form']) ?>
            <?= $this->Form->control('name', [
                'label' => 'ラベル名',
                'placeholder' => '例: 読書、運動、勉強',
                'required' => true,
                'class' => 'form-control'
            ]) ?>
            <?= $this->Form->button('登録', ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

<style>
.home.index {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
}

.text-center {
    text-align: center;
    margin-bottom: 40px;
}

.home.index h1 {
    font-size: 3em;
    margin-bottom: 20px;
    color: #2c3e50;
}

.lead {
    font-size: 1.5em;
    color: #7f8c8d;
    margin-bottom: 30px;
}

/* ラベル登録フォーム */
.label-form-section {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 8px;
    margin-bottom: 40px;
}

.label-form-section h2 {
    font-size: 1.8em;
    margin-bottom: 20px;
    color: #2c3e50;
}

.label-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.label-form .input {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.label-form label {
    font-size: 1.1em;
    font-weight: 500;
    color: #2c3e50;
}

.label-form .form-control {
    width: 100%;
    padding: 12px;
    font-size: 1.1em;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.label-form .form-control:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.btn {
    width: 100%;
    padding: 24px 30px;
    font-size: 1.1em;
    line-height: 1.8;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s;
    font-weight: 500;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    background: #3498db;
    color: white;
}

.btn-primary:hover {
    background: #2980b9;
}

/* 登録済みラベル一覧 */
.labels-list-section {
    margin-top: 40px;
}

.labels-list-section h2 {
    font-size: 1.8em;
    margin-bottom: 20px;
    color: #2c3e50;
}

.labels-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
}

.label-card {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    transition: box-shadow 0.3s;
    position: relative;
}

.label-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.done-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 12px;
}

.done-form .input {
    margin: 0;
}

.message-input {
    width: 100%;
    padding: 10px;
    font-size: 0.95em;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.message-input:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.label-info {
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex: 1;
}

.label-name {
    font-size: 1.3em;
    font-weight: bold;
    color: #2c3e50;
}

.label-date {
    font-size: 0.9em;
    color: #7f8c8d;
}

.btn-add-done {
    background: #27ae60;
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    border-radius: 4px;
    font-size: 0.9em;
    text-align: center;
    transition: background 0.3s;
    width: 100%;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-add-done:hover {
    background: #229954;
}

.btn-delete {
    position: absolute;
    top: 8px;
    right: 8px;
    background: #e74c3c;
    color: white;
    width: 28px;
    height: 28px;
    text-decoration: none;
    border-radius: 50%;
    font-size: 1.2em;
    line-height: 1;
    text-align: center;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.btn-delete:hover {
    background: #c0392b;
    transform: scale(1.1);
}

.no-labels {
    text-align: center;
    color: #7f8c8d;
    font-size: 1.1em;
    padding: 40px 0;
}

/* 今日の実績一覧 */
.today-dones-section {
    margin-bottom: 40px;
}

.today-dones-section h2 {
    font-size: 1.8em;
    margin-bottom: 20px;
    color: #2c3e50;
}

.today-dones-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.done-item {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px 20px;
    transition: box-shadow 0.3s;
}

.done-item:hover {
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.done-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.done-label-name {
    font-size: 1.2em;
    font-weight: bold;
    color: #2c3e50;
}

.done-time {
    font-size: 0.9em;
    color: #7f8c8d;
}

.done-message {
    margin-top: 10px;
    font-size: 1em;
    color: #555;
    padding-left: 10px;
    border-left: 3px solid #3498db;
}

.no-dones {
    text-align: center;
    color: #7f8c8d;
    font-size: 1.1em;
    padding: 40px 0;
}
</style>
