<?php

App::uses('AppHelper', 'View/Helper');
App::uses('User', 'Model');

class UserHelper extends AppHelper {
  
    public function loggedInAs() {
        //pr($this->Session); die;
    }
}
