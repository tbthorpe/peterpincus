<?php
class Piece extends AppModel {
	var $name = 'Piece';
	var $displayField = 'title';
	//var $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	//var $actsAs = array(
	//    'MeioUpload' => array(
	//        'filename' => array(
	//            'dir' => 'img{DS}pieces',
	//            'create_directory' => true,
	//            'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/JPG'),
	//            'allowed_ext' => array('.jpg', '.jpeg', '.png'),
	//            'default' => 'default.jpg',
	//        )
	//    )
	//);
	// 'zoomCrop' => true,
	//             'thumbsizes' => array(
	// 				  'medium' => array('width' => 800, 'height' => 600),
	// 			      'small' => array('width' => 100, 'height' => 100,'maxDimension' => '', 'thumbnailQuality' => 100, 'zoomCrop' => true),
	// 			    ),
	
	public $hasMany = array(
		'Images'=>array(
			'className' => 'Asset',
			'foreignKey' => 'foreign_id',
			'conditions' => array('Images.class'=>'Pieces','Images.type'=>'secondary'),
			)
		);
		
		
	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getBuyableWork($new = false){
		if ($new){
			return $this->find('all',array('conditions'=>array('Piece.purchaseStatus'=>'availableforsale', 'Piece.version' => 1), 'recursive'=>1));
		} else {
			return $this->find('all',array('conditions'=>array('Piece.buyable'=>1)));
			
		}
		
	}

}
