<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
App::uses('Photo', 'Model');
App::uses('Album', 'Model');
App::uses('Comment', 'Model');
App::uses('Favorite', 'Model');
App::uses('PhotoMetadatum', 'Model');
App::uses('ProfilePicture', 'Model');
/**
 * Uploads Controller
 *
 * @property Upload $Upload
 */
class UploadsController extends AppController {

    public $helpers = array('Html', 'Time', 'PhpThumb.PhpThumb', 'Following');
    public $components = array('Rand');
   // public $layout = 'dashboard';

// TODO favorite uploads

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
        $this->layout = 'dashboard';
    }

/**
 * index method
 *
 * @return void
 */

    public function index() {
        $this->Upload->recursive = 2;
        $this->Upload->unbindModel(array('belongsTo' => array('User')));
        $this->Upload->unbindModel(array('hasOne' => array('ProfilePicture')));
        $this->Upload->unbindModel(array('hasMany' => array('Upload')));
        $this->Upload->User->unbindModel(array('hasMany' => array('Upload')));
        $this->Upload->Photo->unbindModel(array('belongsTo' => array('Upload')));
        $options['conditions'] = array('Upload.user_id' => $this->Auth->user('id'));
        // $options['order'] = 'photo.title ASC';
        //pr($this->Upload->find('all', $options)); die;
        $this->set('uploads', $this->Upload->find('all', $options));
    }

	public function favorites() {
        $this->Upload->recursive = 2;
        $this->Upload->unbindModel(array('belongsTo' => array('User')));
        $this->Upload->unbindModel(array('hasOne' => array('ProfilePicture')));
        // $this->Upload->unbindModel(array('hasOne' => array('Photo')));
        $this->Upload->User->unbindModel(array('hasMany' => array('Upload')));
        // $this->Upload->Photo->unbindModel(array('belongsTo' => array('Upload')));
        // $options['conditions'] = array('Upload.user_id' => $this->Auth->user('id'));
        $options['joins'] = array(
            array('table' => 'favorite',
                'alias' => 'Favorite',
                'type' => 'INNER',
                'conditions' => array(
                    'Favorite.photo_id = Upload.id',
                )),
            array('table' => 'photo',
                'alias' => 'VisiblePhoto',
                'type' => 'INNER',
                'conditions' => array(
                    'VisiblePhoto.upload_id = Upload.id',
                    'VisiblePhoto.is_visible = 1',
                ),
            )
            );
        // pr($this->Upload->find('all', $options)); die;
        // $options['order'] = 'photo.title ASC';
        // pr($this->Upload->find('all', $options)); die;
		$this->set('uploads', $this->Upload->find('all', $options));
	}

    public function addToAlbum($photo_data, $album_id) {
        if(is_array($photo_data)) {
            foreach ($photo_data as $photo) {
                $this->Photo = new Photo;
                if($this->Photo->attachToAlbum($photo, $album_id)) {

                } else {
                    // single photo-album attachment fails
                }
            }
        } else {
            $this->Photo = new Photo;
            $this->Photo->attachToAlbum($photo_data, $album_id);
        }
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        $this->layout = 'photo';
		if (!$this->Upload->exists($id)) {
			throw new NotFoundException(__('Invalid upload'));
		}

        // pr($id); die;
        $this->Upload->recursive = 2;
        $this->Upload->unbindModel(array(
            'belongsTo' => array('User'),
            'hasOne' => array('Activity')
            ));


		$options['conditions'] = array('Upload.' . $this->Upload->primaryKey => $id);

        $data = $this->Upload->find('first', $options);
        // pr($data['Upload']['user_id']); die;

        if(CakeSession::read('Auth.User.id') !== $data['Upload']['user_id']) {
            if(!$data['Photo']['is_visible']) {
                throw new NotFoundException(__('Invalid upload'));
            }
        }

        
        $this->Comment = new Comment;
        $commentOptions['conditions'] = array(
            'Comment.upload_id' => $id
            );
        $commentOptions['order'] = 'Comment.timestamp DESC';
        $this->Comment->unbindModel(array(
            'belongsTo' => array('Upload'),
            'hasOne' => array('Activity')
            ));
        $this->Comment->User->unbindModel(array(
            'belongsTo' => array('Group'),
            'hasMany' => array('Upload'),
            ));
        $this->Comment->recursive = 2;
        // debug($this->Comment->find('all', $commentOptions));

        $this->set('upload', $this->Upload->find('first', $options));
		$this->set('comments', $this->Comment->find('all', $commentOptions));
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
                // 'OR' => array(
                //     'Upload.user_id' => $this->Auth->user('id'),
                // ),
            )
        ));
        //pr($upload); die;
        if(CakeSession::read('Auth.User.id') !== $upload['Upload']['user_id']) {
            if(!$upload['Photo']['is_downloadable']) {
                throw new NotFoundException(__('Invalid upload'));
            }
        }

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

			foreach($this->request->data['Upload']['files'] as $this->request->data['Upload']['file']) {
				$this->Upload->create();
    			if ($this->uploadFile() && $this->Upload->saveAssociated($this->request->data)) {
    			    $this->PhotoMetadatum->create();
    			    $this->request->data['PhotoMetadatum'] = $this->Upload->getMetadata($this->Upload->getLastInsertID());
                    $this->request->data['PhotoMetadatum'] = array('photo_id' => $this->Photo->getLastInsertID()) + $this->request->data['PhotoMetadatum'];
                    if($this->PhotoMetadatum->save($this->request->data)) {
                	    $this->Session->setFlash(__('The upload has been saved'));
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
        // $this->view = 'add';
        $this->ProfilePicture = new ProfilePicture;
        if ($this->request->is('post')) {
            $data['user_id'] = $this->Auth->user('id');
            $data['upload_id'] = $this->Upload->getLastInsertID();
            $this->ProfilePicture->create();
            if($this->ProfilePicture->save($data)) {
                $this->Session->setFlash(__('The profile picture has been saved'));
                $this->redirect(array('action' => 'index'));
            }
        }
        $users = $this->ProfilePicture->find('all');
        $this->set(compact('users'));
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

        $upload = $this->Upload->findById($id);

        // pr($upload['Upload']['user_id']); die;
        if(CakeSession::read('Auth.User.id') !== $upload['Upload']['user_id']) {
            throw new NotFoundException(__('Invalid upload'));
        }

		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Upload->saveAll($this->request->data)) {
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

    public function unfavorite() {
        if ($this->request->is('post')) {
            $conditions = array(
                'Upload.id' => $this->request->data['Favorite']['photo_id']
                );
            if (!$this->Upload->hasAny($conditions)) {
                throw new NotFoundException(__('Upload not found'));
            }

            $this->Favorite = new Favorite;
            $conditions = array(
                'Favorite.user_id' => CakeSession::read('Auth.User.id'),
                'Favorite.photo_id' => $this->request->data['Favorite']['photo_id']
                );

            if (!$this->Favorite->hasAny($conditions)) {
                throw new InternalErrorException(__('Invalid operation: You do not favorite this photo.'));
            }

            $conditions = array(
                'Favorite.user_id' => CakeSession::read('Auth.User.id'),
                'Favorite.photo_id' => $this->request->data['Favorite']['photo_id']
                );
            if($this->Favorite->deleteAll($conditions, true)) {
                $this->autoRender = false;
                $this->Session->setFlash(__('Done!'));
                $this->redirect($this->referer());
            } else {
                throw new InternalErrorException(__('Invalid operation: Cannot save'));
            }
        }
    }

    public function favorite() {
        //pr($this->request->data); die;
        if ($this->request->is('post')) {
            $conditions = array(
                'Upload.id' => $this->request->data['Favorite']['photo_id']
                );
            if (!$this->Upload->hasAny($conditions)) {
                throw new NotFoundException(__('Upload not found'));
            }

            $this->Favorite = new Favorite;
            $conditions = array(
                'Favorite.user_id' => CakeSession::read('Auth.User.id'),
                'Favorite.photo_id' => $this->request->data['Favorite']['photo_id']
                );

            if ($this->Favorite->hasAny($conditions)) {
                throw new InternalErrorException(__('Invalid operation: You have already favorited this photo'));
            }

            $this->request->data['Favorite']['user_id'] = CakeSession::read('Auth.User.id');
            $this->request->data['Favorite']['timestamp'] = time();

            if($this->Favorite->save($this->request->data)) {
                $this->autoRender = false;
                $this->Session->setFlash(__('Done!'));
                $this->redirect($this->referer());
            } else {
                throw new InternalErrorException(__('Invalid operation: Cannot save'));
            }
        }
    }

}
