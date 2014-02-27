<?php //pr($activity); die; ?>

<?php 

$time = date('Y-m-d H:i:s', $activity['Activity']['timestamp']);
$timeOptions = array(
        'accuracy' => array('hour' => 'hour', 'day' => 'day'),
        'end' => '1 week');


?>

        <div class="feedItem">
            <div class="activityBody">
            <?php //echo $this->PhpThumb->thumbnail($src, $options); ?>
            </div>
            <div class="description">
                <p><?php echo $this->Html->link(ucfirst($activity['User']['Profile']['first_name']), array('controller' => 'profiles', 'action' => 'view', $activity['User']['Profile']['username'])).' has '.$activity['ActivityType']['verb'].' a comment on '. $this->Html->link($activity['Comment']['Upload']['User']['Profile']['first_name'], array('controller' => 'profiles', 'action' => 'view', $activity['Comment']['Upload']['User']['id'])) .'\'s '. $this->Html->link('photo', array('controller' => 'uploads', 'action' => 'view', $activity['Comment']['Upload']['id'])) . '.' ?></p>
                <p><small><?php echo $this->Html->link($this->Time->timeAgoInWords($time, $timeOptions), array('controller' => 'uploads', 'action' => 'view', $activity['Comment']['upload_id'])); ?></small></p>
            </div>
        </div>
