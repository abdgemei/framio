<?php
App::uses('AppModel', 'Model');
App::uses('User', 'Model');
App::uses('Activity', 'Model');
/**
 * Following Model
 *
 * @property User $User
 * @property FollowingUser $FollowingUser
 */
class Following extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'following';


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
		'FollowingUser' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FollowedUser' => array(
			'className' => 'User',
			'foreignKey' => 'following_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasOne = array(
		'Activity' => array(
			'dependent' => true,
		)
	);

	public function afterSave($created) {
		if($created) {
			$this->Activity = new Activity;
			$lastInsertData = $this->findById($this->getLastInsertId());

			$data = array(
	                'id' => null,
	                'user_id' => $lastInsertData['FollowingUser']['id'],
	                'activity_type_id' => $this->Activity->getActivityTypeId($this->useTable),
	                'following_id' => $lastInsertData['Following']['id'],
	                'object_id' => $lastInsertData['FollowedUser']['id'],
	                'timestamp' => $lastInsertData['Following']['timestamp']
	            );

			$this->Activity->logActivity($data);
		}
	}
    
    public function isFollowing($following_user_id) {
        $conditions = array(
            'Following.user_id' => $this->Session->read('Auth.User.id'),
            'Following.following_user_id' => $following_user_id
        );
        if ($this->hasAny($conditions)) {
            return true;
        } else {
            return false;
        }
    }

    public function getFollowerCount($user_id) {
        $user = new User;
        $conditions = array(
            'id' => $user_id
        );
        if($user->hasAny($conditions)) {
            $followers = $this->find('all', array('conditions'=>array('Following.following_user_id'=>$user_id)));
            $followCount = sizeOf($followers);
            return $followCount;
        } else {
            throw new NotFoundException(__('User not found'));
        }
    }

    public function getFollowersList($user_id = null) {
    	$this->User = new User;
        if(is_null($user_id)) {
        	$user_id = CakeSession::read('Auth.User.id');
        }
        $conditions = array(
            'id' => $user_id
        );
        if($this->User->hasAny($conditions)) {
        	$this->unbindModel(array(
        		'belongsTo' => array('FollowingUser'),
        		'hasOne' => array('Activity')
        		));
            $followersList = $this->find('all', array('conditions'=>array('Following.following_user_id'=>$user_id)));
            return $followersList;
        } else {
            throw new NotFoundException(__('User not found'));
        }
    }

    public function getFollowingCount($user_id) {
        $following = new Following;
        $conditions = array(
            'id' => $user_id
        );
        if($user->hasAny($conditions)) {
            $following = $this->find('all', array('conditions'=>array('Following.user_id'=>$user_id)));
            $followingCount = sizeOf($following);
            return $followingCount;
        } else {
            throw new NotFoundException(__('User not found'));
        }
        
    }

    public function getFollowingList($user_id = null) {
    	$this->User = new User;
        if(is_null($user_id)) {
        	$user_id = CakeSession::read('Auth.User.id');
        }
        $conditions = array(
            'id' => $user_id
        );
        
        if($this->User->hasAny($conditions)) {
        	$this->unbindModel(array(
        		'belongsTo' => array('FollowingUser'),
        		'hasOne' => array('Activity')
        		));
            
            $followingList = $this->find('list', array('conditions'=>array('Following.user_id'=>$user_id)));
            
            foreach($followingList as $followedUser) {
            	$id = $this->findById($followedUser);
            	$followedUsersIdList[] = $id['Following']['following_user_id'];
            }
            
            return $followedUsersIdList;
        } else {
            throw new NotFoundException(__('User not found'));
        }
        
    }
    public function getFollowingListDetailed($user_id = null) {
    	$this->User = new User;
        if(is_null($user_id)) {
        	$user_id = CakeSession::read('Auth.User.id');
        }
        $conditions = array(
            'id' => $user_id
        );
        if($this->User->hasAny($conditions)) {
        	$this->unbindModel(array(
        		'belongsTo' => array('FollowingUser'),
        		'hasOne' => array('Activity')
        		));
            $followingList = $this->find('all', array('conditions'=>array('Following.user_id'=>$user_id)));
            return $followingList;
        } else {
            throw new NotFoundException(__('User not found'));
        }
        
    }
}
