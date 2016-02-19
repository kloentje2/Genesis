<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h3><?= __('Create your account'); ?></h3>
            <hr>
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create($user); ?>
            <div class="form-group">
                <?= $this->Form->input('username', ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <?= $this->Form->input('password', ['class' => 'form-control']); ?>
            </div>
            <div class="form-group">
                <?= $this->Form->input('password_verify', ['class' => 'form-control', 'type' => 'password', 'label' => 'Repeat password']); ?>
            </div>
            <div class="form-group">
                <?= $this->Form->input('email', ['class' => 'form-control']); ?>
            </div>
            <?= $this->Html->link(__('Back'), ['action' => 'login'], ['class' => 'btn btn-secondary pull-xs-left']); ?>
            <?= $this->Form->submit(__('Create your account'), ['class' => 'btn btn-primary-outline btn-lg pull-xs-right']); ?>

            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>