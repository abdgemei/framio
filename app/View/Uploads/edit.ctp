<div class="uploads form span5">
	<div class="span5">
		<h2>Upload</h2>
	<?php echo $this->Form->create('Upload',
	array(
		'class' => 'form-horizontal',
		'inputDefaults' => array(
				'div' => 'control-group',
				'label' => array('class' => 'control-label'),
				'between' => '<div class="controls">',
				'after' => '</div>',

			)
		));
	$checkboxOptions = array(
				'label' => false,
				'before' => '<label class="checkbox inline">',
				'separator' => '</label>'
				)
?>
		<fieldset>
			<legend><?php echo __('Edit Photo'); ?></legend>
			<?php
			echo $this->Form->input('id');
			echo $this->Form->input('Photo.id');
			echo $this->Form->input('Photo.title');
			echo $this->Form->input('Photo.description');
			echo $this->Form->input('Photo.caption', array('type' => 'textarea'));
			echo '<div class="control-group form-inline">';
			echo $this->Form->label('Photo.is_downloadable', 'Downloable');
			echo $this->Form->input('Photo.is_downloadable', array(
				'label' => false,
				'div' => false,
				));
			echo $this->Form->label('Photo.is_visible', 'Visibility');
			echo $this->Form->input('Photo.is_visible', array(
				'label' => false,
				'div' => false,
				));
			echo $this->Form->label('Photo.comments_enabled', 'Enable comments');
			echo $this->Form->input('Photo.comments_enabled', array(
				'label' => false,
				'div' => false,
				));
			echo '</div>';
			?>
		</fieldset>
		<?php 
			$options = array(
				'label' => __('Save'),
				'class' => 'btn btn-primary'
				);
		?>
	<?php echo $this->Form->end($options); ?>
	</div>
</div>
<div class="actions span4 offset2">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Upload.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Upload.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Uploads'), array('action' => 'index')); ?></li>
	</ul>
</div>
