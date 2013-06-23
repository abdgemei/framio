<?php

App::uses('AppHelper', 'View/Helper');
App::uses('Following', 'Model');
App::uses('User', 'Model');

class FollowingHelper extends AppHelper {

    public $helpers = array('Session');
    
    public function isFollowing($following_user_id) {
        //pr($following_user_id); die;
        $following = new Following;
        $conditions = array(
            'Following.user_id' => $this->Session->read('Auth.User.id'),
            'Following.following_user_id' => $following_user_id
        );
        if ($following->hasAny($conditions)) {
            //pr("YAY"); die;
            return true;
        } else {
            //pr("NAY"); die;
            return false;
        }
    }
    
    public function followCount($user_id) {
        $user = new User;
        $following = new Following;
        $conditions = array(
            'id' => $user_id
        );
        if($user->hasAny($conditions)) {
            $followers = $following->find('all', array('conditions'=>array('Following.following_user_id'=>$user_id)));
            $followCount = sizeOf($followers);
            return $followCount;
        } else {
            throw new NotFoundException(__('User not found'));
        }
    }
    
    public function followingCount($user_id) {
        $user = new User;
        $following = new Following;
        $conditions = array(
            'id' => $user_id
        );
        if($user->hasAny($conditions)) {
            $following = $following->find('all', array('conditions'=>array('Following.user_id'=>$user_id)));
            $followingCount = sizeOf($following);
            return $followingCount;
        } else {
            throw new NotFoundException(__('User not found'));
        }
        
    }
}
