<?php //pr($profile); die; ?>
    <section class="row" id="userInfo">
        <section class="span4" id="profileInfo">
            <?php echo $this->Html->image(null, array('width' => 130, 'height' => 174)); ?>
            <h5 class="pull-right">
            <p style="font-size:18px;"><?php echo $profile['Profile']['first_name'].' '.$profile['Profile']['last_name']; ?></p></br><p><?php echo $profile['Profile']['city'].', '.$profile['Profile']['country']; ?></p><p>Member since <?php echo $this->Time->nice($profile['User']['created']); ?></p>
            </h5>

            <?php if (!$this->Following->isFollowing($profile['User']['id'])) : ?>
            <?php echo $this->Form->create(false, array('url' => array('controller' => 'users', 'action' => 'follow'))); ?>
                <?php
                    echo $this->Form->hidden('Following.following_user_id', array('value'=> $profile['User']['id']));
                    echo $this->Form->submit('Follow', array('class' => 'btn btn-primary', 'id' => 'hoverbtn'));
                ?>
            <?php echo $this->Form->end(); ?>
            <?php else : ?>
                
            <?php echo $this->Form->create(false, array('url' => array('controller' => 'users', 'action' => 'unfollow'))); ?>
                <?php
                    echo $this->Form->hidden('Following.following_user_id', array('value'=> $profile['User']['id']));
                    echo $this->Form->submit('Unfollow', array('class' => 'btn btn-primary', 'id' => 'hoverbtn'));
                ?>
            <?php echo $this->Form->end(); ?>
            <?php endif; ?>

           
        </section>
   
        <section class="offset4 span4" id="followingFollowers">
          <div class="btn-group">
              <button class="btn"><span>Photos</span><br /><strong><?php echo $this->Photo->photoCount($profile['User']['id']); ?></strong></button>
              <button class="btn"><span>Following</span><br /><strong><?php echo $this->Following->followingCount($profile['User']['id']); ?></strong></button>
              <button class="btn"><span>Followers</span><br /><strong><?php echo $this->Following->followCount($profile['User']['id']); ?></strong></button>
          </div>
        </section>
    </section>
    <?php if(!empty($profile['Profile']['about_me'])) : ?>
    <section class="row" id="aboutMe">
        <section class="span12">
            
            <h4>About me:</h4>
            <p>
                <?php echo $profile['Profile']['about_me']; ?>
            </p>
        </section>
    </section>
    <?php endif; ?>
