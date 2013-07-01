<div class="profiles form">
<?php
echo $this->Form->create('Profile',
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
		<legend><?php echo __('Edit Profile'); ?></legend>
	<?php 
		echo $this->Form->input('id');
		// echo $this->Form->input('User.username');
		// echo $this->Form->hidden('user_id', array('value' => $user_id));
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		// echo $this->Form->input('birthday', array('dateFormat'=>'DMY', 'minYear'=>1900, 'maxYear'=>date('Y')-18+1, 'empty'=>array('- -')));
		echo $this->Form->input('city');
		echo $this->Form->input('country');
		// echo $this->Form->input('prof_picture_id');
		// echo $this->Form->input('theme_id');
		// echo $this->Form->input('last_update', array('value' => $this->Time->daysAsSql()));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Profile information'), array('controller' => 'profiles', 'action' => 'edit')); ?> </li>
		<li><?php echo $this->Html->link(__('Change password'), array('controller' => 'users', 'action' => 'changePassword')); ?> </li>
		<li><?php echo $this->Html->link(__('Deactivate account'), array('controller' => 'users', 'action' => 'deactivate')); ?> </li>	</ul>
</div>
