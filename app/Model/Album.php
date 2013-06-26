<?php
App::uses('AppModel', 'Model');
App::uses('Photo', 'Model');
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
	
}
