<?php
class Category extends AppModel {
	var $name = 'Category';
	var $displayField = 'title';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'parentCat' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Pieces' => array(
			'className' => 'Piece',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'childCats' => array(
			'className' => 'Category',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	var $actsAs = array(
		'Containable',
	    'MeioUpload' => array(
	        'filename' => array(
	            'dir' => 'img{DS}categories',
	            'create_directory' => true,
	            'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/JPG'),
	            'allowed_ext' => array('.jpg', '.jpeg', '.png'),
				'zoomCrop' => true,
				            'thumbsizes' => array(
							      'cat' => array('width' => 300, 'height' => 300,'maxDimension' => 'height', 'thumbnailQuality' => 100, 'zoomCrop' => true)
							    )
	        )
	    )
	);

}
