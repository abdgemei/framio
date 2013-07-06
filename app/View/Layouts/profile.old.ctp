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
          echo $this->fetch('script');
    ?>
  
<!-- <meta name="author" content="Nouran zedan" />
    <meta name="description" content="Framio profile page, Social network and photography publishing platform in Egypt for users to share there photos and upload them to their own gallery" />
    <meta name="keywords" content="framio, user, profile, photographer, photos,photography social sharing, gallery, username, Brain grey" /> -->
</head>
<div class="container">
     <div class="navbar">
        <div class="navbar-inner">
            <a href="#" class="brand">Framio</a>
        <div class="nav-collapse collapse">
            <ul class="nav pull-right">
                <li class="active"><a href="#">Upload</a></li>
                <li><a href="">Messages</a></li>
                <li><a href="">Notification</a></li>
            </ul>
        </div>
        </div>
<?php echo $this->fetch('content'); ?>

<?php echo $this->element('footer'); ?>