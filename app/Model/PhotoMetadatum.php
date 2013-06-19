<?php
App::uses('AppModel', 'Model');
/**
 * PhotoMetadatum Model
 *
 * @property Photo $Photo
 */
class PhotoMetadatum extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Photo'
	);
}
