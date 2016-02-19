<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        BlogSite:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <?= $this->Html->css('bootstrap-markdown.min'); ?>
    <?= $this->Html->css('style'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

<body>
    <?= $this->Flash->render() ?>

    <nav class="col-md-12 navbar navbar-light bg-faded">
        <a href="#" class="navbar-brand">Finley Siebert</a>
        <ul class="nav navbar-nav pull-xs-left">
            <?php if(isset($user->id) && $user->role == 'admin'): ?>
                <li class="nav-item">
                    <?= $this->Html->link(__('Manage blogposts'), ['controller' => 'Blogs', 'action' => 'admin'], ['class' => 'nav-link']); ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Manage categories'), ['controller' => 'Categories', 'action' => 'admin'], ['class' => 'nav-link']); ?>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="nav navbar-nav pull-xs-right">
            <li class="nav-item">
                <?= $this->Html->link('Home', ['controller' => 'Pages', 'action' => 'landing'], ['class' => 'nav-link']); ?>
            </li>
            <li class="nav-item">
                <?= $this->Html->link('Blogs', ['controller' => 'Blogs', 'action' => 'index'], ['class' => 'nav-link']); ?>
            </li>
            <?php if(isset($user->id)): ?>
                <li class="nav-item">
                    <?= $this->Html->link($user->username, ['controller' => 'Users', 'action' => 'view', $user->id], ['class' => 'nav-link']); ?>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="main">
    <?= $this->fetch('content') ?>
    </div>
    <footer class="footer">
        <div class="container navbar-light">
            <p class="pull-xs-left text-muted">
                Copyright &copy; Finley Siebert 2016 - Made with <a href="http://getbootstrap.com">Bootstrap 4</a>
            </p>
            <p class="pull-xs-right text-muted">
                <?= $this->Html->link(__('Log in'), ['controller' => 'Users', 'action' => 'login']); ?> -
                <?= $this->Html->link(__('Category summary'), ['controller' => 'Categories', 'action' => 'index']); ?>
            </p>
        </div>
    </footer>


</body>
</html>
