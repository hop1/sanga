<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ContactsourcesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ContactsourcesController Test Case
 */
class ContactsourcesControllerTest extends IntegrationTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.contactsources',
		'app.contacts',
		'app.zips',
		'app.countries',
		
		'app.histories',
		'app.users',
		'app.events',
		'app.notifications',
		'app.contacts_users',
		'app.groups',
		
		'app.contacts_groups',
		'app.groups_users',
		
		'app.usergroups',
		'app.users_usergroups',
		'app.units',
		'app.skills',
		'app.contacts_skills'
	];

/**
 * Test index method
 *
 * @return void
 */
	public function testIndex() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test view method
 *
 * @return void
 */
	public function testView() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test add method
 *
 * @return void
 */
	public function testAdd() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test edit method
 *
 * @return void
 */
	public function testEdit() {
		$this->markTestIncomplete('Not implemented yet.');
	}

/**
 * Test delete method
 *
 * @return void
 */
	public function testDelete() {
		$this->markTestIncomplete('Not implemented yet.');
	}

}
