<div class="photos view">
<h2><?php  echo __('Photo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Upload'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photo['Upload']['title'], array('controller' => 'uploads', 'action' => 'view', $photo['Upload']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Caption'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['caption']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photo'), array('action' => 'edit', $photo['Photo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Photo'), array('action' => 'delete', $photo['Photo']['id']), null, __('Are you sure you want to delete # %s?', $photo['Photo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Uploads'), array('controller' => 'uploads', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Upload'), array('controller' => 'uploads', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photo Meta Data'), array('controller' => 'photo_meta_data', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo Meta Datum'), array('controller' => 'photo_meta_data', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Albums'), array('controller' => 'albums', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Album'), array('controller' => 'albums', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Photo Meta Data'); ?></h3>
	<?php if (!empty($photo['PhotoMetaDatum'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Photo Id'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['photo_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Date Taken'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['date_taken']; ?>
&nbsp;</dd>
		<dt><?php echo __('Camera Make'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['camera_make']; ?>
&nbsp;</dd>
		<dt><?php echo __('Camera Model'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['camera_model']; ?>
&nbsp;</dd>
		<dt><?php echo __('X Resolution'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['x_resolution']; ?>
&nbsp;</dd>
		<dt><?php echo __('Y Resolution'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['y_resolution']; ?>
&nbsp;</dd>
		<dt><?php echo __('Orientation'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['orientation']; ?>
&nbsp;</dd>
		<dt><?php echo __('Focal Length'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['focal_length']; ?>
&nbsp;</dd>
		<dt><?php echo __('Aperture'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['aperture']; ?>
&nbsp;</dd>
		<dt><?php echo __('Iso Speed'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['iso_speed']; ?>
&nbsp;</dd>
		<dt><?php echo __('Gps Longitude'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['gps_longitude']; ?>
&nbsp;</dd>
		<dt><?php echo __('Gps Latitude'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['gps_latitude']; ?>
&nbsp;</dd>
		<dt><?php echo __('Exposure Time'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['exposure_time']; ?>
&nbsp;</dd>
		<dt><?php echo __('Flash'); ?></dt>
		<dd>
	<?php echo $photo['PhotoMetaDatum']['flash']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Photo Meta Datum'), array('controller' => 'photo_meta_data', 'action' => 'edit', $photo['PhotoMetaDatum']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Albums'); ?></h3>
	<?php if (!empty($photo['Album'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Label'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($photo['Album'] as $album): ?>
		<tr>
			<td><?php echo $album['id']; ?></td>
			<td><?php echo $album['user_id']; ?></td>
			<td><?php echo $album['name']; ?></td>
			<td><?php echo $album['label']; ?></td>
			<td><?php echo $album['description']; ?></td>
			<td><?php echo $album['created']; ?></td>
			<td><?php echo $album['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'albums', 'action' => 'view', $album['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'albums', 'action' => 'edit', $album['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'albums', 'action' => 'delete', $album['id']), null, __('Are you sure you want to delete # %s?', $album['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Album'), array('controller' => 'albums', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
