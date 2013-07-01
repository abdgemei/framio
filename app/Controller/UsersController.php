<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('Following', 'Model');
App::uses('Invitation', 'Model');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
    
    public $helpers = array('HTML', 'Form', 'Following');

// TODO make forgot password function
// TODO password salt using user salt
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'initDB', 'logout', 'resetPassword');
    }

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
        //pr($this->User); die;
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}
    
	public function edit() {
	    //pr($this->User); die;
        $id = $this->Auth->user('id');
        $this->layout = 'dashboard';
        $profile_row = $this->User->findById($id);
        $profile_id = $profile_row['Profile']['id'];
        unset($profile_row);

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Profile']['last_update'] = date('Y-m-d H:i:s');
			if ($this->User->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
        
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

    public function changePassword() {
        $this->layout = 'dashboard';

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = CakeSession::read('Auth.User.id');
            $this->User->set('password', AuthComponent::password($this->request->data['User']['password_confirmation']));
            $this->User->set('change_password_flag', 0);
            if ($this->User->save()) {
                $this->Session->setFlash(__('Your password has been changed!'));
                $this->redirect($this->referer());
            } else {
                $this->Session->setFlash(__('Something went wrong...'));
            }
        }
    }

	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

    public function login() {
        $this->layout = 'loginScreen';
        if ($this->Session->check('Auth.User')) {
            $this->redirect($this->referer());
        }
        if ($this->request->is('post') || $this->Auth->loggedIn()) {
            if ($this->Auth->login()) {
                $user = $this->User->findById(CakeSession::read('Auth.User.id'));
                if ($user['User']['change_password_flag']) {
                    $this->Session->setFlash(__('It is important that you change your password, please <a href="'. Router::url(array('controller' => 'users', 'action' => 'changePassword'), true) .'">click here</a>.'));
                }

                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
        
    public function follow() {
        if ($this->request->is('post')) {
            $conditions = array(
                'User.id' => $this->request->data['Following']['following_user_id']
            );
            
            if (!$this->User->hasAny($conditions)) {
                throw new NotFoundException(__('User not found'));
            } else {
                $following = new Following;
    
                $conditions = array(
                    'Following.user_id' => $this->Auth->user('id'),
                    'Following.following_user_id' => $this->request->data['Following']['following_user_id']
                );
                
                if ($following->hasAny($conditions)) {
                    throw new InternalErrorException(__('Invalid operation: You are already following this user'));
                } else {
                    if ($this->request->data['Following']['following_user_id'] !== $this->Auth->user('id')) {
                        $this->request->data['Following']['user_id'] = $this->Auth->user('id');

                        // $this->DboSource = new DboSource(null, true);
                        $this->request->data['Following']['timestamp'] = time();
                        $follow = new Following;
                        
                        if($follow->save($this->request->data)) {
                            $this->autoRender = false;
                            $this->Session->setFlash(__('Done!'));
                            $this->redirect($this->referer());
                        } else {
                            throw new InternalErrorException(__('Invalid operation: Cannot save'));
                        }
                    } else {
                        throw new InternalErrorException(__('Invalid operation: Cannot follow self'));
                    }
                }
            }
        }
    }

    public function unfollow() {
        if ($this->request->is('post')) {
            $conditions = array(
                'User.id' => $this->request->data['Following']['following_user_id']
            );
            
            if (!$this->User->hasAny($conditions)) {
                throw new NotFoundException(__('User not found'));
            } else {
                $following = new Following;
    
                $conditions = array(
                    'Following.user_id' => $this->Auth->user('id'),
                    'Following.following_user_id' => $this->request->data['Following']['following_user_id']
                );
                
                if (!$following->hasAny($conditions)) {
                    throw new InternalErrorException(__('Invalid operation: You are not following this user'));
                } else {
                    if ($this->request->data['Following']['following_user_id'] !== $this->Auth->user('id')) {
                        $this->request->data['Following']['user_id'] = $this->Auth->user('id');
                        $following = new Following;
                        
                        $conditions = array(
                            'Following.user_id' => $this->Auth->user('id'),
                            'Following.following_user_id' =>  $this->request->data['Following']['following_user_id']
                        );

                        
                        if($following->deleteAll($conditions, true)) {
                            $this->autoRender = false;
                            $this->Session->setFlash(__('Done!'));
                            $this->redirect($this->referer());
                        } else {
                            throw new InternalErrorException(__('Invalid operation: Cannot delete'));
                        }
                    } else {
                        throw new InternalErrorException(__('Invalid operation: Cannot unfollow self'));
                    }
                }
            }
        }
        
    }
    
    public function resetPassword() {
        $this->layout = 'homepage';
        if ($this->request->is('post')) {
            $user = $this->User->findByEmail($this->request->data['User']['email']);
            // pr($this->request->data); die;
            $this->User->id = $user['User']['id'];
            $conditions = array(
                'User.email' => $this->request->data['User']['email']
            );
            if (!$this->User->hasAny($conditions)) {
                throw new NotFoundException(__('User not found'));
            }

            $newPass = rand(100000, 999999);

            if ($this->User->saveField('password', $newPass) && $this->User->saveField('change_password_flag', '1')) {
                $this->Email = new CakeEmail('smtp');
                $this->Email->from('info@framio.net', 'Framio');
                $this->Email->subject('Password Reset Information');
                $this->Email->to($this->request->data['User']['email']);
                $message = "Your new password is ".$newPass.".";
                if ($this->Email->send($message)) {
                    $this->Session->setFlash(__('Your password has been set, please check your inbox'));
                    $this->redirect($this->referer());
                } else {
                    throw new InternalErrorException(__('Error'));
                }
            } else {
                throw new InternalErrorException(__('Password not saved'));
            }
        }
    }

    public function initDB() {
        $group = $this->User->Group;
        
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');
        
        $group->id = 2;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Users/index');
        $this->Acl->allow($group, 'controllers/Users/edit');
        $this->Acl->allow($group, 'controllers/Users/view');
        $this->Acl->allow($group, 'controllers/Users/changePassword');
        $this->Acl->allow($group, 'controllers/Users/follow');
        $this->Acl->allow($group, 'controllers/Users/unfollow');
        $this->Acl->allow($group, 'controllers/Uploads/index');
        $this->Acl->allow($group, 'controllers/Uploads/add');
        $this->Acl->allow($group, 'controllers/Uploads/edit');
        $this->Acl->allow($group, 'controllers/Uploads/view');
        $this->Acl->allow($group, 'controllers/Uploads/download');
        $this->Acl->allow($group, 'controllers/Uploads/delete');
        $this->Acl->allow($group, 'controllers/Uploads/addProfilePicture');
        $this->Acl->allow($group, 'controllers/Uploads/favorite');
        $this->Acl->allow($group, 'controllers/Uploads/unfavorite');
        $this->Acl->allow($group, 'controllers/Albums/add');
        $this->Acl->allow($group, 'controllers/Albums/edit');
        $this->Acl->allow($group, 'controllers/Albums/delete');
        $this->Acl->allow($group, 'controllers/Photos/index');
        $this->Acl->allow($group, 'controllers/Photos/view');
        $this->Acl->allow($group, 'controllers/Invitations/index');
        $this->Acl->allow($group, 'controllers/Invitations/approve');
        $this->Acl->allow($group, 'controllers/Invitations/apply');
        $this->Acl->allow($group, 'controllers/Profiles/view');
        $this->Acl->allow($group, 'controllers/Activities/index');
        
        $group->id = 3;
        $this->Acl->deny($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Users/view');
        $this->Acl->allow($group, 'controllers/Users/edit');
        $this->Acl->allow($group, 'controllers/Users/changePassword');
        $this->Acl->allow($group, 'controllers/Users/follow');
        $this->Acl->allow($group, 'controllers/Users/unfollow');
        $this->Acl->allow($group, 'controllers/Uploads/index');
        $this->Acl->allow($group, 'controllers/Uploads/add');
        $this->Acl->allow($group, 'controllers/Uploads/view');
        $this->Acl->allow($group, 'controllers/Uploads/download');
        $this->Acl->allow($group, 'controllers/Uploads/delete');
        $this->Acl->allow($group, 'controllers/Uploads/addProfilePicture');
        $this->Acl->allow($group, 'controllers/Uploads/favorite');
        $this->Acl->allow($group, 'controllers/Uploads/unfavorite');
        $this->Acl->allow($group, 'controllers/Albums/add');
        $this->Acl->allow($group, 'controllers/Albums/edit');
        $this->Acl->allow($group, 'controllers/Albums/delete');
        $this->Acl->allow($group, 'controllers/Photos/index');
        $this->Acl->allow($group, 'controllers/Photos/view');
        $this->Acl->allow($group, 'controllers/Invitations/apply');
        $this->Acl->allow($group, 'controllers/Profiles/view');
        $this->Acl->allow($group, 'controllers/Activities/index');
                                
        echo "all done!";
        exit;
    }
    
}
