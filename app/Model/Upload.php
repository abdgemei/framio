<?php
App::uses('AppModel', 'Model');
/**
 * Upload Model
 *
 * @property User $User
 */
class Upload extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    public $useTable = 'upload';

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'title';


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
        )
    );
    
    public function getMetadata($id) {
        if($this->hasAny(array('id' => $id))) {
            
            // pr(exif_read_data(FULL_BASE_URL.'/content/'.$id));die;
            // $metadata = exif_read_data(FULL_BASE_URL.'/content/'.$id);
            // $metadata = array(
                // 'File name' => $this->findById(array('id' => $id))['Upload']['filename'],
                // 'FileDatetime' => $metadata['FileDatetime'],
                // 'FileSize' => $metadata['FileSize'],
                // 'MimeType' => $metadata['MimeType'],
                // 'Width' => $metadata['COMPUTED']['Width'],
                // 'Height' => $metadata['COMPUTED']['Height'],
                // 'ApertureFNumber' => $metadata['COMPUTED']['ApertureFNumber'],
                // 'Make' => $metadata['Make'],
                // 'Model' => $metadata['Model'],
//                 
            // );
            //pr($metadata); die;
            return exif_read_data(FULL_BASE_URL.'/content/'.$id);
        } else {
            return false;
        }        
    }
}
