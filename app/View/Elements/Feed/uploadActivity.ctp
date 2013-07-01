<?php //pr($activity); die; ?>

<?php 

$src = 'content'.DS.$activity['Upload']['id'];
// $options = array('w' => 390, 'hp' => 244, 'q' => 100, 'far' => 'C');
$options = array('w' => 390, 'h' => 244, 'q' => 100, 'zc' => 'C');
$time = date('Y-m-d H:i:s', $activity['Activity']['timestamp']);
$timeOptions = array(
        'accuracy' => array('hour' => 'hour', 'day' => 'day'),
        'end' => '1 week'

);
?>

        <div class="feedItem">
            <div class="activityBody">
            <?php echo $this->PhpThumb->thumbnail($src, $options); ?>
            </div>
            <div class="description">
                <p><?php echo $this->Html->link(ucfirst($activity['User']['Profile']['first_name']), array('controller' => 'profiles', 'action' => 'view', $activity['User']['Profile']['username'])).' has '.$activity['ActivityType']['verb'].' a photo.' ?></p>
                <p><small><?php echo $this->Html->link($this->Time->timeAgoInWords($time, $timeOptions), array('controller' => 'uploads', 'action' => 'view', $activity['Upload']['id'])); ?></small></p>
            </div>
        </div>
