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
			'className' => 'PhotoMetaDatum',
			'foreignKey' => 'photo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Upload' => array(
			'className' => 'Upload',
			'foreignKey' => 'upload_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Album' => array(
			'className' => 'Album',
			'foreignKey' => 'album_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
