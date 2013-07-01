<?php //pr($activity); die; ?>

<?php 

$time = date('Y-m-d H:i:s', $activity['Activity']['timestamp']);
$timeOptions = array(
        'accuracy' => array('hour' => 'hour', 'day' => 'day'),
        'end' => '1 week'

);


?>

        <div class="feedItem">
            <div class="activityBody">
            <?php //echo $this->PhpThumb->thumbnail($src, $options); ?>
            </div>
            <div class="description">
                <p><?php echo ucfirst($activity['User']['Profile']['first_name']).' has '.$activity['ActivityType']['verb'].' '.$this->Html->link(ucfirst($activity['Following']['FollowedUser']['Profile']['first_name'] . ' ' . ucfirst($activity['Following']['FollowedUser']['Profile']['last_name'])), array('controller' => 'profiles', 'action' => 'view', $activity['Following']['FollowedUser']['Profile']['username'] ));'.' ?></p>
                <p><small><?php echo $this->Time->timeAgoInWords($time, $timeOptions); ?></small></p>
            </div>
        </div>
