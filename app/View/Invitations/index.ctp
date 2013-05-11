<div class="invitations index">
	<h2><?php echo __('Invitations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('website'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($invitations as $invitation): ?>
	<tr>
		<td><?php echo h($invitation['Invitation']['id']); ?>&nbsp;</td>
		<td><?php echo h($invitation['Invitation']['name']); ?>&nbsp;</td>
		<td><?php echo h($invitation['Invitation']['email']); ?>&nbsp;</td>
		<td><?php echo h($invitation['Invitation']['website']); ?>&nbsp;</td>
		<td><?php echo h($invitation['Invitation']['status']); ?>&nbsp;</td>
		<?php if($this->Invitation->isPending($invitation['Invitation']['id'])) : ?>
		<td class="actions">
			<?php echo $this->Html->link(__('Approve'), array('action' => 'approve', $invitation['Invitation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $invitation['Invitation']['id'])); ?>
		</td>
        <?php elseif(!$this->Invitation->isPending($invitation['Invitation']['id'])) : ?>
        <td class="actions">

        </td>
        <?php endif; ?>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
