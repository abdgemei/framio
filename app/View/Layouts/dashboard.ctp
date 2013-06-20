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
          echo $this->fetch('jquery-2.0.2.min');
          echo $this->fetch('script');
    ?>

</head>
<body>
<header>
    <section class="container">
        
    </section>
</header>
<section class="container">
    <section class="row">
        <section class="span1" id="verticalNav">
            <ul>
                <li><a href="#" class="navItem" id="home"></a></li>
                <li><a href="#" class="navItem" id="photos"></a></li>
                <li><a href="#" class="navItem" id="faves"></a></li>
                <li><a href="#" class="navItem" id="stats"></a></li>
                <li><a href="#" class="navItem" id="settings"></a></li>
            </ul>
        </section>
        <section class="span7" id="content">
            <?php $this->fetch('content'); ?>
        </section>
        <section class="span4" id="activityFeed">
            
        </section>
    </section>
</section>
<?php $this->element('footer'); ?>