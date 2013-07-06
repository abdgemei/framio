<?php 
if (!Configure::read('debug')):
    throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>
<?php $cakeDescription = __d('cake_dev', 'Framio'); ?>
<!DOCTYPE HTML>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?> |
        <?php echo $cakeDescription ?>
    </title>
    <?php echo $this->Html->meta('icon');
          echo $this->Html->css('bootstrap');
          //echo $this->Html->css('style');
          echo $this->Html->css('profile');
          echo $this->Html->script('jquery-2.0.2.min');
          echo $this->fetch('meta');
          echo $this->fetch('css');
          // echo $this->fetch('script');
    ?>
<script type="text/javascript">
$(document).ready(function() {
    $('.thumbnailLink').mouseover(function() {
        $(this).find('.slidingPanel').stop().animate({'bottom':-9});
    });
    $('.thumbnailLink').mouseout(function() {
        $(this).find('.slidingPanel').stop().animate({'bottom':20});
    });
});

</script>
</head>

<body>
<section class="container">
    <section class="row" id="navigation">
        <section class="span4" id="logo">
            <h4>Framio</h4>
        </section>
        <?php if($this->Session->read('Auth.User')) : ?>
        <section class="offset2 span6" id="links">
            <ul>
                <li><?php echo $this->Html->link('Dashboard', array('controller' => 'activities', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link('Upload', array('controller' => 'uploads', 'action' => 'add')); ?></li>
                <li><?php echo $this->Html->link('Settings', array('controller' => 'users', 'action' => 'edit')); ?></li>
            </ul>
        </section>
        <?php endif; ?>
    </section>