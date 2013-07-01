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
		'User',
		'Photo' => array(
			// 'foreignKey' => 'upload_id'
			)
	);

	public $hasOne = array(
        'Activity' => array(
            'dependent' => true,
        )
    );

    public function afterSave($created) {
        if($created) {
            $this->Activity = new Activity;
            $lastInsertData = $this->findById($this->getLastInsertId());
            // pr($lastInsertData); die;

            $data = array(
                    'id' => null,
                    'user_id' => $lastInsertData['Favorite']['user_id'],
                    'activity_type_id' => $this->Activity->getActivityTypeId($this->useTable),
                    'favorite_id' => $lastInsertData['Favorite']['id'],
                    'object_id' => $lastInsertData['Favorite']['photo_id'],
                    'timestamp' => $lastInsertData['Favorite']['timestamp']
                );

            $this->Activity->logActivity($data);
        }
    }
}
