<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property User $User
 * @property Upload $Upload
 * @property Comment $ParentComment
 * @property Comment $ChildComment
 */
class Comment extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'comment';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'text';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'text' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 5000),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
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
		),
		'ParentComment' => array(
			'className' => 'Comment',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasOne = array(
        'Activity' => array(
            'dependent' => true,
        )
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildComment' => array(
			'className' => 'Comment',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

    public function afterSave($created) {
        if($created) {
            $this->Activity = new Activity;
            $lastInsertData = $this->findById($this->getLastInsertId());

            $data = array(
                    'id' => null,
                    'user_id' => $lastInsertData['Comment']['user_id'],
                    'activity_type_id' => $this->Activity->getActivityTypeId($this->useTable),
                    'comment_id' => $lastInsertData['Comment']['id'],
                    'object_id' => $lastInsertData['Upload']['id'],
                    'timestamp' => $lastInsertData['Comment']['timestamp']
                );

            $this->Activity->logActivity($data);
        }
    }

}
