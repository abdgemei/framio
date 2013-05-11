<div class="invitations form">
<?php echo $this->Form->create('Invitation'); ?>
	<fieldset>
		<legend><?php echo __('Add Invitation'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('website');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Invitations'), array('action' => 'index')); ?></li>
	</ul>
</div>
