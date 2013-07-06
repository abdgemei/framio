<?php //pr($upload); die; ?>
<div class="uploads index span11">
    <div class="actions span11">
        <h2><?php echo __('View photo'); ?></h2>
        <?php 

        if(CakeSession::read('Auth.User.id') !== $upload['Upload']['user_id']) {
            echo "";
        } else {
            echo $this->Html->link('Edit', array('controller' => 'uploads', 'action' => 'edit', $upload['Upload']['id']), array('id' => 'editAction'));
        }
        if(CakeSession::read('Auth.User.id') !== $upload['Upload']['user_id']) {
            if(!$upload['Photo']['is_downloadable']) {
                echo "";
            }
        } else {
            echo $this->Html->link('Download', array('controller' => 'uploads', 'action' => 'download', $upload['Upload']['id']), array('id' => 'downloadAction'));
        }
        ?>
        </div>
    </div>
    <div class="span11" id="photosContainer">
        <?php 
        $src = 'content'.DS.$upload['Upload']['id'];
        $options =  array('w' => 540, 'hp' => 338, 'q' => 100, 'far' => 'C');
        if(!isset($upload['Upload']['Photo']['title'])) {$photoTitle = 'No title';}
        ?>
        <div class="span6 photo">
            <?php echo $this->PhpThumb->thumbnail($src, $options); ?>
            <div id="socialActions">
                <div id="favorites">
                    <?php if (!$this->Favorite->isFavorited($upload['Upload']['id'])) : ?>
                    <dt><?php echo __('Favorite'); ?></dt>
                    <dd>
                    <?php echo $this->Form->create(false, array('action'=>'/favorite')); ?>
                        <?php
                            echo $this->Form->hidden('Favorite.photo_id', array('value'=> $upload['Upload']['id']));
                        ?>
                    <?php echo $this->Form->end(__('Favorite', true)); ?>
                    </dd>
                    <?php else : ?>
                        
                    <dt><?php echo __('Unfavorite'); ?></dt>
                    <dd>
                    <?php echo $this->Form->create(false, array('action'=>'/unfavorite')); ?>
                        <?php
                            echo $this->Form->hidden('Favorite.photo_id', array('value'=> $upload['Upload']['id']));
                        ?>
                    <?php echo $this->Form->end(__('Unfavorite', true)); ?>
                    </dd>
                    <?php endif; ?>
                    <dt><?php echo __('Favorites'); ?></dt>
                    <dd>
                        <?php echo $this->Favorite->favoriteCount($upload['Upload']['id']); ?>
                        &nbsp;
                    </dd>
                </div>
                <div id="comments">
                    <div id="addCommentForm">
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
                    </div>
                    <div id="commentList">
                    <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?php echo h($comment['Comment']['id']); ?>&nbsp;</td>
                        <td>
                            <?php echo $this->Html->link($comment['User']['id'], array('controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?>
                        </td>
                        <td>
                            <?php echo $this->Html->link($comment['ParentComment']['text'], array('controller' => 'comments', 'action' => 'view', $comment['ParentComment']['id'])); ?>
                        </td>
                        <td><?php echo h($comment['Comment']['text']); ?>&nbsp;</td>
                        <td><?php echo h($comment['Comment']['is_spam']); ?>&nbsp;</td>
                        <td><?php echo h($comment['Comment']['timestamp']); ?>&nbsp;</td>
                        <td class="actions">
                            <?php //echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['Comment']['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="span4 info">
            <p>
                <h3><?php echo $photoTitle; ?></h3>
                <small><?php echo $upload['Upload']['id']; ?></small>
            </p>
            <h3>Metadata</h3>
            <dl id="metadata">
                <?php foreach($upload['Photo']['PhotoMetaDatum'] as $metaKey => $metaValue) : ?>
                    <?php if(($metaKey == 'id') || ($metaKey == 'photo_id')) {continue;} ?>
                    <?php if($metaKey == 'date_taken') {$metaValue = $this->Time->nice($metaValue);} ?>
                <dt><?php echo Inflector::humanize($metaKey); ?></dt>
                <dd>
                    <?php echo $metaValue; ?>
                </dd>
                <?php endforeach; ?>
            </dl>
        </div>
    </div>
</div>