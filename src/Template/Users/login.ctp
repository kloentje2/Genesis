<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h3><?= __('Log in with you account.'); ?></h3>
            <hr>
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create(); ?>
            <div class="form-group">
                <?= $this->Form->input('username', ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <?= $this->Form->input('password', ['class' => 'form-control']); ?>
            </div>
            <?= $this->Form->submit('Log in', ['class' => 'btn btn-primary']); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
