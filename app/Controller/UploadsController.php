<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
App::uses('Photo', 'Model');
App::uses('PhotoMetadatum', 'Model');
App::uses('ProfilePicture', 'Model');
/**
 * Uploads Controller
 *
 * @property Upload $Upload
 */
class UploadsController extends AppController {

    public $helpers = array('Html');
    public $components = array('Rand');
   // public $layout = 'dashboard';

// TODO favorite uploads
// TODO upload metadata table
// TODO main picture table

/**
 * index method
 *
 * @return void
 */

	public function index() {
	    // pr($this->Auth->user('id')); die;
		$this->Upload->recursive = 0;
        $this->showOwn();
		$this->set('uploads', $this->paginate('Upload', array('Upload.user_id' => $this->Auth->user('id')) ));
	}
    
    protected function showOwn() {
        return $this->Upload->find('all', array('conditions' => array('Upload.user_id' => $this->Auth->user('id'))));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Upload->exists($id)) {
			throw new NotFoundException(__('Invalid upload'));
		}
		$options = array('conditions' => array('Upload.' . $this->Upload->primaryKey => $id));
		$this->set('upload', $this->Upload->find('first', $options));
        $this->set('uploadMetadata', $this->Upload->getMetadata($id));
	}

    public function download($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for upload', true));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->Upload->bindModel(array('belongsTo' => array('User')));
        $upload = $this->Upload->find('first', array(
            'conditions' => array(
                'Upload.id' => $id,
                'OR' => array(
                    'Upload.user_id' => $this->Auth->user('id'),
                ),
            )
        ));
        
        if (!$upload) {
            $this->Session->setFlash(__('Invalid id for upload', true));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->viewClass = 'media';
        $filename = $upload['Upload']['filename'];
        $this->set(array(
            'id' => $upload['Upload']['id'],
            //'name' => substr($filename, 0, strrpos($filename, '.')),
            'name' => $filename,
            'extension' => substr(strrchr($filename, '.'), 1),
            'path' => WWW_ROOT.DS.'content'.DS,
            'download' => true,
        ));
    }

/**
 * add method
 *
 * @return void
 */
	public function add() {
	    $this->Photo = new Photo;
        $this->PhotoMetadatum = new PhotoMetadatum;
		if ($this->request->is('post')) {
		    //pr($this->request->data); die;

			foreach($this->request->data['Upload']['files'] as $this->request->data['Upload']['file']) {
				$this->Upload->create();
    			if ($this->uploadFile() && $this->Upload->saveAssociated($this->request->data)) {
    			    $this->PhotoMetadatum->create();
    			    $this->request->data['PhotoMetadatum'] = $this->Upload->getMetadata($this->Upload->getLastInsertID());
                    $this->request->data['PhotoMetadatum'] = array('photo_id' => $this->Photo->getLastInsertID()) + $this->request->data['PhotoMetadatum'];
                    if($this->PhotoMetadatum->save($this->request->data)) {
                	    $this->Session->setFlash(__('The upload has been saved'));
        			    //$this->redirect(array('action' => 'index'));
                    }
    			} else {
    			    throw new InternalErrorException(__('The upload could not be saved. Please, try again.'));
    				//$this->Session->setFlash(__('The upload could not be saved. Please, try again.'));
    			}
			}
    	    $this->Session->setFlash(__('The upload has been saved'));
			$this->redirect(array('action' => 'index'));
		}
		$users = $this->Upload->User->find('list');
		$this->set(compact('users'));
	}
    
    public function addProfilePicture() {
        $this->view = 'add';
        $this->ProfilePicture = new ProfilePicture;
        if ($this->request->is('post')) {
            $this->Upload->create();
            if ($this->uploadFile() && $this->Upload->save($this->request->data)) {
                $data['user_id'] = $this->Auth->user('id');
                $data['upload_id'] = $this->Upload->getLastInsertID();
                $this->ProfilePicture->create();
                if($this->ProfilePicture->save($data)) {
                    $this->Session->setFlash(__('The profile picture has been saved'));
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('The upload could not be saved. Please, try again.'));
            }
        }
        $users = $this->Upload->User->find('list');
        $this->set(compact('users'));
    }
    
    public function attachPhotoToAlbum() {
        
    }

// TODO validate by filetype
    protected function uploadFile() {
        $file = $this->data['Upload']['file'];
        //pr(ROOT.DS.'content'.DS.$file['name']); die;
        //pr(String::uuid()); die;
        if($file['error'] === UPLOAD_ERR_OK) {
            $id = $this->Rand->generateRandomString();
            if(move_uploaded_file($file['tmp_name'], WWW_ROOT.DS.'content'.DS.$id)) {
                $this->request->data['Upload']['id'] = $id;
                $this->request->data['Upload']['user_id'] = $this->Auth->user('id');
                $this->request->data['Upload']['filename'] = $file['name'];
                $this->request->data['Upload']['filesize'] = $file['size'];
                $this->request->data['Upload']['filemime'] = $file['type'];
                return true; 
            }
        }
        return false;
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Upload->exists($id)) {
			throw new NotFoundException(__('Invalid upload'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Upload->save($this->request->data)) {
				$this->Session->setFlash(__('The upload has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The upload could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Upload.' . $this->Upload->primaryKey => $id));
			$this->request->data = $this->Upload->find('first', $options);
		}
		$users = $this->Upload->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Upload->id = $id;
		$this->File = new File(WWW_ROOT.DS.'content'.DS.$id, false, 0777);
		if (!$this->Upload->exists() && !$this->File->exists()) {
			throw new NotFoundException(__('Invalid upload'));
		}
        
		$this->request->onlyAllow('post', 'delete');
		if ($this->Upload->deleteAll(array('Upload.id' => $id), true) && $this->File->delete()) {
			$this->Session->setFlash(__('Upload deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Upload was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
