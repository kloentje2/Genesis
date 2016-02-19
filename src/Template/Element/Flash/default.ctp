<?php
$class = 'alert alert-';
if (!empty($params['class'])) {
    if($params['class'] == 'error') {
        $params['class'] = 'danger';
    }
    $class = $class . $params['class'];
}
?>
<div class="<?= h($class) ?>"><strong><?= __('Heads up'); ?>: </strong><?= h($message) ?></div>
