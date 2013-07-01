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
        echo $this->Form->input('email');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
