<?php echo $this->Form->create('User', array('inputDefaults'=>array('label'=>false, 'div'=>false))); ?>
    <flieldset>
        <?php echo $this->Form->input('email', array('value'=>'Email', 'id'=>'emaiForm'));
              echo $this->Form->input('password', array('value'=>'Password', 'id'=>'passForm'));
              echo $this->Form->submit(
                  'Log in', 
                  array('class' => 'btn btn-primary', 'title' => 'Custom Title', 'id'=>'signInButton', 'div'=>false)
              );
        ?>
    </flieldset>
<?php echo $this->Form->end(); ?>
