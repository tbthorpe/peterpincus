<?php
class NewsController extends AppController {

	var $name = 'News';
	var $components = array('Session');
	var $helpers = array('Textile');

	function index() {
		 $this->paginate = array(
		 		'order' => array('News.created' => 'DESC')
		 	);
		$this->News->recursive = 0;
		$this->set('news', $this->paginate());
		$this->set('title_for_layout', "News");
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid news', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('news', $this->News->read(null, $id));
	}

	
	function admin_index() {
		$this->layout = 'admin';
		$this->News->recursive = 0;
        $this->paginate = array(
            'order' => array('News.created' => 'DESC')
        );
		$this->set('news', $this->paginate());
	}

	function admin_view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid news', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('news', $this->News->read(null, $id));
	}

	function admin_add() {
		$this->layout = 'admin';
		if (!empty($this->data)) {
			$this->News->create();
			if ($this->News->save($this->data)) {
				$this->Session->setFlash(__('The news has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid news', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->News->save($this->data)) {
				$this->Session->setFlash(__('The news has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->News->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for news', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->News->delete($id)) {
			$this->Session->setFlash(__('News deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('News was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
