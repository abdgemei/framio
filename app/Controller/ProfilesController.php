<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
App::uses('CakeEmail', 'Network/Email');
App::uses('User', 'Model');
App::uses('Invitation', 'Model');
/**
 * Profiles Controller
 *
 * @property Profile $Profile
 */
class ProfilesController extends AppController {
    
    public $helpers = array('Time', 'Following', 'Favorite', 'Photo', 'Comment', 'PhpThumb.PhpThumb');
    public $layout = 'profile';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('signup', 'view');
    }
    
    public function view($username = null) {
        $row = $this->Profile->findByUsername($username);
        $id = $row['Profile']['id'];
        //pr($id); die;
        if (!$this->Profile->exists($id)) {
            throw new NotFoundException(__('Invalid profile'));
        }
        $profileOptions = array('conditions' => array('Profile.username' => $username));
        $photoOptions = array('conditions' => array('Upload.user_id' => $row['Profile']['user_id'], 'is_visible' => true));
        //$this->Profile->User->Upload->find('all');
        //pr($this->Profile->User->ProfilePictures->find());
        $this->set('profile_pictures', $this->Profile->User->ProfilePictures->find('first'));
        // pr($this->Profile->User->Upload->find('all', $photoOptions)); die;
        $this->set('uploads', $this->Profile->User->Upload->find('all', $photoOptions));
        $this->set('profile', $this->Profile->find('first', $profileOptions));
        $this->set('title_for_layout', $row['Profile']['first_name']);
    }

    // TODO move email links to view

    public function signup($verificationCode = null) {
        if ($this->Session->check('Auth.User')) {
            $this->redirect('/');
        }
        $conditions = array(
            'verification_code' => $verificationCode
        );
        $this->Invitation = new Invitation;
        $invitation = $this->Invitation->findByVerificationCode($verificationCode);
        if(is_null($verificationCode)) {
            throw new InternalErrorException(__('No invitation code'));
        } 
        if(!$this->Invitation->hasAny($conditions)) {
            throw new InternalErrorException(__('Invalid invitation code'));
        }
        if($this->Invitation->isRegistered($verificationCode)) {
            throw new InternalErrorException(__('Already used'));
        }
        
        if ($this->request->is('post')) {
            $this->User = new User;
            $this->User->create();
            $this->Profile->create();
            $this->Invitation->id = $invitation['Invitation']['id'];
            $parts = explode("@", $this->request->data['User']['email']);
            $username = $parts[0];
            $this->request->data['Profile']['username'] = $username;
            $this->request->data['User']['group'] = 3;
            if ($this->User->save($this->request->data) && $this->Invitation->delete()) {
                $this->request->data['Profile']['user_id'] = $this->User->getLastInsertID();
                if($this->Profile->save($this->request->data)) {
                    $this->Email = new CakeEmail('smtp');
                    $this->Email->to($this->request->data['User']['email'])
                                ->from(array('info@framio.dev' => 'Framio'))
                                ->subject('Welcome to Framio!');
                    $message = 'You have joined Framio! Log in here '.FULL_BASE_URL.'/users/login';
                    if($this->Email->send($message)) {
                        $this->Session->setFlash(__('Welcome to Framio!'));
                        $this->redirect('/');
                    } else {
                        $this->Session->setFlash(__('Something went wrong. Please, try again.'));
                    }
                } else {
                    $this->Session->setFlash(__('The profile cannot be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The profile cannot be saved. Please, try again.'));
            }
        }
    }

}
