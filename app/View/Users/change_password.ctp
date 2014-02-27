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
<?php echo $this->element('Dashboard/Settings'); ?>