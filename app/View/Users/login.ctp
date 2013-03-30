<div class="users form">
<?php // echo $this->Session->flash(); ?>
<?php echo $this->Form->create('User'); ?>
    <flieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('username');
              echo $this->Form->input('password'); ?>
    </flieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>