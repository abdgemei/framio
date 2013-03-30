<?php

class UsersController extends AppController {
    public $helpers = array('HTML', 'Form');
    
    public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow();
    }
    
    public function index() {
        $this->User->recursive = 0;
        $this->set('usersList', $this->paginate());
    }
    
    public function isAuthorized($user) {
        return false;
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
    
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Incalid user'));
        }
        $this->set('usersList', $this->User->read(null, $id));
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('This user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('This user could not be saved. Please try again later.'));
            }
        }
    }
    
    public function edit($id = NULL) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Pkease try again later.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }
    
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('user was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}