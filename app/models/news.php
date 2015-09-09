<?php
class News extends AppModel {
	var $name = 'News';
	var $displayField = 'title';
	
	var $validate = array(
	    'filename' => array(
	        'Empty' => array(
	            'check' => false
	        )
	    )
	);
	
	
	var $actsAs = array(
	    'MeioUpload' => array(
	        'filename' => array(
	            'dir' => 'img{DS}news',
	            'create_directory' => true,
	            'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/JPG'),
	            'allowed_ext' => array('.jpg', '.jpeg', '.png'),
	        )
	    )
	);

	function getLatestNews($limit){
		return $this->find('all',array('conditions'=>array('News.created >'=>'2015-08-25 20:14:30'), 'limit'=>$limit, 'order'=>array('News.id DESC')));
	}
	
}
