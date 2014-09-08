<?php
class UsersController extends AppController {

	var $name = 'Users';
	function admin_login() {
		// No form processing needed, Auth does it automatically
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}

	function beforeFilter() {
		parent::beforeFilter();

		// Does not require being logged in
		$this->Auth->allow('signup', 'forgot');
		
		// If logged in, these pages require logout
		if ($this->Auth->user() && in_array($this->params['action'], array('signup', 'login'))) {
			$this->redirect('/');
		}
	}
}
