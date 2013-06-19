<?php
App::uses('AppModel', 'Model');
/**
 * Profile Model
 *
 * @property User $User
 * @property Upload $Uploads
 */
class Profile extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'profile';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		// 'name' => array(
			// 'notempty' => array(
				// 'rule' => array('notempty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
		'birthday' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User'
        // 'Profile Picture' => array(
            // 'className' => 'Upload',
            // 'foreignKey' => 'prof_picture_id',
            // 'conditions' => '',
            // 'fields' => '',
            // 'order' => ''
        // )
    );
}
