<?php
class PiecesController extends AppController {

	var $name = 'Pieces';
	var $components = array('Thumb','Session','JqImgcrop');
	var $helpers = array('Cropimage','Textile');
	
	function beforeFilter(){
		parent::beforeFilter();
	}
	
	function admin_testup(){
		$categories = $this->Piece->Category->find('list');
		$this->set(compact('categories'));
	}
	function admin_createimagestep2(){ 
		$this->layout = 'admin';
        if (!empty($this->data)) { 
            $uploaded = $this->JqImgcrop->uploadImage($this->data['Piece']['filename'], '/img/pieces/', 'pp_'); 
			$this->set('uploaded',$uploaded);
			$this->data['Piece']['filename'] = $uploaded['imageName'];
			$this->Piece->create();
			if ($this->Piece->save($this->data)) {

	            
				$this->Session->setFlash(__('good so far. one more step.', true));
				// $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The piece could not be saved. Please, try again.', true));
			}
		}
		


	}
	function admin_createimagestep3(){ 
		$this->layout = 'admin';
		$purchase_cropped = $this->JqImgcrop->cropImage("buy",175, $this->data['Piece']['x1'], $this->data['Piece']['y1'], $this->data['Piece']['x2'], $this->data['Piece']['y2'], $this->data['Piece']['w'], $this->data['Piece']['h'], $this->data['Piece']['imagePath'], $this->data['Piece']['imagePath']);
		$cropped = $this->JqImgcrop->cropImage("tn",50, $this->data['Piece']['x1'], $this->data['Piece']['y1'], $this->data['Piece']['x2'], $this->data['Piece']['y2'], $this->data['Piece']['w'], $this->data['Piece']['h'], $this->data['Piece']['imagePath'], $this->data['Piece']['imagePath']);
		
	//	debug($cropped);
		$this->Session->setFlash(__('Word?', true));
		$this->redirect(array('action' => 'index'));
	}


	
	function index($id = null) {
		if (!empty($id)){			
		 $this->paginate = array(
		 		'conditions' => array('Piece.category_id' => $id)
		 	);
		}
		$this->Piece->recursive = 0;
		$this->set('pieces', $this->paginate());
		$this->set('categories',$this->Piece->Category->find('list'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid piece', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('piece', $this->Piece->read(null, $id));
	}
	
	function purchase(){	
		 $this->paginate = array(
		 		'conditions' => array('Piece.buyable' => '1')
		 	);
		$this->Piece->recursive = 0;
		$this->set('pieces', $this->paginate());
		$this->set('title_for_layout', "Purchase");
	}
	
	function for_sale(){	
		 $this->paginate = array(
		 		'conditions' => array('Piece.purchaseStatus' => array('availableforsale','sold')),
				'recursive' => 1
		 	);
		$this->Piece->recursive = 0;
		$this->set('pieces', $this->paginate());
		$this->set('title_for_layout', "Purchase");
	}

	function admin_index() {
		$this->layout = 'admin';
		$this->Piece->recursive=1;
		// $this->paginate['Piece']['contain'] = array (
		// 	            'Category' => array (
		// 					'parentCat' => array (
		// 	                    'fields' => array (
		// 	                        'parentCat.title',
		// 	                        'parentCat.id'
		// 	                    )
		// 	                )
		// 	            )
		// 	        );
		
		$this->set('pieces', $this->paginate('Piece'));
	}

	function admin_view($id = null) {
		$this->layout = 'admin';
		if (!$id) {
			$this->Session->setFlash(__('Invalid piece', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('piece', $this->Piece->read(null, $id));
	}

	function admin_add() {
		$this->layout = 'admin';
		if (!empty($this->data)) {
			$this->Piece->create();
			if ($this->Piece->save($this->data)) {
				$this->Session->setFlash(__('The piece has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The piece could not be saved. Please, try again.', true));
			}
		}
		$categories = $this->Piece->Category->find('all',array('contain'=>array('childCats')));
		$this->set(compact('categories'));
	}

	function admin_edit($id = null) {
		$this->layout = 'admin';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid piece', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			// debug ($this->data);
			// 									die();
			// if($this->data['Upload'][0]['filename']['name'] == "") unset($this->data['Upload']);// = array();
			if ($this->Piece->saveAll($this->data)) {
				if (!empty($this->data['todelete'])){
					foreach (array_keys($this->data['todelete']) as $image){
						$this->Piece->Images->delete($image);
					}
				}
				$this->Session->setFlash(__('The piece has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The piece could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Piece->read(null, $id);
		}
		$categories = $this->Piece->Category->find('list');
		$this->set(compact('categories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for piece', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Piece->delete($id)) {
			$this->Session->setFlash(__('Piece deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Piece was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
}
