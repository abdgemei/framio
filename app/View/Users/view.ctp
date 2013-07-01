<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<?php if (!$this->Following->isFollowing($user['User']['id'])) : ?>
        <dt><?php echo __('Follow'); ?></dt>
        <dd>
        <?php echo $this->Form->create(false, array('action'=>'/follow')); ?>
            <?php
                echo $this->Form->hidden('Following.following_user_id', array('value'=> $user['User']['id']));
            ?>
        <?php echo $this->Form->end(__('Follow', true)); ?>
        </dd>
        <?php else : ?>
            
        <dt><?php echo __('Unfollow'); ?></dt>
        <dd>
        <?php echo $this->Form->create(false, array('action'=>'/unfollow')); ?>
            <?php
                echo $this->Form->hidden('Following.following_user_id', array('value'=> $user['User']['id']));
            ?>
        <?php echo $this->Form->end(__('Unfollow', true)); ?>
        </dd>
        <?php endif; ?>
        <dt><?php echo __('Followers'); ?></dt>
        <dd>
            <?php echo $this->Following->followCount($user['User']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Following'); ?></dt>
        <dd>
            <?php echo $this->Following->followingCount($user['User']['id']); ?>
            &nbsp;
        </dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
