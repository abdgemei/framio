<div class="users list">
<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'add')); ?>">Add new user</a>
    <table>
        <thead>
            <th>ID</th>
            <th>Username</th>
            <th>Group</th>
            <th>Creation date</th>
            <th>Last modified</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
<?php 
foreach ($usersList as $user) :
    extract($user);
?>
        <tr>
            <td><?php echo $User['id']; ?></td>
            <td><?php echo $User['username']; ?></td>
            <td><?php echo $User['group']; ?></td>
            <td><?php echo $User['created']; ?></td>
            <td><?php echo $User['modified']; ?></td>
            <td><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $User['id'])); ?>">Edit</a></td>
            <td><?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $User['id']),
                array('confirm' => 'Are you sure?'));
            ?></td>
        </tr>
<?php endforeach; ?>
    </table>
</div>