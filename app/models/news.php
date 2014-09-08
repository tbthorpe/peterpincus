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
				'zoomCrop' => true,
				            'thumbsizes' => array(
								  'medium' => array('width' => 800, 'height' => 600),
							      'small' => array('width' => 400, 'height' => 400,'maxDimension' => 'height', 'thumbnailQuality' => 100, 'zoomCrop' => true),
							    )
	        )
	    )
	);
	
}
