<?php
App::uses('AppController', 'Controller');
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
        if(!is_null($verificationCode)) {
            if ($this->request->is('post')) {
                $this->Profile->create();
                if ($this->Profile->save($this->request->data)) {
                    $this->Session->setFlash(__('The profile has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
                }
            }
        } else {
            throw new InternalErrorException(__('Invalid code'));
        } 
    }

}
