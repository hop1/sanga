<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notifications Controller
 *
 * @property App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController {

	public function isAuthorized($user = null) {
        return true;
    }

/**
 * Index method
 *
 * @return void
 */
	public function index() {
		$query = $this->Notifications->find()
			->where(['user_id' => $this->Auth->user('id')])
			->order(['unread' => 'DESC', 'Notifications.created' => 'DESC']);
		$this->set('notifications', $this->paginate($query));
	}

/**
 * View method
 *
 * Viewing a notification by its owner sets unread to false
 * 
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function view($id = null) {
		$notification = $this->Notifications->get($id, [
			'contain' => ['Users']
		]);
		if($notification->user_id == $this->Auth->user('id')){
			$notification->unread = false;
			$this->Notifications->save($notification);
		}
    	$this->set('notification_count', ($this->Notifications->find('unread', ['user_id' => $this->Auth->user('id')])->count()));
		$this->set('notification', $notification);
	}

/**
 * Add method
 *
 * @return void
 */
	public function add() {
		$notification = $this->Notifications->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Notifications->save($notification)) {
				$this->Flash->success('The notification has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The notification could not be saved. Please, try again.');
			}
		}
		$users = $this->Notifications->Users->find('list');
		$this->set(compact('notification', 'users'));
	}

/**
 * Edit method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function edit($id = null) {
		$notification = $this->Notifications->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$notification = $this->Notifications->patchEntity($notification, $this->request->data);
			if ($this->Notifications->save($notification)) {
				$this->Flash->success('The notification has been saved.');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error('The notification could not be saved. Please, try again.');
			}
		}
		$users = $this->Notifications->Users->find('list');
		$this->set(compact('notification', 'users'));
	}

/**
 * Delete method
 *
 * @param string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
	public function delete($id = null) {
		$notification = $this->Notifications->get($id);
		$this->request->allowMethod(['post', 'delete']);
		if ($this->Notifications->delete($notification)) {
			$this->Flash->success('The notification has been deleted.');
		} else {
			$this->Flash->error('The notification could not be deleted. Please, try again.');
		}
		return $this->redirect(['action' => 'index']);
	}
}
