<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3><?= __('Edit this category'); ?></h3>
            <?= $this->Form->create($category); ?>
            <fieldset class="form-group">
                <?= $this->Form->input('name', ['class' => 'form-control', 'placeholder' => __('Describe the category')]); ?>
            </fieldset>
            <fieldset class="form-group">
                <?= $this->Form->textarea('description', ['class' => 'form-control', 'placeholder' => __('Describe the category')]); ?>
            </fieldset>
            <fieldset class="form-group">
                <label class="c-input c-radio">
                    <input id="radio1" name="status" value="public" type="radio" <?= ($category->status == 'public') ? 'checked' : ''; ?>>
                    <span class="c-indicator"></span>
                    <?= __('Everyone can access this category'); ?>
                </label>
                <label class="c-input c-radio">
                    <input id="radio2" name="status" value="auth" type="radio" <?= ($category->status == 'public') ? 'checked' : ''; ?>>
                    <span class="c-indicator"></span>
                    <?= __('Only authenticated users can access this category'); ?>
                </label>
                <label class="c-input c-radio">
                    <input id="radio2" name="status" value="admin" type="radio" <?= ($category->status == 'public') ? 'checked' : ''; ?>>
                    <span class="c-indicator"></span>
                    <?= __('Only administrators can access this category'); ?>
                </label>
            </fieldset>
            <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-secondary pull-xs-right']); ?>

            <?= $this->Form->submit(__('Save'), ['class' => 'btn btn-primary-outline btn-lg'], ['placeholder' => __('Describe your category')]); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>