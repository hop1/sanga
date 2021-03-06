<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = [
		'id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
		'name' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'password' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'realname' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'email' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'phone' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
		'active' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null],
		'role' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '0: nincs joga
1: user (linkup jogok a linkups_users táblában
9: CRM admin
10: admin', 'precision' => null, 'autoIncrement' => null],
		'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
		'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
		'_constraints' => [
			'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
		],
		'_options' => [
'engine' => 'InnoDB', 'collation' => 'utf8_hungarian_ci'
		],
	];

/**
 * Records
 *
 * @var array
 */
	public $records = [
		[
			'id' => 1,
			'name' => 'admin',
			'password' => 'Lorem ipsum dolor sit amet',
			'realname' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit amet',
			'active' => 1,
			'role' => 10,
			'created' => '2014-11-29 10:59:47',
			'modified' => '2014-11-29 10:59:47'
		],
		[
			'id' => 2,
			'name' => 'user2',
			'password' => 'secretpass',
			'realname' => 'user2 real name',
			'email' => 'user2@sehol.se',
			'phone' => '+36123456789',
			'active' => 1,
			'role' => 1,
			'created' => '2014-11-29 10:59:47',
			'modified' => '2014-11-29 10:59:47'
		],
		[
			'id' => 3,
			'name' => 'user3',
			'password' => 'secretpass',
			'realname' => 'user3 real name',
			'email' => 'user3@sehol.se',
			'phone' => '',
			'active' => 1,
			'role' => 1,
			'created' => '2014-11-29 10:59:47',
			'modified' => '2014-11-29 10:59:47'
		],
		[
			'id' => 4,
			'name' => 'CRMAdmin',
			'password' => 'secretpass',
			'realname' => 'CRM Admin',
			'email' => 'user4@sehol.se',
			'phone' => '',
			'active' => 1,
			'role' => 9,
			'created' => '2014-11-29 10:59:47',
			'modified' => '2014-11-29 10:59:47'
		]
	];

}
