    <nav class="span7">
        <ul>
            <li><?php echo $this->Html->link('Discover', array('controller'=>'pages','action'=>'display','discover'), array('title'=>'Photos from the community')); ?></li>
            <li><?php echo $this->Html->link('Tour', array('controller'=>'pages','action'=>'display','tour'), array('title'=>'Learn about Framio')); ?></li>
            <li><?php echo $this->Html->link('About', array('controller'=>'pages','action'=>'display','about'), array('title'=>'Behind the scenes')); ?></li>
        </ul>
    </nav>
    <section class="inviteLink">
        <?php echo $this->Html->link('Sign up for an invite', array('controller'=>'invitations','action'=>'apply'), array('title'=>'Come in!')); ?>
    </section>
