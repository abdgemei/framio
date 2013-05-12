<?php
App::uses('AppController', 'Controller');
App::uses('Invitation', 'Model');
/**
 * Profiles Controller
 *
 * @property Profile $Profile
 */
class ProfilesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('signup');
    }

    public function signup($verificationCode = null) {
        $conditions = array(
            'verification_code' => $verificationCode
        );
        $invitation = new Invitation;
        if(is_null($verificationCode)) {
            throw new InternalErrorException(__('No invitation code'));
        } 
        if(!$invitation->hasAny($conditions)) {
            throw new InternalErrorException(__('Invalid invitation code'));
        }
        if($invitation->isRegistered($verificationCode)) {
            throw new InternalErrorException(__('Already used'));
        }
        
        if ($this->request->is('post')) {
            $this->Profile->create();
            if ($this->Profile->save($this->request->data)) {
                $this->Session->setFlash(__('The profile has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
            }
        }
    }

}
