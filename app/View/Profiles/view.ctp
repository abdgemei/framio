<?php //pr($uploads); die; ?>

            <ul>
            <?php foreach($uploads as $upload) : ?>
                <?php $src = 'content'.DS.$upload['Upload']['id'];
                      $options =  array('w' => 220, 'hp' => 138, 'q' => 100, 'zc' => 'C'); ?>
                <li class="span3">
                    <a href="<?php echo $this->Html->url(array('controller'=>'uploads', 'action'=>'view', $upload['Upload']['id']), false) ?>" class="thumbnailLink">

                        <?php echo $this->PhpThumb->thumbnail($src, $options); ?>
                        <div class="slidingPanel" id="icons">
                               <section id="view-icon"><i class="icon-comment"></i> <?php echo $this->Comment->commentCount($upload['Upload']['id']); ?></section>
                               <section id="like-icon"><i class="icon-thumbs-up"></i> <?php echo $this->Favorite->favoriteCount($upload['Upload']['id']) ?></section>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
