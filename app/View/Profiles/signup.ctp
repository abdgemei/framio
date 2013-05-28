<div class="profiles form">
<?php echo $this->Form->create('Profile'); ?>
	<fieldset>
		<legend><?php echo __('Create your profile'); ?></legend>
	<?php
		//echo $this->Form->input('user_id');
		//echo $this->Form->input('User.name');
		echo $this->Form->input('User.email');
		echo $this->Form->input('User.password');
		echo $this->Form->input('User.password_confirmation', array('type' => 'password'));
		//echo $this->Form->input('name');
		echo $this->Form->input('birthday', array('dateFormat'=>'DMY', 'minYear'=>1900, 'maxYear'=>date('Y')-18+1, 'empty'=>array('- -')));
		echo $this->Form->input('city');
		//echo $this->Form->input('country');
        //echo $this->Form->input('prof_picture_id', array('type'=>'file'));
		//echo $this->Form->input('theme_id');
		//echo $this->Form->input('last_update');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Uploads'), array('controller' => 'uploads', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile Picture'), array('controller' => 'uploads', 'action' => 'add')); ?> </li>
	</ul>
</div>
