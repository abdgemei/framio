<?php //pr($upload); die; ?>
<div class="uploads index span11">
    <div class="actions span11">
        <h2><?php echo __('View photo'); ?></h2>
        <?php echo $this->Html->link('Edit', array('controller' => 'uploads', 'action' => 'edit', $upload['Upload']['id']), array('id' => 'editAction')); ?>
        <?php
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
            <div class="socialActions">
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