<?php echo $this->Form->create('User', array(
        'inputDefaults' => array('label'=>false, 'div'=>false),
        'url' => array('controller'=>'users','action'=>'login')
        )); ?>
    <flieldset>
        <?php echo $this->Form->input('email', array('id'=>'emaiForm', 'placeholder' => 'Email'));
              echo $this->Form->input('password', array('placeholder'=>'Password', 'id'=>'passForm'));
              echo $this->Form->submit(
                  'Log in', 
                  array('class' => 'btn btn-primary', 'title' => 'Custom Title', 'id'=>'signInButton', 'div'=>false)
              );
        ?>
    </flieldset>
<?php echo $this->Form->end(); ?>
