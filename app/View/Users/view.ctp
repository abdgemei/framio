<div class="users list">
<?php 
    extract($usersList);
?>
    <table>
        <thead>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Creation date</th>
            <th>Last modified</th>
        </thead>
        <tr>
            <td><?php echo $User['id']; ?></td>
            <td><?php echo $User['username']; ?></td>
            <td><?php echo $User['role']; ?></td>
            <td><?php echo $User['created']; ?></td>
            <td><?php echo $User['modified']; ?></td>
        </tr>
    </table>
</div>