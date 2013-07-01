<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
App::uses('Activity', 'Model');
class User extends AppModel {
    
    public $validate = array(
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'uniqueEmail' => array(
                'rule'=>'isUnique',
                'message' => 'This email has already been used'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ),
            'matchPasswords' => array(
                'rule' => 'matchPasswords',
                'message' => 'Your passwords do not match'
            )
        ),
        'password_confirmation' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password confirmation is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public $useTable = 'user';

    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group',
            //'dependent'  => true
        )
    );
    
    public $hasOne = array(
        'Profile',
        'Activity' => array(
            'dependent' => true,
        )
    );
    
    public $hasMany = array(
        'Upload' => array(
            'className' => 'Upload',
            'foreignKey' => '',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ProfilePictures' => array(
            'className' => 'ProfilePicture',
            'foreignKey' => '',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Album'
    );

    //public $actsAs = array('Acl' => array('type' => 'requester'));

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
    
    public function afterSave($created) {
        if($created) {
            $this->Activity = new Activity;
            $lastInsertData = $this->findById($this->getLastInsertId());

            $data = array(
                    'id' => null,
                    'user_id' => $lastInsertData['User']['id'],
                    'activity_type_id' => $this->Activity->getActivityTypeId($this->useTable),
                    'timestamp' => strtotime($lastInsertData['User']['created'])
                );

            $this->Activity->logActivity($data);
        }
    }
    public function matchPasswords($data) {
        if ($this->data['User']['password'] == $this->data['User']['password_confirmation']) {
            return true;
        }
        $this->invalidate('password_confirmation', 'Your passwords do not match');
        return false;
    }
    
    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group'])) {
            $groupId = $this->data['User']['group'];
        } else {
            $groupId = $this->field('group');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }
    
    public function bindNode($user) {
        return array('model' => 'group', 'foreign_key' => $user['User']['Group']['id']);
    }
    
    // public function isUnique($email) {
        // if(!$this->findByEmail($email)->hasAny()) {
            // return true;
        // } else {
            // return false;
        // }
    // }
}
