<div class="users form span5">
	<div class="span5">
		<h2><?php echo __('Settings'); ?></h2>
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
			<legend>Account information</legend>
		<?php
			//echo $this->Form->input('id');
			echo $this->Form->input('username');
			echo $this->Form->input('email');
			echo $this->Form->input('Preference.timezone');

			echo $this->Form->input('Profile.first_name');
			echo $this->Form->input('Profile.last_name');

			echo $this->Form->input('Profile.city');
			echo $this->Form->input('Profile.country');
			// echo $this->Form->input('password');
	        // echo $this->Form->input('password_confirmation', array('type' => 'password'));
			// echo $this->Form->input('group');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
</div>
<div class="actions span4 offset2">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Account information'), array('controller' => 'users', 'action' => 'edit')); ?> </li>
		<li><?php echo $this->Html->link(__('Set Profile Picture'), array('controller' => 'uploads', 'action' => 'addProfilePicture')); ?> </li>
		<li><?php echo $this->Html->link(__('Change password'), array('controller' => 'users', 'action' => 'changePassword')); ?> </li>
		<li><?php echo $this->Html->link(__('Deactivate account'), array('controller' => 'users', 'action' => 'deactivate')); ?> </li>
	</ul>
</div>
