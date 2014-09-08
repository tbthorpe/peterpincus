<?php echo $form->create('Piece', array('action' => 'createimagestep2', "enctype" => "multipart/form-data"));?> 
<?php
	echo $this->Form->input('title');
	echo $this->Form->input('description');
	echo $this->Form->input('price');
	echo $this->Form->input('etsyLink');
	echo $this->Form->input('filename',array('type'=>'file'));
	echo $this->Form->input('category_id');
	echo $form->end('Upload');
?>
