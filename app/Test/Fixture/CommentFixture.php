<?php
/**
 * CommentFixture
 *
 */
class CommentFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'comment';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'upload_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'parent_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'text' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 5000, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_spam' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
		'timestamp' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 15, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'timestamp' => array('column' => 'timestamp', 'unique' => 0),
			'is_spam' => array('column' => 'is_spam', 'unique' => 0)
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
			'upload_id' => 'Lorem ip',
			'parent_id' => 1,
			'text' => 'Lorem ipsum dolor sit amet',
			'is_spam' => 1,
			'timestamp' => 1
		),
	);

}
