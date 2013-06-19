<?php
App::uses('AppModel', 'Model');
/**
 * ProfilePicture Model
 *
 * @property User $User
 * @property Upload $Upload
 */
class ProfilePicture extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'profile_picture';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User',
		'Upload'
	);
}
