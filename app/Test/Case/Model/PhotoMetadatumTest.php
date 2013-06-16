<?php
App::uses('PhotoMetadatum', 'Model');

/**
 * PhotoMetadatum Test Case
 *
 */
class PhotoMetadatumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.photo_metadatum',
		'app.photo',
		'app.upload',
		'app.user',
		'app.group',
		'app.profile',
		'app.profile_picture',
		'app.album'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PhotoMetadatum = ClassRegistry::init('PhotoMetadatum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PhotoMetadatum);

		parent::tearDown();
	}

}
