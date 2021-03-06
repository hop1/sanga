<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
		<li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
		<li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Notifications'), ['controller' => 'Notifications', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Notification'), ['controller' => 'Notifications', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Contacts'), ['controller' => 'Contacts', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Contact'), ['controller' => 'Contacts', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Groups'), ['controller' => 'Groups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Group'), ['controller' => 'Groups', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Usergroups'), ['controller' => 'Usergroups', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Usergroup'), ['controller' => 'Usergroups', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="users view large-10 medium-9 columns">
	<h2><?= h($user->name) ?></h2>
	<div class="row">
		<div class="large-11 columns strings">
			<h6 class="subheader"><?= __('Name') ?></h6>
			<p>&nbsp;<?= h($user->name) ?></p>
			<h6 class="subheader"><?= __('Password') ?></h6>
			<p>&nbsp;***</p>
			<h6 class="subheader"><?= __('Realname') ?></h6>
			<p>&nbsp;<?= h($user->realname) ?></p>
			<h6 class="subheader"><?= __('Email') ?></h6>
			<p>&nbsp;<?= h($user->email) ?></p>
			<h6 class="subheader"><?= __('Phone') ?></h6>
			<p>&nbsp;<?= h($user->phone) ?></p>
			<h6 class="subheader"><?= __('Role') ?></h6>
			<p>&nbsp;<?= $this->Number->format($user->role) ?></p>
			<h6 class="subheader"><?= __('Created') ?></h6>
			<p>&nbsp;<?= h($user->created) ?></p>
			<h6 class="subheader"><?= __('Modified') ?></h6>
			<p>&nbsp;<?= h($user->modified) ?></p>
			<h6 class="subheader"><?= __('Active') ?></h6>
			<p>&nbsp;<?= $user->active ? __('Yes') : __('No'); ?></p>
		</div>
	</div>

	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Events') ?></h4>
	<?php if (!empty($user->events)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('User Id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($user->events as $events): ?>
		<tr>
			<td><?= h($events->id) ?></td>
			<td><?= h($events->name) ?></td>
			<td><?= h($events->user_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Events', 'action' => 'view', $events->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Events', 'action' => 'edit', $events->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Events', 'action' => 'delete', $events->id], ['confirm' => __('Are you sure you want to delete # {0}?', $events->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>

	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Histories') ?></h4>
	<?php if (!empty($user->histories)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Contact Id') ?></th>
			<th><?= __('Date') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Group Id') ?></th>
			<th><?= __('Event Id') ?></th>
			<th><?= __('Detail') ?></th>
			<th><?= __('Quantity') ?></th>
			<th><?= __('Unit Id') ?></th>
			<th><?= __('Family') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($user->histories as $histories): ?>
		<tr>
			<td><?= h($histories->id) ?></td>
			<td><?= h($histories->contact_id) ?></td>
			<td><?= h($histories->date) ?></td>
			<td><?= h($histories->user_id) ?></td>
			<td><?= h($histories->group_id) ?></td>
			<td><?= h($histories->event_id) ?></td>
			<td><?= h($histories->detail) ?></td>
			<td><?= h($histories->quantity) ?></td>
			<td><?= h($histories->unit_id) ?></td>
			<td><?= h($histories->family) ?></td>
			<td><?= h($histories->created) ?></td>
			<td><?= h($histories->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Histories', 'action' => 'view', $histories->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Histories', 'action' => 'edit', $histories->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Histories', 'action' => 'delete', $histories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $histories->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>

	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Notifications') ?></h4>
	<?php if (!empty($user->notifications)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('User Id') ?></th>
			<th><?= __('Notification') ?></th>
			<th><?= __('Unread') ?></th>
			<th><?= __('Created') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($user->notifications as $notifications): ?>
		<tr>
			<td><?= h($notifications->id) ?></td>
			<td><?= h($notifications->user_id) ?></td>
			<td><?= h($notifications->notification) ?></td>
			<td><?= h($notifications->unread) ?></td>
			<td><?= h($notifications->created) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'action' => 'view', $notifications->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Notifications', 'action' => 'edit', $notifications->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications', 'action' => 'delete', $notifications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $notifications->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>

	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Contacts') ?></h4>
	<?php if (!empty($user->contacts)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Contactname') ?></th>
			<th><?= __('Zip Id') ?></th>
			<th><?= __('Address') ?></th>
			<th><?= __('Phone') ?></th>
			<th><?= __('Email') ?></th>
			<th><?= __('Birth') ?></th>
			<th><?= __('Sex') ?></th>
			<th><?= __('Workplace') ?></th>
			<th><?= __('Family Id') ?></th>
			<th><?= __('Contactsource Id') ?></th>
			<th><?= __('Active') ?></th>
			<th><?= __('Comment') ?></th>
			<th><?= __('Created') ?></th>
			<th><?= __('Modified') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($user->contacts as $contacts): ?>
		<tr>
			<td><?= h($contacts->id) ?></td>
			<td><?= h($contacts->name) ?></td>
			<td><?= h($contacts->contactname) ?></td>
			<td><?= h($contacts->zip_id) ?></td>
			<td><?= h($contacts->address) ?></td>
			<td><?= h($contacts->phone) ?></td>
			<td><?= h($contacts->email) ?></td>
			<td><?= h($contacts->birth) ?></td>
			<td><?= h($contacts->sex) ?></td>
			<td><?= h($contacts->workplace) ?></td>
			<td><?= h($contacts->family_id) ?></td>
			<td><?= h($contacts->contactsource_id) ?></td>
			<td><?= h($contacts->active) ?></td>
			<td><?= h($contacts->comment) ?></td>
			<td><?= h($contacts->created) ?></td>
			<td><?= h($contacts->modified) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>

	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Groups') ?></h4>
	<?php if (!empty($user->groups)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th><?= __('Description') ?></th>
			<th><?= __('Admin User Id') ?></th>
			<th><?= __('Shared') ?></th>
			<th><?= __('Intersection Group Id') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($user->groups as $groups): ?>
		<tr>
			<td><?= h($groups->id) ?></td>
			<td><?= h($groups->name) ?></td>
			<td><?= h($groups->description) ?></td>
			<td><?= h($groups->admin_user_id) ?></td>
			<td><?= h($groups->shared) ?></td>
			<td><?= h($groups->_joinData->intersection_group_id) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Groups', 'action' => 'view', $groups->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Groups', 'action' => 'edit', $groups->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Groups', 'action' => 'delete', $groups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $groups->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>

	<div class="column large-12">
	<h4 class="subheader"><?= __('Related Usergroups') ?></h4>
	<?php if (!empty($user->usergroups)): ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?= __('Id') ?></th>
			<th><?= __('Name') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
		<?php foreach ($user->usergroups as $usergroups): ?>
		<tr>
			<td><?= h($usergroups->id) ?></td>
			<td><?= h($usergroups->name) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['controller' => 'Usergroups', 'action' => 'view', $usergroups->id]) ?>
				<?= $this->Html->link(__('Edit'), ['controller' => 'Usergroups', 'action' => 'edit', $usergroups->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['controller' => 'Usergroups', 'action' => 'delete', $usergroups->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usergroups->id)]) ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
	</div>
</div>
