<?php
App::uses('AppController', 'Controller');
App::uses('Following', 'Model');

/**
 * Albums Controller
 *
 * @property Album $Album
 */
class ActivitiesController extends AppController {

	public $helpers = array('PhpThumb.PhpThumb', 'Time');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'dashboard';
        //$this->Auth->allow();
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Activity->recursive = 0;
		$this->Following = new Following;
		$this->Activity->getFeed($this->Following->getFollowingList());
		$this->set('activities', $this->Activity->getFeed($this->Following->getFollowingList()));
	}

}