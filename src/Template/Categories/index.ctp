<div class="container">
    <div class="row">
        <div style="margin-top:10px;"  class="col-md-12">
            <h2 class="pull-xs-left"><?= __('Summary of categories'); ?></h2>
            <?= $this->Html->link(__('Add new'), ['action' => 'add'], ['class' => 'btn btn-success-outline pull-xs-right']); ?>
        </div>
    </div>
    <div class="row">
        <div style="margin-top:10px;" class="col-md-12">
            <div style="border:1px solid #eee;" class="list-group">
                <?php foreach($categories as $category): ?>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading"><?= $category->name; ?></h4>
                        <p class="list-group-item-text"><?= $category->description; ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>