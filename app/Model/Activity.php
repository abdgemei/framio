<?php
App::uses('AppModel', 'Model');
App::uses('Activity', 'Model');
App::uses('ActivityType', 'Model');
App::uses('Following', 'Model');
/**
 * Activity Model
 *
 * @property User $User
 * @property ActivityType $ActivityType
 * @property Source $Source
 * @property Object $Object
 */
class Activity extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'activity';
    public $actsAs = array('Containable');


    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ActivityType' => array(
            'className' => 'ActivityType',
            'foreignKey' => 'activity_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        // 'Album' => array(
        //     'className' => 'Album',
        //     'foreignKey' => 'album_id',
        //     'conditions' => '',
        //     'fields' => '',
        //     'order' => ''
        // ),
        'Favorite' => array(
            'className' => 'Favorite',
            'foreignKey' => 'favorite_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'comment_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Following' => array(
            'className' => 'Following',
            'foreignKey' => 'following_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ProfilePicture' => array(              //TODO
            'className' => 'ProfilePicture',
            'foreignKey' => 'profile_picture_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Upload' => array(
            'className' => 'Upload',
            'foreignKey' => 'upload_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function getActivityTypeId($objectTable) {
        $this->ActivityType = new ActivityType;
        if($this->ActivityType->hasAny(array('object_table' => $objectTable))) {
            $row = $this->ActivityType->findByObjectTable($objectTable);
            return $row['ActivityType']['id'];
        } else {
            return false;
        }
    }

    public function logActivity($data) {
        if($this->save($data)) {
            return true;
        } else {
            throw new InternalErrorException(__('Something went wrong!'));
        }
    }

    public function getFeed($followingList, $timeRange = null) {

        $this->Activity = new Activity;
        if(is_null($timeRange)) {
            $timeRange = time() - 84600;
        }
        $this->Activity->recursive = 2;

        $options['conditions'] = array(
            'Activity.user_id' => $followingList,
            'Activity.timestamp >' => $timeRange,
            );
        $options['contain'] = array(
            'User' => array('Profile'),
            'Upload' => array('Photo' => array('PhotoMetaDatum')),
            'Following' => array('FollowedUser' => array('Profile')),
            'Favorite',
            'Comment' => array('Upload' => array('User' => array('Profile'))),
            'ActivityType'
            );
        $options['limit'] = 10;
        $options['order'] = array('Activity.timestamp DESC');
        if($this->Activity->find('count', $options) > 10) {
            return $this->Activity->find('all', $options);
        } else {
            $options['conditions'] = array(
                'Activity.user_id' => $followingList,
                'Activity.timestamp >' => 0
                );
            return $this->Activity->find('all', $options);
        }
    }

}
