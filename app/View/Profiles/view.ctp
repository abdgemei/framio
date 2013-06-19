         <div class="hero-unit">
            <section class="row1">
                <?php echo $this->Html->link($this->Html->image('/timthumb.php?w=198&src='.FULL_BASE_URL.DS.'content'.DS.$profile_pictures['ProfilePictures']['upload_id'], array('alt'=>'image', 'class' => 'pull-left')), array('controller' => 'uploads', 'action'=>'view', $profile_pictures['ProfilePictures']['upload_id']), array('escape'=>false)); ?>
                <?php //pr($profile_pictures); die; ?>
                <h4 class="offset2">
                <?php echo $profile['Profile']['name']; ?></p><br/><p><?php echo h($profile['Profile']['city']).', '.$profile['Profile']['country']; ?></p><p><?php echo $profile['User']['created'] ?></p>
                <button type="submit" id="hoverbtn" class="btn-primary btn-small">Follow</button></p>
                </h4>
            </section>
         </div>
    </div>
</div>
<div class="container">
    <div class="row-fluid" style="margin-left:0px; margin-top:-30px;">
        <aside class="span2" id="transparentGray" style="margin-left:0px; padding-bottom:520px; width:17%;">
            <ul class="nav nav-list">
                <li><a href="friends.html">Friends</a></li>
                <li class="active"><a href="">Favorites</a></li>
                <li><a href="#">Featured Content</a></li>
                <li><a href="#">Featured Albums</a></li>
                <li><a href="#">Category</a></li>
            </ul>
            
        
        </aside>
        <section class="span10" style=" background-color:#191919; margin-left:0px; padding-left:20px; padding-bottom:15px;">
            <ul>
            <?php foreach($uploads as $upload) : ?>
                <li class="span4">
                    <?php echo $this->Html->link($this->Html->image('/timthumb.php?w=198&src='.FULL_BASE_URL.DS.'content'.DS.$upload['Upload']['id'], array('alt'=>'image', 'class' => 'thumbnail')), array('controller'=>'uploads', 'action'=>'view', $upload['Upload']['id']), array('escape'=>false)); ?>
                </li>
            <?php endforeach; ?>
            <div class="span8 offset3">   
                <a class="prev_big" href="profile-b.html" title="View Previous Page">Previous</a>
                <a class="next_big" href="page2.html" title="View Next Page">Next</a> 
            </div>
        </aside>
    </div>


