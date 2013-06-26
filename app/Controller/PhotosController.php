<?php
App::uses('AppController', 'Controller');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 */
class PhotosController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'profile';
    }

/**
 * index method
 *
 * @return void
 * TODO: list own photos
 */
    public function index() {
        $this->Photo->recursive = 0;
        $this->set('photos', $this->paginate('Photo', array('user_id' => $this->Auth->user('id')) ));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Photo->exists($id)) {
            throw new NotFoundException(__('Invalid photo'));
        }
        $options = array('conditions' => array('Photo.' . $this->Photo->primaryKey => $id));
        $this->set('photo', $this->Photo->find('first', $options));
    }

}