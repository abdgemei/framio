<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('AppHelper', 'View/Helper');
App::uses('Following', 'Model');
App::uses('User', 'Model');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
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
            //pr($followers); die;
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
            //pr($followers); die;
            $followingCount = sizeOf($following);
            return $followingCount;
        } else {
            throw new NotFoundException(__('User not found'));
        }
        
    }
}
