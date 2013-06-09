<div class="users form">
<?php // echo $this->Session->flash(); ?>
<?php echo $this->Form->create('User'); ?>
    <flieldset>
        <legend><?php echo __('Please enter your login email and password'); ?></legend>
        <?php echo $this->Form->input('email');
              echo $this->Form->input('password');
              echo $this->Form->submit(
                  'Log in', 
                  array('class' => 'btn btn-primary', 'title' => 'Custom Title')
              );
        ?>
    </flieldset>
<?php echo $this->Form->end(); ?>
</div>