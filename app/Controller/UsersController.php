<?php
App::uses('AppController', 'Controller');
App::uses('Following', 'Model');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
    
    public $helpers = array('HTML', 'Form', 'Following');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'login', 'initDB', 'logout', 'follow', 'unfollow');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
	    //pr($this->User); die;
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
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
        if ($this->request->is('post') || $this->Auth->loggedIn()) {
            if ($this->Auth->login()) {
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
                            'following_user_id' => $this->request->data['Following']['following_user_id']
                        );

                        
                        if($following->deleteAll($conditions, false)) {
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
    
// TODO do aco_sync too..
// TODO uploads ACL entries for all user groups
// TODO follow action ACL entries
// TODO unfollow action ACL entries
// TODO some shit

    public function initDB() {
        $group = $this->User->Group;
        
        $group->id = 1;
        //$this->Acl->allow($group, 'controllers');
        
        $group->id = 2;
        //$this->Acl->deny($group, 'controllers');
        //$this->Acl->allow($group, 'controllers/Users/add');
        //$this->Acl->allow($group, 'controllers/Users/edit');
        
        $group->id = 3;
        //$this->Acl->deny($group, 'controllers');
        
        echo "all done!";
        exit;
    }
    
}
