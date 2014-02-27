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
          echo $this->Html->css('cake.generic');
          echo $this->Html->css('bootstrap');
          echo $this->Html->css('login');
          echo $this->fetch('meta');
          echo $this->fetch('css');
          echo $this->fetch('jquery-2.0.2.min');
          echo $this->fetch('script');
    ?>

</head>
<body>
    <img src="<?php echo FULL_BASE_URL ?>/images/framio-login_01.jpg" id="full-screen-background-image"/>
    <section id="logInForm" class="transparent">
        <section id="topSection" class="transparent">
            <img src="<?php echo FULL_BASE_URL ?>/images/framio-blue_03.png" id="logo"/>
        </section>
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
    </section>
</body>
</html>
