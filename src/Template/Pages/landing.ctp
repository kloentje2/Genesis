<section class="welcome-image col-md-12">
    <h1 class="text-center hello">Finley Siebert</h1>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div style="margin-top:50px;" class="list-group">
                    <?php foreach($blogs as $post): ?>
                        <?php if($post->status == 'public'):


                        $truncated = (strlen($post->body) > 250) ? substr($post->body, 0, 250) . '...' : $post->body;
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
                        <?php elseif(isset($user->id) && $post->status == 'auth'):

                            $truncated = (strlen($post->body) > 250) ? substr($post->body, 0, 250) . '...' : $post->body;
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

                            <a href="<?= $this->Url->build(['controller' => 'blogs', 'action' => 'view', $post->id]); ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><i><?= $post->title; ?></i> <span class="label label-danger">PRIVATE</span></h4>
                                <small class="text-muted">
                                    <?= __('Created on') . ' ' . $post->created_at->nice(); ?>
                                    Status: <b><?= $post->status; ?></b>
                                </small>
                            </a>
                    <?php elseif(isset($user->id) && $post->status == 'admin' && $user->role == 'admin'): ?>
                            <a href="<?= $this->Url->build(['controller' => 'blogs', 'action' => 'view', $post->id]); ?>" class="list-group-item">
                                <h4 class="list-group-item-heading"><i><?= $post->title; ?></i> <span class="label label-warning">ADMIN</span></h4>
                                <small class="text-muted">
                                    <?= __('Created on') . ' ' . $post->created_at->nice(); ?>
                                    Status: <b><?= $post->status; ?></b>
                                </small>
                            </a>
                    <?php endif; ?>

                    <?php endforeach; ?>

                </div>
            </div>
            <div style="margin-top:50px;" class="col-md-4">
                <h3><?= __('Categories'); ?></h3>
                <hr>
                <div class="list-group">
                    <?php foreach($categories as $category): ?>
                        <?php if(isset($user->id) && $category->status == 'auth'): ?>
                            <?php $category_desc = (strlen($category->description) > 50) ? substr($category->description, 0, 50) . '...' : $category->description; ?>
                            <a href="#" class="list-group-item">
                                <h4 class="list-group-item-heading"><?= $category->name; ?> <span class="label label-primary">AUTH</span></h4>
                                <p class="list-group-item-text"><?= $category_desc; ?></p>
                            </a>
                            <?php elseif(isset($user->id) && $category->status == 'admin' && $user->role == 'admin'): ?>
                            <?php $category_desc = (strlen($category->description) > 50) ? substr($category->description, 0, 50) . '...' : $category->description; ?>
                            <a href="#" class="list-group-item">
                                <h4 class="list-group-item-heading"><?= $category->name; ?> <span class="label label-warning">ADMIN</span></h4>
                                <p class="list-group-item-text"><?= $category_desc; ?></p>
                            </a>
                            <?php elseif($category->status == 'public'): ?>
                            <?php $category_desc = (strlen($category->description) > 50) ? substr($category->description, 0, 50) . '...' : $category->description; ?>
                            <a href="#" class="list-group-item">
                                <h4 class="list-group-item-heading"><?= $category->name; ?></h4>
                                <p class="list-group-item-text"><?= $category_desc; ?></p>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</section>

