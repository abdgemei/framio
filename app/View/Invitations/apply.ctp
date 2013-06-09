<div class="apply form">
<?php echo $this->Form->create(false, array('action' => '/apply')); ?>
    <fieldset>
        <legend><?php echo __('Sign up for an invitation'); ?></legend>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('website');
        echo $this->Form->submit(
            'Apply', 
            array('class' => 'btn btn-primary', 'title' => 'Custom Title')
        );
    ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
