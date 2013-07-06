<?php

App::uses('AppHelper', 'View/Helper');
App::uses('Upload', 'Model');
App::uses('Photo', 'Model');
App::uses('User', 'Model');
App::uses('Comment', 'Model');

class CommentHelper extends AppHelper {

    public $helpers = array('Session');
    
    public function commentCount($upload_id) {
        $upload = new Upload;
        $comment = new Comment;
        $conditions = array(
            'Upload.id' => $upload_id
        );
        if($upload->hasAny($conditions)) {
            $comment->unbindModel(array(
                'hasOne' => array('Activity')
                ));
            $commentCount = $comment->find('count', array('conditions' => array('Comment.upload_id' => $upload_id)));
            // pr($favoriteCount); die;
            return $commentCount;
        } else {
            throw new NotFoundException(__('Upload not found'));
        }
    }

}
