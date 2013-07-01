<div class="users form">
<?php
echo $this->Form->create('User',
    array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
                'div' => 'control-group',
                'label' => array('class' => 'control-label'),
                'between' => '<div class="controls">',
                'after' => '</div>'
            )
        ));

?>
    <fieldset>
        <legend><?php echo __('Change password'); ?></legend>
    <?php
        echo $this->Form->input('password');
        echo $this->Form->input('password_confirmation', array('type' => 'password'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Save')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Account information'), array('controller' => 'users', 'action' => 'edit')); ?> </li>
        <li><?php echo $this->Html->link(__('Set Profile Picture'), array('controller' => 'uploads', 'action' => 'addProfilePicture')); ?> </li>
        <li><?php echo $this->Html->link(__('Change password'), array('controller' => 'users', 'action' => 'changePassword')); ?> </li>
        <li><?php echo $this->Html->link(__('Deactivate account'), array('controller' => 'users', 'action' => 'deactivate')); ?> </li>
    </ul>
</div>
    