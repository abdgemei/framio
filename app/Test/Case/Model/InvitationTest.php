<?php
App::uses('Invitation', 'Model');

/**
 * Invitation Test Case
 *
 */
class InvitationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.invitation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Invitation = ClassRegistry::init('Invitation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Invitation);

		parent::tearDown();
	}

}
