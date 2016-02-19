<div class="container">
    <div class="row">
        <div style="margin-top:10px;" class="col-md-12">
            <h1><?= $profile->username; ?> (<?= $profile->role; ?>)</h1>
            <hr>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Info over <?= $profile->username; ?></div>
                    <div class="card-block">
                        <ul style="list-style-type:none;">
                            <li><i class="fa fa-user"></i> <?= $profile->username; ?></li>
                            <li><i class="fa fa-envelope-o"></i> <?= $profile->email; ?></li>
                            <li><i class="fa fa-clock-o"></i> <?= $profile->created_at->nice(); ?></li>
                            <li> <?= count($profile->blogs) ?> blog posts</li>
                            <li><i class="fa fa-commenting"></i> <?= count($profile->comments); ?> comments posted</li>
                        </ul>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Acties <?= $profile->username; ?></h4>
                        <?php if(isset($user->id)): ?>
                        <?= $this->Html->link(__('Report ') . $profile->username, ['controller' => 'Reports', 'action' => 'user', $profile->id], ['class' => 'btn btn-danger btn-block']); ?>
                        <?php endif; ?>
                        <?= $this->Html->link(__('Find posts by ') . $profile->username, ['controller' => 'Blogs', 'action' => 'find', $profile->id], ['class' => 'btn btn-primary btn-block']); ?>
                        <?= $this->Html->link(__('Find comments by ') . $profile->username, ['controller' => 'Comments', 'action' => 'find', $profile->id], ['class' => 'btn btn-success btn-block']); ?>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-md-12">
                <h3>Send <?= $profile->username; ?> a message</h3>
                <?php if(isset($user->id)): ?>
                <?= $this->Form->create($profileMessage); ?>
                <fieldset class="form-group">
                    <label for="message"><?= __('Your message'); ?>:</label>
                    <?= $this->Form->textarea('message', ['class' => 'form-control', 'placeholder' => 'Write a message']); ?>
                </fieldset>
                <?= $this->Form->submit('Submit message', ['class' => 'btn btn-primary']); ?>
                <?= $this->Form->end(); ?>
                <?php else: ?>
                    <div class="alert alert-warning"><?= __('You have to be logged in to write a message'); ?></div>
                <?php endif; ?>
                <hr>
            </div>
            <div class="col-md-12">
                <h3>Messages to <?= $profile->username; ?> (<?= count($profile->profileMessages); ?>)</h3>
                <?php foreach($profile->profileMessages as $comment): ?>
                    <div class="media" style="border:4px solid #eee;border-radius:4px;padding:20px;">
                        <div class="media-body">
                            <h4 class="media-heading"><?= __('Comment by'); ?> <?= $this->Html->link($comment->user->username, ['action' => 'view', $comment->user->id, $comment->user->username]); ?></h4>
                            <small class="text-muted"><?= __($comment->created_at->timeAgoInWords()); ?></small>
                            <hr>
                            <?= $comment->message; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>