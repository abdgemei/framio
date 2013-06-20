<?php
App::uses('AppModel', 'Model');
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Photo' => array(
			'dependent' => false
		)
	);

}
