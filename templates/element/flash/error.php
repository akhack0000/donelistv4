<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="flash-message flash-error">
    <div class="flash-icon">✕</div>
    <div class="flash-content"><?= $message ?></div>
    <button class="flash-close" onclick="this.parentElement.classList.add('flash-hidden')">&times;</button>
</div>
