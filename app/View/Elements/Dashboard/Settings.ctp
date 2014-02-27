<div class="actions span4 offset2">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Account information'), array('controller' => 'users', 'action' => 'edit')); ?> </li>
        <!-- <li><?php echo $this->Html->link(__('Set Profile Picture'), array('controller' => 'uploads', 'action' => 'addProfilePicture')); ?> </li> -->
        <li><?php echo $this->Html->link(__('Change password'), array('controller' => 'users', 'action' => 'changePassword')); ?> </li>
        <!-- <li><?php echo $this->Html->link(__('Deactivate account'), array('controller' => 'users', 'action' => 'deactivate')); ?> </li> -->
    </ul>
</div>
