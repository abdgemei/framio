
</div><?php //pr($uploads); die; ?>
<div class="profiles view">
<h2><?php  echo __('Profile'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($profile['Profile']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('User'); ?></dt>
        <dd>
            <?php echo $this->Html->link($profile['User']['id'], array('controller' => 'users', 'action' => 'view', $profile['User']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($profile['Profile']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Birthday'); ?></dt>
        <dd>
            <?php echo h($profile['Profile']['birthday']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('City'); ?></dt>
        <dd>
            <?php echo h($profile['Profile']['city']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Country'); ?></dt>
        <dd>
            <?php echo h($profile['Profile']['country']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Theme Id'); ?></dt>
        <dd>
            <?php echo h($profile['Profile']['theme_id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Last Update'); ?></dt>
        <dd>
            <?php echo h($profile['Profile']['last_update']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="uploads">
    <div class="row">
    <?php foreach($uploads as $upload) : ?>
        <div class="span3">
        <?php echo $this->Html->link($this->Html->image('/timthumb.php?src='.FULL_BASE_URL.DS.'content'.DS.$upload['Upload']['id'], array('alt'=>'image')), array('controller'=>'uploads', 'action'=>'view', $upload['Upload']['id']), array('escape'=>false)); ?>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Profile'), array('action' => 'edit', $profile['Profile']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Profile'), array('action' => 'delete', $profile['Profile']['id']), null, __('Are you sure you want to delete # %s?', $profile['Profile']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Uploads'), array('controller' => 'uploads', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Profile Picture'), array('controller' => 'uploads', 'action' => 'add')); ?> </li>
    </ul>
</div>
    <div class="related">
        <h3><?php echo __('Related Uploads'); ?></h3>
    <?php if (!empty($profile['Profile Picture'])): ?>
        <dl>
            <dt><?php echo __('Id'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['id']; ?>
&nbsp;</dd>
        <dt><?php echo __('User Id'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['user_id']; ?>
&nbsp;</dd>
        <dt><?php echo __('Title'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['title']; ?>
&nbsp;</dd>
        <dt><?php echo __('Description'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['description']; ?>
&nbsp;</dd>
        <dt><?php echo __('Filename'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['filename']; ?>
&nbsp;</dd>
        <dt><?php echo __('Filesize'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['filesize']; ?>
&nbsp;</dd>
        <dt><?php echo __('Filemime'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['filemime']; ?>
&nbsp;</dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['created']; ?>
&nbsp;</dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
    <?php echo $profile['Profile Picture']['modified']; ?>
&nbsp;</dd>
        </dl>
    <?php endif; ?>
        <div class="actions">
            <ul>
                <li><?php // echo $this->Html->link(__('Edit Profile Picture'), array('controller' => 'uploads', 'action' => 'edit', $profile['Profile Picture']['id'])); ?></li>
            </ul>
        </div>
    </div>
    