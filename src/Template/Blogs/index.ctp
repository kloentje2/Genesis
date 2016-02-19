<div class="container">
    <div class="col-md-12">
        <h3><?= __('Summary of my blog posts'); ?></h3>
        <hr>
        <div class="col-md-7">
            <h4 class="pull-xs-left"><?= __('Blogs posts'); ?></h4>
            <?php if(isset($user->id)): ?>
                <?= $this->Html->link(__('Create a new blog post'), ['controller' => 'Blogs', 'action' => 'add'], ['class' => 'btn btn-success btn-sm pull-xs-right']); ?>
            <?php endif; ?>
            <div style="margin-top:50px;" class="list-group">
                <?php if(empty($blog->first())): ?>
                    <div class="error-message"><?= __('There are no blogposts yet.'); ?></div>
                <?php else: ?>
                    <?php foreach($blog as $post): ?>
                        <?php if($post->status == 'public'):


                            $truncated = (strlen($post->body) > 100) ? substr($post->body, 0, 100) . '...' : $post->body;
                            $tags = explode(',', $post->tags);

                            ?>

                            <a href="<?= $this->Url->build(['controller' => 'blogs', 'action' => 'view', $post->id, $post->pretty_url]); ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><?= $post->title; ?></h4>
                                <small class="text-muted">
                                    <?= __('Created on') . ' ' . $post->created_at->nice(); ?>
                                </small>
                                <hr>
                                <p class="list-group-item-text"><?= $this->Markdown->parse($truncated); ?></p>
                                <p style="font-size:14px;padding:5px;" class="list-group-item-text"><?= __('Category'); ?>: <b><?= $post->category->name; ?></b></p>
                                <p style="font-size:16px;padding:5px;" class="list-group-item-text">
                                    <?php foreach($tags as $tag): ?>
                                        <span class="label label-primary"><i class="fa fa-tag"></i> <?= $tag; ?></span>
                                    <?php endforeach; ?>
                                </p>

                            </a>
                        <?php elseif(isset($user->id) && $post->status == 'private' && $post->author->id == $user->id):

                            $truncated = (strlen($post->body) > 100) ? substr($post->body, 0, 100) . '...' : $post->body;
                            $tags = explode(',', $post->tags);

                            ?>

                            <a href="<?= $this->Url->build(['controller' => 'blogs', 'action' => 'view', $post->id, $post->pretty_url]); ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><i><?= $post->title; ?> (Private post)</i></h4>
                                <small class="text-muted">
                                    <?= __('Created on') . ' ' . $post->created_at->nice(); ?>
                                    Status: <b><?= $post->status; ?></b>
                                </small>
                                <hr>
                                <p class="list-group-item-text"><?= $this->Markdown->parse($truncated); ?></p>
                                <p style="font-size:14px;padding:5px;" class="list-group-item-text"><?= __('Category'); ?>: <b><?= $post->category->name; ?></b></p>
                                <p style="font-size:16px;padding:5px;" class="list-group-item-text">
                                    <?php foreach($tags as $tag): ?>
                                        <span class="label label-primary"><i class="fa fa-tag"></i> <?= $tag; ?></span>
                                    <?php endforeach; ?>
                                </p>

                            </a>
                        <?php elseif(isset($user->id) && $post->status == 'auth'):

                            $truncated = (strlen($post->body) > 100) ? substr($post->body, 0, 100) . '...' : $post->body;
                            $tags = explode(',', $post->tags);

                            ?>
                            <a href="<?= $this->Url->build(['controller' => 'blogs', 'action' => 'view', $post->id, $post->pretty_url]); ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><?= $post->title; ?></h4>
                                <small class="text-muted">
                                    <?= __('Created on') . ' ' . $post->created_at->nice(); ?>
                                </small>
                                <hr>
                                <p class="list-group-item-text"><?= $this->Markdown->parse($truncated); ?></p>
                                <p style="font-size:14px;padding:5px;" class="list-group-item-text"><?= __('Category'); ?>: <b><?= $post->category->name; ?></b></p>
                                <p style="font-size:16px;padding:5px;" class="list-group-item-text">
                                    <?php foreach($tags as $tag): ?>
                                        <span class="label label-primary"><i class="fa fa-tag"></i> <?= $tag; ?></span>
                                    <?php endforeach; ?>
                                </p>

                            </a>
                        <?php elseif(isset($user->id) && $post->status == 'private' && $post->author->id == $user->id):?>

                            <a href="<?= $this->Url->build(['controller' => 'blogs', 'action' => 'view', $post->id, $post->pretty_url]); ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><i><?= $post->title; ?></i> <span class="label label-danger">PRIVATE</span></h4>
                                <small class="text-muted">
                                    <?= __('Created on') . ' ' . $post->created_at->nice(); ?>
                                    Status: <b><?= $post->status; ?></b>
                                </small>
                            </a>
                        <?php elseif(isset($user->id) && $post->status == 'admin' && $user->role == 'admin'): ?>
                            <a href="<?= $this->Url->build(['controller' => 'blogs', 'action' => 'view', $post->id, $post->pretty_url]); ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><i><?= $post->title; ?></i> <span class="label label-warning">ADMIN</span></h4>
                                <small class="text-muted">
                                    <?= __('Created on') . ' ' . $post->created_at->nice(); ?>
                                    Status: <b><?= $post->status; ?></b>
                                </small>
                            </a>
                        <?php endif; ?>

                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
        <div class="col-md-5">
             <h4 class="pull-xs-left"><i class="fa fa-hashtag"></i> <?= __('Categories'); ?></h4>
            <?php if(isset($user->id) && $user->role == 'admin'): ?>
                <?= $this->Html->link(__('Create a new category'), ['controller' => 'Categories', 'action' => 'add'], ['class' => 'btn btn-success-outline btn-sm pull-xs-right']); ?>
            <?php endif; ?>

            <div style="margin-top:50px;" class="list-group">
                <?php if(empty($categories->all()->first())): ?>
                <div class="error-message"><?= __('There are no categories yet.'); ?></div>
                 <?php else: ?>
                    <?php foreach($categories as $category): ?>

                        <?php $category_desc = (strlen($category->description) > 125) ? substr($category->description, 0, 125) . '...' : $category->description; ?>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading"><?= $category->name; ?></h4>
                            <p class="list-group-item-text"><?= $category_desc; ?></p>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>