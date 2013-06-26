<?php //pr($uploads); ?>
<div class="uploads index">
	<div class="row" id="actions">
		<div class="span7">
			<h2><?php echo __('My Photos'); ?></h2>
			<?php echo $this->Html->link('Upload', array('controller' => 'uploads', 'action' => 'add'), array('id' => 'uploadAction')); ?>
		</div>
		<div class="span7">
			<?php 	$this->Form->create('Search', array(
	        'inputDefaults' => array('label'=>false, 'div'=>false)));
	 				echo $this->Form->input('search', array('value' => 'search photos'));
	 		?>
	 		<div id="viewOptions">

	 		</div>
		</div>
	</div>
	<div class="row" id="content">
	<?php foreach($uploads as $upload) : ?>
        <?php 
        $src =      'content'.DS.$upload['Upload']['id'];
        $options =  array('w' => 100, 'h' => 80, 'zc' => 'z', 'q' => 100);?>
		<div class="span7 item">
            <div class="span2 thumb">
			<?php echo $this->Html->link($this->PhpThumb->thumbnail($src, $options), array('controller' => 'uploads', 'action' => 'view', $upload['Upload']['id']), array('escape' => false)); ?>
            </div>
			<div class="span5 info">
                <p>
    			<?php echo $this->Html->link($upload['Upload']['filename'], array('controller' => 'uploads', 'action' => 'view', $upload['Upload']['id']), array('class' => 'itemLink')); ?>
                </p>
                <p>
                <?php echo $this->Time->nice($upload['Photo']['PhotoMetaDatum']['date_taken']); ?>
                </p>
            </div>
		</div>
	<?php endforeach; ?>
	</div>
</div>