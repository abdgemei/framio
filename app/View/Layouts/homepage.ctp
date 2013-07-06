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
          echo $this->Html->css('style');
          echo $this->fetch('meta');
          echo $this->fetch('css');
          echo $this->fetch('jquery-2.0.2.min');
          echo $this->fetch('script');
    ?>

</head>
<body>
<header class="container">
    <section class="row">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <section class="span3" id="logo">
            <h1><a href="<?php echo FULL_BASE_URL ?>" id="mainHomeLink">framio</a></h1>
        </section>
        <?php echo $this->element('navigation'); ?>
    </section>
</header>
<?php if(isset($this->params->pass[0])) { if ($this->params->pass[0] == 'home') { echo $this->element('collage');}} ?>
<section class="container" id="wrap">
<?php echo $this->fetch('content'); ?>
</section>
<?php echo $this->element('footer'); ?>