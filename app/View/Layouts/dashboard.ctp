<?php 
if (!Configure::read('debug')):
    throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>
<?php $cakeDescription = __d('cake_dev', 'Framio'); ?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?> |
        <?php echo $cakeDescription ?>
    </title>
    <?php echo $this->Html->meta('icon');
          echo $this->Html->css('bootstrap');
          echo $this->Html->css('dashboard');
          echo $this->fetch('meta');
          echo $this->fetch('css');
          echo $this->Html->script('jquery-2.0.2.min');
          echo $this->Html->script('masonry.pkgd.min');
          echo $this->Html->script('script');
    ?>

</head>
<body>
<section id="wrapper">
<?php echo $this->element('Dashboard/Header'); ?>
<section id="flashMessages">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Session->flash('auth'); ?>

</section>
<section class="container">
    <section class="row">
        <section class="span1" id="verticalNav">
            <ul>
                <li><?php echo $this->Html->link('Home', array('controller' => 'activities', 'action' => 'index'), array('class' => 'navItem', 'id' => 'home')); ?></li>
                <li><?php echo $this->Html->link('Home', array('controller' => 'uploads', 'action' => 'index'), array('class' => 'navItem', 'id' => 'photos')); ?></li>
                <li><?php echo $this->Html->link('Favorites', array('controller' => 'uploads', 'action' => 'favorites'), array('class' => 'navItem', 'id' => 'faves')); ?></li>
                <li><a href="#" class="navItem" id="stats"></a></li>
                <li><?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'edit'), array('class' => 'navItem', 'id' => 'settings')); ?></li>
            </ul>
        </section>
        <?php echo $this->fetch('content'); ?>
    </section>
</section>
<?php //echo $this->element('sql_dump'); ?>
<section id="push"></section>
</section>
<?php echo $this->element('footer'); ?>
