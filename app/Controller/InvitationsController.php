<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Invitations Controller
 *
 * @property Invitation $Invitation
 */
class InvitationsController extends AppController {

    public $components = array('Rand');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'homepage';
        $this->Auth->allow('apply');
    }

	public function index() {
		$this->Invitation->recursive = 0;
		$this->set('invitations', $this->paginate());
	}

   public function apply() {
        $this->layout = 'loginScreen';
        if ($this->Session->check('Auth.User')) {
            $this->redirect('/');
        }
        if ($this->request->is('post')) {
            $this->Invitation->create();
            if ($this->Invitation->save($this->request->data)) {
                $this->Session->setFlash(__('The invitation has been saved'));
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('The invitation could not be saved. Please, try again.'));
            }
        }
    }
 
// TODO move email links to view

 	public function approve($id = null) {
		if (!$this->Invitation->exists($id)) {
			throw new NotFoundException(__('Invalid invitation'));
		}

        $verificationCode = $this->Rand->generateRandomString(12);
        
        $invitation = $this->Invitation->findById($id);
		$this->Email = new CakeEmail('smtp');
        $this->Email->from(array('info@framio.dev' => 'Framio'));
        $this->Email->to($invitation['Invitation']['email']);
        $this->Email->subject('Your Framio profile is ready');
        
        $message = 'Welcome to Framio! Your profile is ready for setup. Click on the following verification link to signup '.FULL_BASE_URL.'/profiles/signup/'.$verificationCode;

        $this->Invitation->id = $id;
        $this->Invitation->set('status', 'approved');
        $this->Invitation->set('verification_code', $verificationCode);

        if($this->Email->send($message) && $this->Invitation->save()) {
            $this->Session->setFlash(__('Invitation sent'));
            $this->redirect($this->referer());
        }
        
	}
}
