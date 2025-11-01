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

    <!-- ラベル登録フォーム -->
    <div class="label-form-section">
        <h2>ラベル登録</h2>
        <?= $this->Form->create($label) ?>
        <div class="form-group">
            <?= $this->Form->control('name', [
                'label' => 'ラベル名',
                'placeholder' => '例: 読書、運動、勉強',
                'required' => true,
                'class' => 'form-input'
            ]) ?>
        </div>
        <?= $this->Form->button('登録', ['class' => 'btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>

    <!-- 登録済みラベル一覧 -->
    <div class="labels-list-section">
        <h2>登録済みラベル</h2>
        <?php if ($labels->count() > 0): ?>
            <div class="labels-grid">
                <?php foreach ($labels as $labelItem): ?>
                    <div class="label-card">
                        <span class="label-name"><?= h($labelItem->name) ?></span>
                        <span class="label-date"><?= $labelItem->created->format('Y-m-d H:i') ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-labels">まだラベルが登録されていません。</p>
        <?php endif; ?>
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

.form-group {
    margin-bottom: 20px;
}

.form-input {
    width: 100%;
    padding: 10px;
    font-size: 1.1em;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.btn-primary {
    background: #3498db;
    color: white;
    padding: 12px 30px;
    font-size: 1.1em;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s;
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
    display: flex;
    flex-direction: column;
    gap: 10px;
    transition: box-shadow 0.3s;
}

.label-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

.no-labels {
    text-align: center;
    color: #7f8c8d;
    font-size: 1.1em;
    padding: 40px 0;
}
</style>
