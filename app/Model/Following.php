<?php
App::uses('AppModel', 'Model');
/**
 * Following Model
 *
 * @property User $User
 * @property FollowingUser $FollowingUser
 */
class Following extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'following';


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
		'FollowingUser' => array(
			'className' => 'FollowingUser',
			'foreignKey' => 'following_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
