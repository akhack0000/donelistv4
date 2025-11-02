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
                        <div class="done-content">
                            <div class="done-header">
                                <span class="done-label-name"><?= h($done->label->name) ?></span>
                                <span class="done-time"><?= $done->created->format('H:i') ?></span>
                            </div>
                            <?php if ($done->message): ?>
                                <div class="done-message"><?= h($done->message) ?></div>
                            <?php else: ?>
                                <div class="done-message-empty">メッセージなし</div>
                            <?php endif; ?>
                        </div>
                        <button class="btn-edit-done"
                                onclick="openEditModal(<?= $done->id ?>, '<?= h(addslashes($done->label->name)) ?>', '<?= h(addslashes($done->message ?? '')) ?>')">
                            編<br>集
                        </button>
                        <button class="btn-delete-done"
                                onclick="deleteDone(event, <?= $done->id ?>)">
                            削<br>除
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-dones">今日の実績はまだありません。</p>
        <?php endif; ?>
    </div>

    <!-- 登録済みラベル一覧 -->
    <div class="labels-list-section">
        <h2>登録済みラベル <span class="drag-hint">（ドラッグで並び替え可能）</span></h2>
        <?php if ($labels->count() > 0): ?>
            <div class="labels-grid" id="sortable-labels">
                <?php foreach ($labels as $labelItem): ?>
                    <div class="label-card" data-id="<?= $labelItem->id ?>">
                        <button class="btn-delete" onclick="deleteLabel(event, <?= $labelItem->id ?>)">×</button>
                        <div class="label-info">
                            <span class="label-name"><?= h($labelItem->name) ?></span>
                            <span class="label-date"><?= $labelItem->created->format('Y-m-d H:i') ?></span>
                        </div>
                        <form class="done-form" onsubmit="addDone(event, <?= $labelItem->id ?>)">
                            <input type="hidden" name="label_id" value="<?= $labelItem->id ?>">
                            <input type="text"
                                   name="message"
                                   placeholder="メッセージ（任意）"
                                   class="message-input"
                                   id="message-<?= $labelItem->id ?>">
                            <button type="submit" class="btn-add-done">記録</button>
                        </form>
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
        <form class="label-form" onsubmit="addLabel(event)">
            <div class="input">
                <label for="label-name">ラベル名</label>
                <input type="text"
                       name="name"
                       id="label-name"
                       placeholder="例: 読書、運動、勉強"
                       required
                       class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
</div>

<!-- 実績編集モーダル -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalLabelName">実績を編集</h3>
            <span class="modal-close" onclick="closeEditModal()">&times;</span>
        </div>
        <?= $this->Form->create(null, ['id' => 'editForm', 'class' => 'modal-form']) ?>
            <div class="modal-body">
                <?= $this->Form->control('message', [
                    'label' => 'メッセージ',
                    'id' => 'editMessage',
                    'placeholder' => 'メッセージを入力してください',
                    'class' => 'modal-input',
                    'required' => false,
                    'type' => 'textarea',
                    'rows' => 3
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">キャンセル</button>
                <?= $this->Form->button('更新', ['type' => 'submit', 'class' => 'btn-save']) ?>
            </div>
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
    border: none;
    cursor: pointer;
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
    max-height: 500px;
    overflow-y: auto;
    padding: 12px;
    padding-right: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    scroll-behavior: smooth;
}

/* スクロールバーのスタイル */
.today-dones-list::-webkit-scrollbar {
    width: 10px;
}

.today-dones-list::-webkit-scrollbar-track {
    background: #e9ecef;
    border-radius: 5px;
    margin: 8px 0;
}

.today-dones-list::-webkit-scrollbar-thumb {
    background: #95a5a6;
    border-radius: 5px;
    border: 2px solid #e9ecef;
}

.today-dones-list::-webkit-scrollbar-thumb:hover {
    background: #7f8c8d;
}

.done-item {
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 0;
    transition: box-shadow 0.3s;
    display: flex;
    overflow: hidden;
    flex-shrink: 0;
    min-height: 80px;
}

.done-item:hover {
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.done-content {
    flex: 1;
    padding: 15px 20px;
}

.btn-edit-done {
    background: #3498db;
    color: white;
    width: 50px;
    font-size: 0.9em;
    font-weight: 500;
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 10px 5px;
    border: none;
    border-left: 1px solid #2980b9;
    line-height: 1.4;
    cursor: pointer;
    align-self: stretch;
    height: auto;
    margin: 0;
}

.btn-edit-done:hover {
    background: #2980b9;
    width: 55px;
}

.btn-delete-done {
    background: #e74c3c;
    color: white;
    width: 50px;
    text-decoration: none;
    font-size: 0.9em;
    font-weight: 500;
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 10px 5px;
    border: none;
    border-left: 1px solid #c0392b;
    line-height: 1.4;
    align-self: stretch;
    cursor: pointer;
}

.btn-delete-done:hover {
    background: #c0392b;
    width: 55px;
}

.done-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
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
    margin-top: 8px;
    margin-bottom: 10px;
    font-size: 1em;
    color: #555;
    padding-left: 10px;
    border-left: 3px solid #3498db;
}

.done-message-empty {
    margin-top: 8px;
    margin-bottom: 10px;
    font-size: 0.95em;
    color: #95a5a6;
    font-style: italic;
}

.no-dones {
    text-align: center;
    color: #7f8c8d;
    font-size: 1.1em;
    padding: 40px 0;
}

/* ドラッグヒント */
.drag-hint {
    font-size: 0.7em;
    color: #95a5a6;
    font-weight: normal;
}

/* ドラッグ時のスタイル */
.label-card {
    cursor: move;
    cursor: grab;
}

.label-card:active {
    cursor: grabbing;
}

.label-card.sortable-ghost {
    opacity: 0.4;
    background: #ecf0f1;
}

.label-card.sortable-drag {
    opacity: 0.9;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* モーダルスタイル */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: #fff;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    animation: slideIn 0.3s;
}

@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #e0e0e0;
}

.modal-header h3 {
    margin: 0;
    font-size: 1.5em;
    color: #2c3e50;
}

.modal-close {
    font-size: 2em;
    line-height: 1;
    color: #7f8c8d;
    cursor: pointer;
    transition: color 0.3s;
}

.modal-close:hover {
    color: #2c3e50;
}

.modal-body {
    padding: 24px;
}

.modal-form .input {
    margin: 0;
}

.modal-input {
    width: 100%;
    padding: 12px;
    font-size: 1em;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    resize: vertical;
}

.modal-input:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.modal-footer {
    display: flex;
    gap: 12px;
    padding: 20px 24px;
    border-top: 1px solid #e0e0e0;
    justify-content: flex-end;
}

.btn-cancel {
    background: #95a5a6;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 1em;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-cancel:hover {
    background: #7f8c8d;
}

.btn-save {
    background: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 1em;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-save:hover {
    background: #2980b9;
}
</style>

<!-- SortableJS CDN -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
// CSRF Token取得
const csrfToken = '<?= $this->request->getAttribute('csrfToken') ?>';

// 実績記録
function addDone(event, labelId) {
    event.preventDefault();

    const messageInput = document.getElementById('message-' + labelId);
    const message = messageInput.value;

    const formData = new FormData();
    formData.append('label_id', labelId);
    formData.append('message', message);

    fetch('/dones/add', {
        method: 'POST',
        headers: {
            'X-CSRF-Token': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // メッセージ入力をクリア
            messageInput.value = '';
            // ページをリロードして実績リストを更新
            location.reload();
        } else {
            alert('エラー: ' + (data.message || '実績の登録に失敗しました。'));
        }
    })
    .catch(error => {
        console.error('エラー:', error);
        alert('通信エラーが発生しました。');
    });
}

// 実績削除
function deleteDone(event, doneId) {
    event.preventDefault();

    if (!confirm('本当に削除しますか?')) {
        return;
    }

    fetch('/dones/delete/' + doneId, {
        method: 'POST',
        headers: {
            'X-CSRF-Token': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // ページをリロードして実績リストを更新
            location.reload();
        } else {
            alert('エラー: ' + (data.message || '実績の削除に失敗しました。'));
        }
    })
    .catch(error => {
        console.error('エラー:', error);
        alert('通信エラーが発生しました。');
    });
}

// ラベル登録
function addLabel(event) {
    event.preventDefault();

    const form = event.target;
    const nameInput = form.querySelector('#label-name');
    const name = nameInput.value.trim();

    if (!name) {
        alert('ラベル名を入力してください。');
        return;
    }

    const formData = new FormData();
    formData.append('name', name);

    fetch('/labels/add', {
        method: 'POST',
        headers: {
            'X-CSRF-Token': csrfToken,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // フォームをクリア
            nameInput.value = '';
            // ページをリロードしてラベルリストを更新
            location.reload();
        } else {
            alert('エラー: ' + (data.message || 'ラベルの登録に失敗しました。'));
        }
    })
    .catch(error => {
        console.error('エラー:', error);
        alert('通信エラーが発生しました。');
    });
}

// ラベル削除
function deleteLabel(event, labelId) {
    event.preventDefault();
    event.stopPropagation(); // ドラッグイベントとの干渉を防ぐ

    if (!confirm('本当に削除しますか?')) {
        return;
    }

    fetch('/labels/delete/' + labelId, {
        method: 'POST',
        headers: {
            'X-CSRF-Token': csrfToken,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // ページをリロードしてラベルリストを更新
            location.reload();
        } else {
            alert('エラー: ' + (data.message || 'ラベルの削除に失敗しました。'));
        }
    })
    .catch(error => {
        console.error('エラー:', error);
        alert('通信エラーが発生しました。');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const sortableEl = document.getElementById('sortable-labels');

    if (sortableEl) {
        const sortable = Sortable.create(sortableEl, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            handle: '.label-card',
            onEnd: function(evt) {
                // 並び順を取得
                const items = sortableEl.querySelectorAll('.label-card');
                const orders = {};

                items.forEach(function(item, index) {
                    const id = item.getAttribute('data-id');
                    orders[id] = index;
                });

                // サーバーに並び順を送信
                fetch('/labels/update-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': '<?= $this->request->getAttribute('csrfToken') ?>'
                    },
                    body: JSON.stringify({
                        orders: orders
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('並び順の更新に失敗しました:', data.message);
                        // 失敗時は元に戻す
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('エラー:', error);
                    location.reload();
                });
            }
        });
    }
});

// モーダル制御
let currentDoneId = null;

function openEditModal(doneId, labelName, message) {
    currentDoneId = doneId;
    document.getElementById('modalLabelName').textContent = ' 実績を編集 - ' + labelName;
    document.getElementById('editMessage').value = message;
    document.getElementById('editModal').classList.add('show');

    // モーダル外クリックで閉じる
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    // ESCキーで閉じる
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('editModal').classList.contains('show')) {
            closeEditModal();
        }
    });
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('show');
    currentDoneId = null;
}

// モーダルフォーム送信処理
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();

    if (!currentDoneId) {
        alert('エラー: 実績IDが取得できませんでした。');
        return;
    }

    const message = document.getElementById('editMessage').value;
    const formData = new FormData();
    formData.append('message', message);

    fetch('/dones/edit/' + currentDoneId, {
        method: 'POST',
        headers: {
            'X-CSRF-Token': '<?= $this->request->getAttribute('csrfToken') ?>'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('更新に失敗しました: ' + (data.message || '不明なエラー'));
        }
    })
    .catch(error => {
        console.error('エラー:', error);
        alert('通信エラーが発生しました。');
    });
});
</script>
