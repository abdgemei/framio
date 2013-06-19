<?php
App::uses('AppController', 'Controller');
App::uses('User', 'Model');
App::uses('Upload', 'Model');

class DashboardController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
        $this->User = new User;
        $this->Upload = new Upload;
    }
    
    public function index() {
        $this->User->recursive = 0;
        $this->set('User', $this->User->find());
        $this->Upload->recursive = 0;
        $this->set('Upload', $this->Upload->find());
    }
    
}
