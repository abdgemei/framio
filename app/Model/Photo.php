<?php
App::uses('AppModel', 'Model');
/**
 * Photo Model
 *
 * @property PhotoMetaDatum $PhotoMetaDatum
 * @property Upload $Upload
 * @property Album $Album
 */
class Photo extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'photo';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'PhotoMetaDatum' => array(
            'dependent' => true,

        )
	);
	
	public $hasAndBelongsToMany = array(
	    'Album' => array(
	        'className' => 'Album',
	        'joinTable' => 'album_photos',
	        'associationForeignKey' => 'album_id'
	    )
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Upload'
	);
}
