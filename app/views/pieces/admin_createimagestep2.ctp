<?php  
        echo $form->create('Piece', array('action' => 'createimagestep3','admin'=>true,"enctype" => "multipart/form-data"));     
        echo $form->input('id'); 
        echo $form->hidden('title'); 
//debug($uploaded["imagePath"]);
		echo $cropimage->createJavaScript($uploaded['imageWidth'],$uploaded['imageHeight'],51,51);  
        echo $cropimage->createForm($uploaded["imagePath"], 51, 51); 
        echo $form->submit('Done', array("id"=>"save_thumb")); 
echo $form->end();?>