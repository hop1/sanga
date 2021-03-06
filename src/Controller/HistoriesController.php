<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Histories Controller
 *
 * @property App\Model\Table\HistoriesTable $Histories
 */
class HistoriesController extends AppController {
	
	public $helper = ['Time'];

	public function isAuthorized($user = null) {
        return true;
    }

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$this->paginate = [
			'contain' => ['Contacts', 'Users', 'Groups', 'Events', 'Units'],
			'order' => ['Histories.date' => 'DESC', 'Histories.id' => 'DESC']
		];
		$this->set('histories', $this->paginate($this->Histories));
	}

/**
 * View method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$history = $this->Histories->get($id, [
			'contain' => ['Contacts', 'Users', 'Groups', 'Events', 'Units']
		]);
		$this->set('history', $history);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$history = $this->Histories->newEntity($this->request->data);
		$history->user_id = $this->Auth->user('id');
		if ($this->request->is('post')) {
			//debug($this->request->data);die();
			$saved = $this->Histories->save($history);
			if ($saved) {
				$message = __('The history has been saved.');
				if ($this->request->is('ajax')) {
					$result = ['save' => true,
							   'message' => $message];
				} else {
					$this->Flash->success($message);
					return $this->redirect(['action' => 'index']);
				}
			} else {
				$message = __('The history could not be saved. Please, try again.');
				if ($this->request->is('ajax')) {
					$result = ['save' => false,
							   'message' => $message];
				} else {
					$this->Flash->error($message);
				}
			}
		}
		
		if ($this->request->is('ajax')) {
			$this->set(compact('result'));
			return;
		}
	
		$contacts = $this->Histories->Contacts->find('list');
		$groups = $this->Histories->Groups->find('list');
		$events = $this->Histories->Events->find('list');
		$units = $this->Histories->Units->find('list');
		$this->set(compact('history', 'contacts', 'groups', 'events', 'units'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$history = $this->Histories->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$history = $this->Histories->patchEntity($history, $this->request->data);
			if ($this->Histories->save($history)) {
				$this->Flash->success('The history has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The history could not be saved. Please, try again.');
			}
		}
		$contacts = $this->Histories->Contacts->find('list');
		$users = $this->Histories->Users->find('list');
		$groups = $this->Histories->Groups->find('list');
		$events = $this->Histories->Events->find('list');
		$units = $this->Histories->Units->find('list');
		$this->set(compact('history', 'contacts', 'users', 'groups', 'events', 'units'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$history = $this->Histories->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Histories->delete($history)) {
			$this->Flash->success('The history has been deleted.');
		} else {
			$this->Flash->error('The history could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
