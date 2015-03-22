<?php
class PagesController extends AppController {
//	var $uses = array();
	var $components = array('Session', 'Email');
	var $helpers = array('Textile');
	
	function beforeFilter(){
		parent::beforeFilter();
	}
	function admin_index(){
		$this->layout = "admin";
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
	}
	function admin_edit($id = null) {
		$this->layout="admin";	
		$this->Page->recursive = 0;
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Page->save($this->data)) {
				$this->Session->setFlash(__('The page has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Page could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Page->read(null, $id);
		}
	}

	
	function home(){
		Configure::write('debug',0);
		$content = $this->Page->find('first', array('fields'=>array('Page.content'),'conditions'=>array('name'=>'home')));
		$this->set('content', $content['Page']['content']);
		$this->set('title_for_layout', "Peter Pincus.");
	}	
	
	function contact(){
		$content = $this->Page->find('first', array('fields'=>array('Page.content'),'conditions'=>array('name'=>'contact')));
		$this->set('content', $content['Page']['content']);
		$this->set('title_for_layout', "Contact");
	}
	function statement(){
		$content = $this->Page->find('first', array('fields'=>array('Page.content','Page.name'),'conditions'=>array('name'=>'statement')));
		$this->set('content', $content['Page']['content']);
		$this->set('title_for_layout', "Statement");
	}
	function biography(){
		$content = $this->Page->find('first', array('fields'=>array('Page.content','Page.name'),'conditions'=>array('name'=>'biography')));
		$this->set('content', $content['Page']['content']);
		$this->set('title_for_layout', "Biography");
	}
	function cv(){
		$content = $this->Page->find('first', array('fields'=>array('Page.content','Page.name'),'conditions'=>array('name'=>'cv')));
		$this->set('content', $content['Page']['content']);
		$this->set('title_for_layout', "CV");
	}
	function order($id = NULL){
		$this->layout = 'empty';
		if (!empty($this->data)) {
			// debug ($this->data);
			$this->Email->from    = $this->data['Page']['email'];
			$this->Email->to      = 'pjpincus1@gmail.com';
			$this->Email->subject = 'Order Request from Peterpincus.com';
			$this->Email->send($this->data['Page']['name']. "\n\n" . $this->data['Page']['message']."\n\n"."ORDERING: http://peterpincus.com/pieces/view/".$this->data['Page']['order_id']);
			$this->set('ordered',true);
		} else {
			$this->set('ordered',false);
			$this->set('order_id',$id);
		}

	}
}
