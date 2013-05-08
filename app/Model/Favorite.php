<?php
App::uses('AppModel', 'Model');
/**
 * Favorite Model
 *
 * @property User $User
 * @property Upload $Upload
 */
class Favorite extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'favorite';


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
		),
		'Upload' => array(
			'className' => 'Upload',
			'foreignKey' => 'upload_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
