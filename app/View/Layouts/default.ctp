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
          //echo $this->fetch('jquery-2.0.2.min');
          echo $this->fetch('script');
    ?>
    <!-- <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="author" content="Abdelrahman Gemei" />
    <meta name="description" content="Framio, Social network and photography publishing platform in Egypt." />
    <meta name="keywords" content="framio, photography, egypt, web publisher and social networking platform, custom profile" />
    <link rel="profile" href="http://gmpg.org/xfn/11" /> -->

</head>
<body>
<header class="container">
    <section class="row">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <section class="span3" id="logo">
            <h1><a href="<?php echo FULL_BASE_URL ?>">framio</a></h1>
        </section>
        <?php echo $this->element('navigation'); ?>
    </section>
</header>
<?php if(isset($this->params->pass[0])) { if ($this->params->pass[0] == 'home') { echo $this->element('collage');}} ?>
<section class="container" id="wrap">
<?php echo $this->fetch('content'); ?>
</section>
<?php $this->element('footer'); ?>