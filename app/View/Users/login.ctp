<?php echo $this->Form->create('User', array(
        'inputDefaults' => array('label'=>false, 'div'=>false)
        )); ?>
    <flieldset>
        <legend><?php echo __('Log in') ?></legend>
        <?php echo $this->Form->input('email', array('id'=>'emailForm', 'placeholder' => 'Email'));
              echo $this->Form->input('password', array('placeholder'=>'Password', 'id'=>'passForm'));
              echo $this->Form->submit(
                  'Log in', 
                  array('class' => 'btn btn-primary', 'title' => 'Custom Title', 'id'=>'signInButton', 'div'=>false)
              );
        ?>
    </flieldset>
<?php echo $this->Form->end(); ?>
        <p>New here? <?php echo $this->Html->link('Sign up for an invitation', array('controller'=>'invitations', 'action'=>'apply'), array('title'=>'Come in!')); ?>!</p>
        <p><?php echo $this->Html->link('Forgot your password', array('controller'=>'users', 'action'=>'resetPassword'), array('title'=>'Reset your password here')); ?>?</p>
