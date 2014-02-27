<?php //pr($upload); die;
    $src = 'content'.DS.$upload['Upload']['id'];
    $options =  array('w' => 620, 'hp' => 388, 'q' => 100, 'far' => 'C', 'bg' => 141414);
    if(!isset($upload['Upload']['Photo']['title'])) {$photoTitle = 'No title';}
?>

    <section class="row" id="main">
        <section class="span8" id="large-picture">
            <?php echo $this->PhpThumb->thumbnail($src, $options); ?>
            <p><?php echo $upload['Photo']['caption']; ?></p>

        </section>
        
        <section class="span3" id="photo-info">
            <h5><p><?php echo $this->Html->link($upload['User']['Profile']['first_name'].' '.$upload['User']['Profile']['last_name'], array('controller' => 'profiles', 'action' => 'view', $upload['User']['Profile']['username'])); ?><p></p><p style="font-size:14px; font-weight:normal;"><i class="icon-map-marker icon-white"></i><?php echo $upload['User']['Profile']['city'].', '.$upload['User']['Profile']['country']; ?></p></h5>

            <?php 
                if(CakeSession::read('Auth.User.id') !== $upload['Upload']['user_id']) {
                    if(!$upload['Photo']['is_downloadable']) {
                        echo "";
                    }
                } else {
                    echo $this->Html->link('Download', array('controller' => 'uploads', 'action' => 'download', $upload['Upload']['id']), array('id' => 'downloadAction'));
                } ?>

            <section class="offset">
                <?php if (is_null(CakeSession::read('Auth.User.id'))) : ?>
                <?php elseif ($upload['Upload']['user_id'] == CakeSession::read('Auth.User.id')) : ?>
                    <?php echo $this->Html->link('Edit', array('controller' => 'uploads', 'action' => 'edit', $upload['Upload']['id']), array('id' => 'editAction')); ?>
                <?php elseif (!$this->Following->isFollowing($upload['User']['id'])) : ?>
                <?php echo $this->Form->create(false, array('url' => array('controller' => 'users', 'action' => 'follow'))); ?>
                    <?php
                        echo $this->Form->hidden('Following.following_user_id', array('value'=> $upload['User']['id']));
                        echo $this->Form->submit('Follow', array('class' => 'btn btn-primary', 'id' => 'hoverbtn'));
                    ?>
                <?php echo $this->Form->end(); ?>

                <?php else : ?>    
                <?php echo $this->Form->create(false, array('url' => array('controller' => 'users', 'action' => 'unfollow'))); ?>
                    <?php
                        echo $this->Form->hidden('Following.following_user_id', array('value'=> $upload['User']['id']));
                        echo $this->Form->submit('Unfollow', array('class' => 'btn btn-primary', 'id' => 'hoverbtn'));
                    ?>
                <?php echo $this->Form->end(); ?>
                <?php endif; ?>

            </section>
            
            <section id="side-nav">
                <ul class="nav nav-tabs nav-stacked addthis_toolbox addthis_share_btn">
                        <?php if (is_null(CakeSession::read('Auth.User.id'))) : ?>

                        <?php elseif (!$this->Favorite->isFavorited($upload['Upload']['id'])) : ?>
                            <li>
                        <?php echo $this->Form->create(false, array('action'=>'/favorite')); ?>
                            <?php
                                echo $this->Form->hidden('Favorite.photo_id', array('value'=> $upload['Upload']['id']));
                            ?>
                        <?php echo $this->Form->end(__('Favorite', true)); ?>
                            </li>
                        <?php else : ?>
                            <li>
                        <?php echo $this->Form->create(false, array('action'=>'/unfavorite')); ?>
                            <?php
                                echo $this->Form->hidden('Favorite.photo_id', array('value'=> $upload['Upload']['id']));
                            ?>
                        <?php echo $this->Form->end(__('Unfavorite', true)); ?>
                            </li>
                        <?php endif; ?>

                </ul>
                <p>This was taken on <?php echo $this->Time->nice($upload['Photo']['PhotoMetaDatum']['date_taken'], null, '%B %e, %G') ?></p>
                <p><?php echo $upload['Photo']['PhotoMetaDatum']['camera_make'].' '.$upload['Photo']['PhotoMetaDatum']['camera_model'] ?></p>
                <p style="font-size:12px;">Setting: <?php echo $upload['Photo']['PhotoMetaDatum']['focal_length'] ?> <?php echo $upload['Photo']['PhotoMetaDatum']['aperture'] ?> <?php echo $upload['Photo']['PhotoMetaDatum']['iso_speed'] ?></p>
            </section>


            <ul id="Counts">
                    <li style="word-spacing:118px;"><i class="icon-thumbs-up icon-white"></i>Favorites<span> <?php echo $this->Favorite->favoriteCount($upload['Upload']['id']) ?></span></li>
                    <li style="word-spacing:100px;"><i class="icon-comment icon-white"></i>Comments<span> <?php echo $this->Comment->commentCount($upload['Upload']['id']) ?></span></li>
            </ul>
        </section>
    </section>
    
    <section class="row" id="post">
        <section id="addCommentForm commentbox" class="offset1">
        <?php if (!is_null(CakeSession::read('Auth.User.id'))) : ?>
        <?php echo $this->Form->create('Comment',
                array(
                    'url' => '/comments/add',
                    'class' => 'form-horizontal',
                    'inputDefaults' => array(
                            'div' => 'control-group',
                            'label' => array('class' => 'control-label'),
                            'between' => '<div class="controls">',
                            'after' => '</div>',
                        )
                    )); ?>
            <fieldset>
                <legend><?php echo __('Add Comment'); ?></legend>
            <?php
                echo $this->Form->hidden('user_id', array('value' => CakeSession::read('Auth.User.id')));
                echo $this->Form->hidden('upload_id', array('value' => $upload['Upload']['id']));
                // echo $this->Form->input('parent_id');
                echo $this->Form->textarea('text');
                // echo $this->Form->input('is_spam');
                echo $this->Form->hidden('timestamp', array('value' => time()));
                echo $this->Form->submit('Post', array('class' => 'btn btn-primary'));
            ?>
            </fieldset>
        <?php echo $this->Form->end(); ?>
        <?php endif; ?>
        </section>
        <section id="commentList" class="offset1">
            <h3>Comments</h3>
            <?php $timeOptions = array(
                'accuracy' => array('hour' => 'hour', 'day' => 'day'),
                'end' => '1 week'); ?>

        <?php foreach ($comments as $comment): ?>
            <?php //pr($comment); die; ?>
            <section class="span7 commentItem">
                <section>
                    <?php echo $this->Html->link($comment['User']['Profile']['first_name'].' '.$comment['User']['Profile']['last_name'], array('controller' => 'profiles', 'action' => 'view', $comment['User']['Profile']['username'])); ?> says:
                </section>
                <section><?php echo $comment['Comment']['text']; ?>&nbsp;</section>
                <td><?php echo $this->Time->timeAgoInWords($comment['Comment']['timestamp'], $timeOptions); ?>&nbsp;</td>
                <td class="actions">
                    <?php //echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['Comment']['id'])); ?>
                    <?php if($comment['Comment']['user_id'] == CakeSession::read('Auth.User.id')) : ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?>
                    <?php endif; ?>
                </td>
            </section>
        <?php endforeach; ?>
        </section>
    </section>
