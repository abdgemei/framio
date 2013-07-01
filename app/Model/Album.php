<?php
App::uses('AppModel', 'Model');
App::uses('Photo', 'Model');
//App::uses('AuthComponent', 'Controller/Component');
/**
 * Album Model
 *
 * @property Photo $Photo
 */
class Album extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'album';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	public $belongsTo = array(
	    'User'
	);

/**
 * hasMany associations
 *
 * @var array
 */
 
	public $hasAndBelongsToMany = array(
		'Photo' => array(
		    'className' => 'Photo',
		    'joinTable' => 'album_photos',
		    'associationForeignKey' => 'photo_id',
			//'dependent' => false
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
			//pr($lastInsertData['Album']['user_id']); die;
			$data = array(
	                'id' => null,
	                'user_id' => $lastInsertData['Album']['user_id'],
	                'activity_type_id' => $this->Activity->getActivityTypeId($this->useTable),
	                'album_id' => $lastInsertData['Album']['id'],
	                'timestamp' => strtotime($lastInsertData['Album']['created'])
	            );

			$this->Activity->logActivity($data);
		}
	}
}
