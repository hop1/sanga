<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\String;

/**
 * Contacts Controller
 *
 * @property App\Model\Table\ContactsTable $Contacts
 */
class ContactsController extends AppController {
	
	public $helpers = ['Number'];
		
	public function isAuthorized($user = null) {
        return true;
    }

	//ajax keresések a név mezőkben
	public function quicksearch(){
		$contact = $this->Contacts->newEntity($this->request->data);
		$query = $this->Contacts->find()
				->select(['id', 'name', 'contactname', 'email', 'phone'])
				->where(['name LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['contactname LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['email LIKE "%'.$this->request->query('term').'%"'])
				->orWhere(['phone LIKE "%'.$this->request->query('term').'%"']);
		//debug($query);
		foreach($query as $row){
			$label = $this->createHighlight($row->name) .
					$this->createHighlight($row->contactname) .
					$this->createHighlight($row->email) .
					$this->createHighlight($row->phone);
			$result[] = array('value' => $row->id,
							  'label' => $label);
		}
		//debug($result);die();
		$this->set('result', $result);
		$this->set('contact', $contact);
	}

	private function createHighlight($value = null){
		if($value && strpos(strtolower($value), $this->request->query('term')) !== false){
			$highlight = array('format' => '<span class="b i">\1</span>');
			return String::highlight($value, $this->request->query('term'), $highlight) . ' ';
		}
	}

	//cím adatok lekérdezése a mapon való megjelenéshez
	public function showmap(){
		$result = $this->Contacts->find()
				->contain(['Zips'])
				->select(['Contacts.lat', 'Contacts.lng', 'Zips.zip', 'Zips.name'])
				->where('Contacts.lat != 0')
				->toArray();
		//debug($result);
		$this->set('result', $result);
	}
	
	//mindenféle lekérdezések
	public function search(){
		
		if($this->request->data){
			/*
			 debug($this->request->data);
			[
				'_zip_id' => '200',
				'zip_id' => '162',
				'area' => '15',
				'_group_id' => 'Seva-puja',
				'group_id' => '3'
			]
			*/
			
			$center = $this->Contacts->Zips->find()
					->select(['lat', 'lng'])
					->where(['id' => $this->request->data['zip_id']])
					;
			$cent = $center->toArray();
			
			$expr = $center->newExpr()->add('(3956 *2 * ASIN( SQRT( POWER( SIN( ( '.$cent[0]->lat.
											' - abs( Contacts.lat ) ) * pi( ) /180 /2 ) , 2 ) + COS( '.$cent[0]->lat.
											' * pi( ) /180 ) * COS( abs( Contacts.lat ) * pi( ) /180 ) * POWER( SIN( ( '.
											$cent[0]->lng.' - Contacts.lng ) * pi( ) /180 /2 ) , 2 ) ) ))');
			
			$result = $this->Contacts->find()
					->contain(['Zips', 'Groups'])
					->select(['Contacts.name', 'Zips.zip', 'Zips.name', 'distance' => $expr])
					->where(['active' => true/*,
							 'distance' => $expr*/])
					->matching('Groups', function($q){
						return $q->where(['Groups.id' => $this->request->data['group_id']]);
						})
					->having(['distance <=' => $this->request->data['area']])
					->order(['distance' => 'ASC']);
			$this->set('result', $result);
		}
	}

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$_myGroups = $this->Contacts->Groups->find('accessible', ['User.id' => $this->Auth->user('id')])->toArray();
		foreach($_myGroups as $mg){
			$groupIds[] = $mg->id;
		}

		$myContacts = $this->Contacts->find('mine', ['User.id' => $this->Auth->user('id')])
				->select(['Contacts.id']);
		$inmygroupsContacts = $this->Contacts->find('inGroups', ['groupIds' => $groupIds])
				->select(['Contacts.id']);

		$contacts = $this->Contacts->find()
								->select(['Contacts.id', 'Contacts.name', 'Contacts.contactname',
										  'Contacts.address', 'Contacts.phone',
										  'Zips.id', 'Zips.zip', 'Zips.name'])
								->contain(['Zips', 'Users', 'Groups'])
								->orWhere(['Contacts.id IN ' => $inmygroupsContacts])
								->orWhere(['Contacts.id IN ' => $myContacts]);
		$this->set('contacts', $this->paginate($contacts));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$id = $id ? $id : $this->request->data['name'];
		$contact = $this->Contacts->get($id, [
			'contain' => ['Zips', 'Contactsources', 'Groups', 'Skills', 'Users', 'Histories']
		]);
		$this->set('contact', $contact);
		
		$family = $this->Contacts->find()
				->where(['family_id' => $contact->family_id]);
		$this->set('family', $family);
		
		$this->paginate = [
			'contain' => ['Contacts', 'Users', 'Events', 'Units', 'Groups']
		];
		$histories = $this->Contacts->Histories->find()
				->where(['contact_id' => $id])
				->order(['Histories.date' => 'DESC']);
		$this->set('histories', $this->paginate($histories));

		$accessibleGroups = $this->Contacts->Groups->find('accessible', ['User.id' => $this->Auth->user('id'), 'shared' => true]);
		$this->set(compact('accessibleGroups'));
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$contact = $this->Contacts->newEntity($this->request->data);
		if($this->request->data){
			//debug($this->request->data);
			/*'skills' => [
				'_ids' => [
					(int) 0 => '1',			//found in skills, this is the id
					(int) 1 => '~könyvelő'		//starts with "~" this is a new skill (or fast typer problem)
				]]
			*/
			foreach($this->request->data['skills']['_ids'] as $i => $skill){
				if(mb_substr($skill, 0,1) == '~'){
					$skill = ltrim($skill, '~');
					$contact['skills'][] = $this->Contacts->Skills->newEntity(['name' => $skill]);
				}
			}
		}
		if ($this->request->is('post')) {
			$contact->loggedInUser = $this->Auth->user('id');
			if ($this->Contacts->save($contact)) {
				$this->Flash->success('The contact has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				debug($contact->errors());
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
		}
		$zips = $this->Contacts->Zips->find('list', ['idField' => 'id', 'valueField' => 'full_zip']);
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('accessible', ['User.id' => $this->Auth->user('id'), 'shared' => true]);
		$skills = $this->Contacts->Skills->find('list');
		$users = $this->Contacts->Users->find('list');
		$this->set(compact('contact', 'zips', 'contactsources', 'groups', 'skills', 'users'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$contact = $this->Contacts->get($id, [
			'contain' => ['Groups', 'Skills', 'Users', 'Zips']
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$contact = $this->Contacts->patchEntity($contact, $this->request->data);
			$contact->loggedInUser = $this->Auth->user('id');
			if ($this->Contacts->save($contact)) {
				$this->Flash->success('The contact has been saved.');
				return $this->redirect(['action' => 'view', $id]);
			} else {
				$this->Flash->error('The contact could not be saved. Please, try again.');
			}
		}
		$zips = $this->Contacts->Zips->find('list');
		$contactsources = $this->Contacts->Contactsources->find('list');
		$groups = $this->Contacts->Groups->find('list');
		$skills = $this->Contacts->Skills->find('list');
		$users = $this->Contacts->Users->find('list');
		$this->set(compact('contact', 'zips', 'contactsources', 'groups', 'skills', 'users'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$contact = $this->Contacts->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Contacts->delete($contact)) {
			$this->Flash->success('The contact has been deleted.');
		} else {
			$this->Flash->error('The contact could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
	
	public function checkDuplicates(){
		$this->Contacts->checkDuplicatesOnGeo();
		/*foreach($this->Contacts->checkDuplicatesOnPhone() as $q){
			debug($q->toArray());
		}*/
		//$this->Contacts->checkDuplicatesOnEmail();
		//$this->Contacts->checkDuplicatesOnBirth();
		//$this->Contacts->checkDuplicatesOnNames();
	}
	
	public function editGroup($id = null){
		if ($this->request->is('post') && $this->request->is('ajax')) {
			$contact = $this->Contacts->get($id, ['contain' => ['Groups']]);
			foreach($contact->groups as $group){
				$this->request->data['groups']['_ids'][] = $group->id;
			}
			$contact->loggedInUser = $this->Auth->user('id');
			$this->Contacts->patchEntity($contact, $this->request->data);
			if($this->Contacts->save($contact)){
				$result = ['saved' => true];
			}
			else{
				$result = ['saved' => false];
			}
			$this->set(compact('result'));
		}
	}

	public function removeGroup($id = null){
		if ($this->request->is('post') && $this->request->is('ajax')) {
			$contact = $this->Contacts->get($id, ['contain' => ['Groups']]);
			$groups = [];
			foreach($contact->groups as $group){
				if($group->id != $this->request->data['groups']['_ids'][0]){
					$groups[] = $group->id;
				}
			}
			$this->request->data['groups']['_ids'] = $groups;
			$contact->loggedInUser = $this->Auth->user('id');
			$this->Contacts->patchEntity($contact, $this->request->data);
			if($this->Contacts->save($contact)){
				$result = ['saved' => true];
			}
			else{
				$result = ['saved' => false];
			}
			$this->set(compact('result'));
		}
	}
}