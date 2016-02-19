<section class="welcome-image col-md-12">
    <h1 class="text-center hello">Finley Siebert</h1>
</section>
<section>
    <div class="container">
        <div class="row">
            <div style="margin-top:15px" class="col-md-9">
                <h2><?= $blog->title; ?></h2>
                <hr>
                <p>
                    <?= $this->Markdown->parse($blog->body); ?>
                </p>
            </div>
            <div class="col-md-3" style="margin-top:15px;">
                <div class="card">
                    <div class="card-header">
                        <?= __('Content creator info'); ?>
                    </div>
                    <div class="card-block">
                        <h4 class="card-title"><?= $this->Html->link($blog->author->username, ['controller' => 'Users', 'action' => 'view', $blog->author->id, $blog->author->username]) ?></h4>
                        <p class="card-text">
                            <?= __('Category'); ?>: <b><?= $blog->category->name; ?></b>
                            <br>
                            <?= __('Date'); ?>: <b><?= $blog->created_at->nice(); ?></b>
                            <?php if(isset($user->id) && $user->role == 'admin'): ?>
                                <br>
                                Status: <b><?= $blog->status; ?></b>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php if(!$blog->comments_enabled): ?>
            <div class="alert alert-warning col-md-9"><?= __('Comments are disabled'); ?></div>
        <?php elseif(isset($user->id)): ?>
            <?= $this->Form->create($comment); ?>
            <fieldset class="form-group">
                <?= $this->Form->textarea('body', ['class' => 'form-control', 'placeholder' => __('Please write a comment')]); ?>
            </fieldset>
            <?= $this->Form->submit(__('Submit comment'), ['class' => 'btn btn-sm btn-primary']); ?>

            <?= $this->Form->end(); ?>
        <?php else: ?>
        <div class="row">
            <div class="col-md-9">

                <fieldset class="form-group">
                    <?= $this->Form->textarea('body', ['disabled', 'class' => 'form-control col-md-9', 'placeholder' => __('You must be logged in to write a comment')]); ?>
                </fieldset>
                <?= $this->Form->submit(__('Submit comment'), ['disabled', 'class' => 'btn btn-sm btn-primary disabled']); ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-9">
                <hr>
                <?php foreach($blog->comments as $comment): ?>
                    <div class="media" style="border:4px solid #eee;border-radius:4px;padding:20px;">
                        <div class="media-body">
                            <h4 class="media-heading"><?= __('Comment by'); ?> <?= $this->Html->link($comment->user->username, ['controller' => 'Users', 'action' => 'view', $comment->user->id, $comment->user->username]); ?></h4>
                            <small class="text-muted"><?= __($comment->created_at->timeAgoInWords()); ?></small>
                            <hr>
                            <?= $comment->body; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>