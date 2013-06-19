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
            'dependent' => true
        )
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Upload',
		'Album' => array(
			'className' => 'Album',
			'foreignKey' => 'album_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
