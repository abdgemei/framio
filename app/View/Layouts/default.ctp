<?php //pr($this->params->pass[0]); die;  
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
<footer class="container row">
    <section class="span2 linkList1" id="footerAboutFramio">
        <h4>About Framio</h4>
        <ul>
            <li><a href="#">Discover</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">Who we are</a></li>
        </ul>
    </section>
    <section class="span2 linkList2" id="footerCommunity">
        <h4>About Framio</h4>
        <ul>
            <li><a href="#">Request an invite</a></li>
            <li><a href="#">Find friends</a></li>
            <li><a href="#">Jobs</a></li>
        </ul>
    </section>
    <section class="span2 linkList3" id="footerMerchant">
        <h4>Merchant</h4>
        <ul>
            <li><a href="#">Advertise</a></li>
            <li><a href="#">Sponsor</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </section>
    <section class="span2 linkList4" id="footerLegal">
        <h4>Legal</h4>
        <ul>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">FAQ</a></li>
        </ul>
    </section>
</footer>
</body>
</html>