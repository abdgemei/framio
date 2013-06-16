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
    public $hasOne = array(
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => '',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    
    public $hasMany = array(
        'ProfilePictures' => array(
            'className' => 'ProfilePicture',
            'foreignKey' => '',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )    
    );
    
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );
    
    public function getMetadata($id) {
        if($this->hasAny(array('id' => $id))) {
            
            $row = $this->findById(array('id' => $id));
            $metadata = exif_read_data(FULL_BASE_URL.'/content/'.$id);
            $metadata = array(
                'FileName'          => $row['Upload']['filename'],
                'FileSize'          => $metadata['FileSize'],
                'MimeType'          => $metadata['MimeType'],
                'Width'             => $metadata['COMPUTED']['Width'],
                'Height'            => $metadata['COMPUTED']['Height'],
                'ApertureFNumber'   => $metadata['COMPUTED']['ApertureFNumber'],
                'Make'              => $metadata['Make'],
                'Model'             => $metadata['Model'],
                'Orientation'       => $metadata['Orientation'],
                'DateTime'          => $metadata['DateTime'],
                'ExposureTime'      => $metadata['ExposureTime'],
                'FNumber'           => $metadata['FNumber'],
                'ISOSpeedRatings'   => $metadata['ISOSpeedRatings'],
                'DateTimeOriginal'  => $metadata['DateTimeOriginal'],
                'ShutterSpeedValue' => $metadata['ShutterSpeedValue'],
                'ApertureValue'     => $metadata['ApertureValue'],
                'BrightnessValue'   => $metadata['BrightnessValue'],
                'MeteringMode'      => $metadata['MeteringMode'],
                'Flash'             => $metadata['Flash'],
                'FocalLength'       => $metadata['FocalLength']
            );

            return $metadata;
        } else {
            return false;
        }        
    }
}
