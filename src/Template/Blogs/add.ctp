<div class="container">
    <div class="row">
        <?= $this->Form->create($blog); ?>
        <div class="col-md-3" style="margin-top:30px;">
            <div class="card">
                <div class="card-header"><?= __('Administrative options'); ?></div>
                <div class="card-block">
                    <fieldset class="form-group">
                        <label for="category_id"><?= __('Category'); ?></label>
                        <select name="category_id" id="category_id" class="form-control">
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </fieldset>
                    <fieldset class="form-group">
                        <?= $this->Form->input('tags', ['class' => 'form-control']); ?>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="card card-block">
                            <h4 class="card-title"><?= __('Status'); ?></h4>
                            <div class="c-inputs-stacked">
                                <label class="c-input c-radio">
                                    <input id="radioStacked1" name="status" value="public" type="radio" checked>
                                    <span class="c-indicator"></span>
                                    Public post
                                </label>
                                <label class="c-input c-radio">
                                    <input id="radioStacked2" name="status" value="private" type="radio">
                                    <span class="c-indicator"></span>
                                    Private post
                                </label>
                                <label class="c-input c-radio">
                                    <input id="radioStacked2" name="status" value="auth" type="radio">
                                    <span class="c-indicator"></span>
                                    Only authorized
                                </label>
                                <?php if($user->role == 'admin'): ?>
                                <label class="c-input c-radio">
                                    <input id="radioStacked2" name="status" value="admin" type="radio">
                                    <span class="c-indicator"></span>
                                    Only admins
                                </label>
                                <?php endif; ?>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <div class="card card-block">
                            <h4 class="card-title"><?= __('Comments'); ?></h4>
                            <div class="c-inputs-stacked">
                                <label class="c-input c-radio">
                                    <input id="radioStacked1" name="comments_enabled" value="true" type="radio" checked>
                                    <span class="c-indicator"></span>
                                    Comments on
                                </label>
                                <label class="c-input c-radio">
                                    <input id="radioStacked2" name="comments_enabled" value="false" type="radio">
                                    <span class="c-indicator"></span>
                                    Comments off
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <?= $this->Form->submit(__('Create blogpost'), ['class' => 'btn btn-primary-outline']); ?>
                    </fieldset>
                    <p style="color:#666;font-size:11px;">
                        Post created by <b><?= $user->username; ?></b> at <?= date('d-m-Y H:i'); ?></b>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-9" style="margin-top:15px;">
            <h3><?= __('Create a new blog post'); ?></h3>
            <hr>
            <fieldset class="form-group">
                <?= $this->Form->input('title', ['class' => 'form-control', 'placeholder' => 'The title of the blog post']); ?>
            </fieldset>
            <fieldset class="form-group">
                <?= $this->Form->textarea('body', ['class' => 'form-control', 'style' => 'height:500px;', 'data-provide' => 'markdown-editable', 'placeholder' => __('The body of the blog post')]); ?>
            </fieldset>

        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>

<?= $this->Html->script('jquery-2.1.3.min'); ?>
<?= $this->Html->script('bootstrap-markdown.js'); ?>

<script>

</script>


