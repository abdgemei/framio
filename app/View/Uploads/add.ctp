<div class="uploads form">
<?php echo $this->Form->create('Upload', array('type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Upload'); ?></legend>
	<?php
		echo $this->Form->input('Photo.title');
		echo $this->Form->input('Photo.description');
		echo $this->Form->input('files.', array('type'=>'file', 'multiple'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true)); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Uploads'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
