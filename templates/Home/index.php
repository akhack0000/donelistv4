<?php
/**
 * @var \App\View\AppView $this
 * @var string $title
 */
?>
<div class="home index content">
    <div class="text-center">
        <h1><?= h($title) ?></h1>
        <p class="lead">実績記録Webサービス</p>

        <div class="description">
            <p>ボタン一つで実績を記録することができるシンプルなサービスです。</p>
        </div>

        <div class="features">
            <h2>主な機能</h2>
            <ul>
                <li>ラベル管理（登録・編集・削除）</li>
                <li>実績の記録</li>
                <li>実績のメッセージ編集</li>
                <li>実績の削除</li>
                <li>登録済みラベルリストの取得</li>
                <li>記録されている実績の取得</li>
            </ul>
        </div>
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

.description {
    margin: 30px 0;
    font-size: 1.1em;
    color: #34495e;
}

.features {
    margin-top: 50px;
}

.features h2 {
    font-size: 2em;
    margin-bottom: 20px;
    color: #2c3e50;
}

.features ul {
    list-style: none;
    padding: 0;
    text-align: left;
    display: inline-block;
}

.features li {
    padding: 10px 0;
    font-size: 1.1em;
    color: #34495e;
    border-bottom: 1px solid #ecf0f1;
}

.features li:before {
    content: "✓ ";
    color: #27ae60;
    font-weight: bold;
    margin-right: 10px;
}
</style>
