<?php echo $this->element('Profile/header'); ?>
<?php echo $this->element('Profile/info', array('profile' => $profile)); ?>
    <section class="row" id="mainContent">
        <section class="span12" id="profileContent">
<?php echo $this->fetch('content'); ?>            
        </section>
    </section>
</section>
</body>
</html>
