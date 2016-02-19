<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top:15px;">
                <h3><?= __('Administrate your blog posts'); ?></h3>
                <hr>
                <table class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Tags</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Comments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($blogs as $post): ?>
                            <tr>
                                <th scope="row"><?= $post->id; ?></th>
                                <td><?= $post->title; ?></td>
                                <td><?= strlen($post->tags) < 1 ? __('<b>None</b>') : $post->tags; ?></td>
                                <td><?= $post->author->username; ?></td>
                                <td><?= $post->status; ?></td>
                                <td><?= $post->category->name; ?></td>
                                <td><?= count($post->comments) ?></td>
                                <td>
                                    <?= $this->Form->postLink(__('<i class="fa fa-trash"></i>'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete this blog post?'), 'class' => 'btn btn-sm btn-danger', 'escape' => false]); ?>
                                    <?= $this->Html->link(__('<i class="fa fa-pencil"></i>'), ['action' => 'edit', $post->id], [ 'class' => 'btn btn-sm btn-warning', 'escape' => false]); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>