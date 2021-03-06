<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

$cakeDescription = 'Sanga';
?>
<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sanga :: 
		<?= $this->fetch('title') ?>
	</title>
	<?php
	print $this->Html->meta('icon');

	print $this->Html->css('base.css');
	print $this->Html->css('cake.css');
		
	print $this->Html->css('superfish.css');	//dropdown menu
	
	print $this->Html->css('jquery-ui.min.css');
	print $this->Html->css('jquery-ui.structure.min.css');
	print $this->Html->css('jquery-ui.theme.min.css');
	
	print $this->Html->css('sanga.css');
	
	print $this->Html->script('jquery.js');
	
	//dropdown menu
	print $this->Html->script('superfish.js');
	print $this->Html->script('hoverIntent.js');
		
	print $this->Html->script('jquery-ui.min.js');
	print $this->Html->script('jquery.ui.autocomplete.html.js');
	print $this->Html->script('ui.datepicker-hu.js');
	
	print $this->Html->script('gmap3.min.js');
	print $this->Html->script('http://maps.google.com/maps/api/js?sensor=false&amp;language=hu');
	
	print $this->Html->script('sanga.js');

	print $this->fetch('meta');
	print $this->fetch('css');
	print $this->fetch('script');
	?>
</head>
<body>
	<header>
		<?php echo $this->element('menu'); ?>
	</header>
	<div id="usersInfo">
		<dl>
			<dt>Admin</dt>
				<dd>Radharadhya dasa
					<ul>
						<li>rrd@krisna.hu</li>
						<li>+36 30 505 12 66</li>
					</ul>
				</dd>
			<dt>CRM Admin</dt>
				<dd>Vaidarbhi dd
					<ul>
						<li>vbdd@krisna.hu</li>
						<li>+36 30 </li>
					</ul>
				</dd>
		</dl>
	</div>
	<footer></footer>
</body>
</html>
