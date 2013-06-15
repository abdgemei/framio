         <div class="hero-unit">
            <section class="row1">
                <img class="pull-left" src="images/images/images/profilepic_03.jpg"/>
                <h4 class="offset2">
                Brian Grey</p><br/><p>Egypt,Alexandria</p><p><a href="">www.Braingrey.com</a></p><p>Member since 2013</p>
                <button type="submit" id="hoverbtn" class="btn-primary btn-small">Follow</button></p>
                </h4>
            </section>
         </div>
    </div>
</div>
<div class="container">
    <div class="row-fluid" style="margin-left:0px; margin-top:-30px;">
        <aside class="span2" style="background-color:#444; margin-left:0px; padding-bottom:520px; width:17%;">
            <ul class="nav nav-list">
                <li><a href="friends.html">Friends</a></li>
                <li class="active"><a href="">Favorites</a></li>
                <li><a href="#">Featured Content</a></li>
                <li><a href="#">Featured Albums</a></li>
                <li><a href="#">Category</a></li>
            </ul>
            
        
        </aside>
        <aside class="span10" style=" background-color:#191919; margin-left:0px; padding-left:20px; padding-bottom:15px;">
            <ul>
                <li class="span4">
                  <a href="" class="thumbnail"><img src="images/images/images/camals.jpg"/></a>
                  <a href="" class="thumbnail">  <img src="images/images/images/flower.jpg"/></a>
                  <a href="" class="thumbnail">  <img src="images/images/images/boats.jpg"/></a>
                </li>
                <li class="span4">
                  <a href="" class="thumbnail">  <img src="images/images/images/boatview.jpg"/></a>
                  <a href="" class="thumbnail">  <img src="images/images/images/bridge.jpg"/></a>
                  <a href="" class="thumbnail">  <img src="images/images/images/dog.jpg"/></a>
                </li>
                <li class="span4">
                   <a href="" class="thumbnail"> <img src="images/images/images/farm.jpg"/></a>
                   <a href="" class="thumbnail"> <img src="images/images/images/jelly sweets.jpg"/></a>
                   <a href="" class="thumbnail"> <img src="images/images/images/girlondock.jpg"/></a>
                </li>
            </ul>
            <ul>
                <li class="span4">
                  <a href="" class="thumbnail"><img src="images/images/images/leaves.jpg"/></a>
                  
                 
                </li>
                <li class="span4">
                  <a href="" class="thumbnail">  <img src="images/images/images/ny.jpg"/></a>
                  
                  
                </li>
                <li class="span4">
                   <a href="" class="thumbnail"> <img src="images/images/images/lights.jpg"/></a>
                   
                   
                </li>
            </ul>
            <div class="offset3">   
                <a class="prev_big" href="profile-b.html" title="View Previous Page">Previous</a>
                <a class="next_big" href="page2.html" title="View Next Page">Next</a> 
            </div>
        </aside>
    </div>



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
	