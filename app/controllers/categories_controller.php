<?php
class CategoriesController extends AppController {

    var $name = 'Categories';
    var $components = array('Session');
    var $helpers = array('Textile');
    
    function view($id = null) {
        $this->layout='default';
        if (!$id) {
            $this->Session->setFlash(__('Invalid category', true));
            $this->redirect(array('action' => 'index'));
        }
        
        $pieces = $this->Category->find('all',array('conditions'=>array('Category.id'=>$id)));
        $siblings = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$pieces[0]['parentCat']['id']),
                                                        'recursive'=>0));
        $this->set(compact('pieces'));
        $this->set(compact('siblings'));
        $this->set('title_for_layout', "Work");
    }
    function purchase($id = null) {
        $this->layout='default';
        if (!$id) {
            $this->Session->setFlash(__('Invalid category', true));
            $this->redirect(array('action' => 'index'));
        }
        
        $pieces = $this->Category->find('all',array('conditions'=>array('Category.id'=>$id)));
        $siblings = $this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$pieces[0]['parentCat']['id']),
                                                        'recursive'=>0));
        $this->set(compact('pieces'));
        $this->set(compact('siblings'));
        $this->set('title_for_layout', "Work");
    }
    
    function topLevels(){
        $this->layout=null;
        //$cats = $this->Category->getTopLevelCategories();
        $cats = $this->Category->find('all',array('conditions'=>array('Category.parent_id IS NULL','Category.id !='=>40),
                                                    'fields'=>'Category.title',
                                                    'recursive'=>0,
                                                    'order'=>'Category.id DESC'));
        
        
        $this->set('cats',json_encode($cats));
    }
    
    function sub($id = null){
        if (!$id) {
            $this->Session->setFlash(__('Invalid category', true));
            $this->redirect(array('action' => 'index'));
        }
        //debug($this->Category->find('all', array('conditions'=>array('Category.parent_id' => $id),
                                                                    // 'fields'=>array('Category.title','Category.filename','Category.copy'),
                                                                    //                                                                  'recursive'=>0)));
        $this->set('sub',$id);
        $this->set('categories',$this->Category->find('all', 
            array('conditions'=>array('Category.parent_id' => $id),
                    'fields'=>array('Category.title','Category.filename','Category.copy'),
                    'recursive'=>0,
                    'order'=>array('Category.id DESC'))));
        $this->set('title_for_layout', "Work");
    }

    function admin_index() {
        $this->layout='admin';
        $this->Category->recursive = 2;
        $this->paginate = array('conditions'=>array('Category.new_category = 1'));
        $this->set('categories', $this->paginate());
        // $parents = $this->Category->parentCat->find('list',array('conditions'));
        //      $this->set(compact('parents'));
    }

    function admin_view($id = null) {
        $this->layout='admin';
        if (!$id) {
            $this->Session->setFlash(__('Invalid category', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('category', $this->Category->read(null, $id));
    }

    function admin_add() {
        $this->layout='admin';
        if (!empty($this->data)) {
            $this->Category->create();
            if ($this->Category->save($this->data)) {
                $this->Session->setFlash(__('The category has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
            }
        }
        $parents = $this->Category->find('list', array('conditions'=>array('Category.parent_id IS NULL')));
        $this->set(compact('parents'));
    }

    function admin_edit($id = null) {
        $this->layout='admin';
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid category', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Category->save($this->data)) {
                $this->Session->setFlash(__('The category has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Category->read(null, $id);
        }
        $parents = $this->Category->find('list', array('conditions'=>array('Category.parent_id IS NULL')));
        $this->set(compact('parents'));
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for category', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Category->delete($id)) {
            $this->Session->setFlash(__('Category deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Category was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
}

