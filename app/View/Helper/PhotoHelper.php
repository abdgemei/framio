<?php

App::uses('AppHelper', 'View/Helper');
App::uses('Photo', 'Model');
App::uses('User', 'Model');

class PhotoHelper extends AppHelper {

    public $helpers = array('Session');
    
    public function photoCount($user_id) {
        $user = new User;
        $photo = new Photo;
        $conditions = array(
            'id' => $user_id
        );
        if($user->hasAny($conditions)) {
            // $options['conditions'] = array('Photo.user_id' => $user_id);
            $options['joins'] = array(
                array(
                    'table' => 'upload',
                    'alias' => 'UploadedPhotos',
                    'type' => 'INNER',
                    'conditions' => array(
                        'UploadedPhotos.id = Photo.upload_id',
                        'UploadedPhotos.user_id = '. $user_id,
                        ),
                ));
            $photos = $photo->find('all', $options);
            $photoCount = sizeOf($photos);
            return $photoCount;
        } else {
            throw new NotFoundException(__('User not found'));
        }
    }
}
