<?php
App::uses('ProfilePicture', 'Model');

/**
 * ProfilePicture Test Case
 *
 */
class ProfilePictureTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.profile_picture',
		'app.user',
		'app.group',
		'app.profile',
		'app.upload'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProfilePicture = ClassRegistry::init('ProfilePicture');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProfilePicture);

		parent::tearDown();
	}

}
