<?php

class Asset extends AppModel {

	var $name = 'Asset';
	
	var $actsAs = array(
	    'MeioUpload' => array(
	        'filename' => array(
	            'dir' => 'img{DS}pieces{DS}', //webroot/uploads
	            'create_directory' => true,
	            'allowed_mime' => array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png'),
	            'allowed_ext' => array('.jpg', '.jpeg', '.png')
	        )
	    )
	);
	
	var $validate = array(
	    'filename' => array(
	        'Empty' => array(
	            'check' => false
	        )
	    )
	);
	
}

?>