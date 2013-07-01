<?php
/**
 * ActivityFixture
 *
 */
class ActivityFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'activity';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'activity_type_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'source_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'object_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'timestamp' => array('type' => 'timestamp', 'null' => true, 'default' => 'CURRENT_TIMESTAMP'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'activity_type_id' => 1,
			'source_id' => 1,
			'object_id' => 1,
			'timestamp' => 1372407666
		),
	);

}
