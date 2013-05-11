<div class="apply form">
<?php echo $this->Form->create(false, array('action' => '/apply')); ?>
    <fieldset>
        <legend><?php echo __('Signup for an invite'); ?></legend>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('website');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Apply')); ?>
</div>
