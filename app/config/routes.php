<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'newhome'));
	Router::connect('/about', array('controller' => 'pages', 'action' => 'about'));
	Router::connect('/purchase', array('controller' => 'pieces', 'action' => 'purchase'));
	Router::connect('/for_sale', array('controller' => 'pieces', 'action' => 'for_sale'));	
	Router::connect('/admin', array('controller'=>'users', 'action'=>'login','admin'=>true));
	Router::connect('/statement', array('controller' => 'pages', 'action' => 'statement'));
	Router::connect('/biography', array('controller' => 'pages', 'action' => 'biography'));
	Router::connect('/contact', array('controller' => 'pages', 'action' => 'contact'));
	Router::connect('/cv', array('controller' => 'pages', 'action' => 'cv'));
	
	Router::connect('/spring2013', array('controller' => 'categories', 'action' => 'view',39));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
