<?php // debug($uploads); ?>
<div class="uploads index span11">
	<div class="actions span11">
		<h2><?php echo __('My Photos'); ?></h2>
		<?php echo $this->Html->link('Upload', array('controller' => 'uploads', 'action' => 'add'), array('id' => 'uploadAction')); ?>
        <div class="search form-search">
            <div class="input-append">
                <?php   $this->Form->create('Search', array(
                'inputDefaults' => array('label'=>false, 'div'=>false)));
                        //echo $this->Form->input('search', array('placeholder' => 'search photos', 'class' => 'search-query', 'id' => 'appendedInputButtons'));
                        //echo $this->Form->submit('Search', array('class' => 'btn', 'div' => false, 'type' => 'button'))
                ?>
            </div>
            <div id="viewOptions">

            </div>
        </div>
	</div>
	<div class="span11" id="photosContainer">
	<?php foreach($uploads as $upload) : ?>
        <?php 
        $src =      'content'.DS.$upload['Upload']['id'];
        $options =  array('w' => 100, 'h' => 80, 'zc' => 'z', 'q' => 100);?>
		<div class="span7 item">
            <div class="span2 thumb">
			<?php echo $this->Html->link($this->PhpThumb->thumbnail($src, $options), array('controller' => 'uploads', 'action' => 'view', $upload['Upload']['id']), array('escape' => false, 'id' => 'uploadAction')); ?>
            </div>
			<div class="span5 info">
                <p>
    			<?php echo $this->Html->link($upload['Upload']['filename'], array('controller' => 'uploads', 'action' => 'view', $upload['Upload']['id']), array('class' => 'itemLink')); ?>
                </p>
                <p> Taken on
                <?php echo $this->Time->nice(strtotime($upload['Photo']['PhotoMetaDatum']['date_taken']), null, '%A, %B %eS, %G'); ?>
                </p>
            </div>
		</div>
	<?php endforeach; ?>
	</div>
</div>