<div class="users form">
<?php
echo $this->Form->create('User',
    array(
        'class' => 'form-horizontal',
        'inputDefaults' => array(
                'div' => 'control-group',
            )
        ));

?>
    <fieldset>
        <legend><?php echo __('Forgot password'); ?></legend>
    <?php
        echo $this->Form->input('email');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
