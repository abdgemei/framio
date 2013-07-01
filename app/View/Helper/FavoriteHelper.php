<?php

App::uses('AppHelper', 'View/Helper');
App::uses('Upload', 'Model');
App::uses('Photo', 'Model');
App::uses('User', 'Model');
App::uses('Favorite', 'Model');

class FavoriteHelper extends AppHelper {

    public $helpers = array('Session');
    
    public function isFavorited($upload_id) {
        //pr($upload_id); die;
        $favorite = new Favorite;
        $conditions = array(
            'Favorite.user_id' => $this->Session->read('Auth.User.id'),
            'Favorite.photo_id' => $upload_id
        );
        if ($favorite->hasAny($conditions)) {
            //pr("YAY"); die;
            return true;
        } else {
            //pr("NAY"); die;
            return false;
        }
    }
    
    public function favoriteCount($upload_id) {
        $upload = new Upload;
        $favorite = new Favorite;
        $conditions = array(
            'Upload.id' => $upload_id
        );
        if($upload->hasAny($conditions)) {
            $favorite->unbindModel(array(
                'hasOne' => array('Activity')
                ));
            $favoriteCount = $favorite->find('count', array('conditions' => array('Favorite.photo_id' => $upload_id)));
            // pr($favoriteCount); die;
            return $favoriteCount;
        } else {
            throw new NotFoundException(__('Upload not found'));
        }
    }

}
