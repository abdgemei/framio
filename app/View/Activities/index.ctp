<?php // pr($activities); die; ?>
<div class="uploads index span11">
    <div class="actions span11">
        <h2><?php echo __('Activity Stream'); ?></h2>
        <?php echo $this->Html->link('Refresh stream', array('controller' => 'activities', 'action' => 'index'), array('id' => 'refreshStreamAction')); ?>
    </div>
    <div class="span11">
        <div id="feedContainer">
            <div id="timelineContainer">
                <div id="timeline"></div>
            </div>
        <?php foreach($activities as $activity) :
            switch ($activity['Activity']['activity_type_id']) {
                case 2:
                    echo $this->element('Feed/favoriteActivity', array('activity' => $activity));
                    break;
                case 3:
                    echo $this->element('Feed/followingActivity', array('activity' => $activity));
                    break;
                case 4:
                // pr($activity['Upload']['Photo']); die;
                    if (isset($activity['Upload']['Photo'])) {
                        if ($activity['Upload']['Photo']['is_visible'] == 0) {continue;} }
                    echo $this->element('Feed/uploadActivity', array('activity' => $activity));
                    break;
                case 7:
                    echo $this->element('Feed/commentActivity', array('activity' => $activity));
                    break;
            }
        endforeach; ?>
        </div>
    </div>
</div>
