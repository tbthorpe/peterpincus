<?php
class PagesController extends AppController {
//	var $uses = array();
	//var $helpers = array('CountryList', 'Textile');
	
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
			if ($this->Page->saveAll($this->data)) {
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
		$content = $this->Page->find('first', array('fields'=>array('Page.content'),'conditions'=>array('name'=>'home')));
		$this->set('content', $content['Page']['content']);
	}	

	function newhome(){
		$content = $this->Page->find('first', array('fields'=>array('Page.content'),'conditions'=>array('name'=>'home')));
		$this->set('content', $content['Page']['content']);
	}	

}
