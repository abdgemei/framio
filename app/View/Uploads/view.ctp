<?php // pr($upload); die; ?>
<div class="uploads view">
<h2><?php  echo __('Upload'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($upload['Upload']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($upload['User']['id'], array('controller' => 'users', 'action' => 'view', $upload['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($upload['Upload']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($upload['Upload']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Preview'); ?></dt>
		<dd>
		    <?php echo $this->Html->image(FULL_BASE_URL.'/content/'.$upload['Upload']['id'], array('alt' => $upload['Upload']['title'])); ?>

		    &nbsp;
		</dd>
		<dt><?php echo __('Filename'); ?></dt>
		<dd>
			<?php echo h($upload['Upload']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filesize'); ?></dt>
		<dd>
			<?php echo h($upload['Upload']['filesize']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Filemime'); ?></dt>
		<dd>
			<?php echo h($upload['Upload']['filemime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($upload['Upload']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($upload['Upload']['modified']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Download'); ?></dt>
        <dd>
           <?php echo $this->Html->link(__('Download', true), array('action' => 'download', $upload['Upload']['id'])); ?>
           
        </dd>
        <?php foreach($uploadMetadata as $metaKey => $metaValue) : ?>
        <dt><?php echo __($metaKey); ?></dt>
        <dd>
            <?php echo $metaValue ?>
        </dd>
        <?php endforeach; ?>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Upload'), array('action' => 'edit', $upload['Upload']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Upload'), array('action' => 'delete', $upload['Upload']['id']), null, __('Are you sure you want to delete # %s?', $upload['Upload']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Uploads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Upload'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
