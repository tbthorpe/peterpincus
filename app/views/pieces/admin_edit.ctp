<?php //debug ($this->data); ?>
<div class="pieces form">
<?php echo $this->Form->create('Piece',array('type'=>'file'));?>
	<!-- <fieldset> -->
		<legend><?php __('Admin Edit Piece'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo "For now, if you need to change out the picture - just delete this and add it again.  I'm working on fixing this!";
		//echo $this->Form->input('buyable');
		//echo $this->Form->input('available');
		echo $this->Form->input('purchaseStatus',array('type'=>'select','options'=>array('notforsale'=>'Not for sale', 'sold'=>'Sold', 'availableforsale'=>'Available For Sale')));
		echo $this->Form->input('price');
		// echo $this->Form->input('etsyLink');
		echo $this->Form->input('category_id');
	?>
	<?php $num_uploads = sizeof($this->data['Images']);
	if ($num_uploads > 0):
		for ($i=0; $i<$num_uploads; ++$i){
			if(isset($this->data['Images'][$i])){ ?>
				<div style='border:1px solid red;padding:10px;' class="sizzortable" id="w_<?php echo $this->data['Images'][$i]['id']; ?>">
					<img src="<?php echo "/img/pieces/".$this->data['Images'][$i]['filename']; ?>" width=250 /> 
					<?php echo $this->Form->input("Images.$i.filename",array('type'=>'file','label'=>'Want to replace this one? Use this below!')); ?>
					<?php echo $this->Form->input("Images.$i.id"); ?>

					<?php echo $this->Form->hidden("Images.$i.type"); ?>
					<?php echo $this->Form->hidden("Images.$i.class"); ?>
				<div class="image-delete">Wanna delete? Check this box! <input class="image-delete-check" type="checkbox" name="data[todelete][<?php echo $this->data['Images'][$i]['id']; ?>]" /></div>
				</div>
	<?php	}
		}
				
		endif; 
		//echo "</div>";
		echo '<div id="additional"></div>';	
		echo '<a id="add-images">Add Image</a>';
		echo '<script type="text/javascript"> 
				$("#add-images").click(function(){
					var children = $("#additional").children().length;
					var next = 1 + children + '.$num_uploads.';
					$("#additional").append(\'<div class="input file"><input type="file" name="data[Images][\' + next + \'][filename]" id="Image\' + next + \'Filename"><input type="hidden" name="data[Images][\' + next + \'][class]" value="'.$this->name.'" id="Image\' + next + \'Class"><input type="hidden" name="data[Images][\' + next + \'][type]" value="secondary" id="image\' + next + \'Type"></div>\');
				});
			 </script>';



?>
	<!-- </fieldset> -->
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Piece.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Piece.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pieces', true), array('action' => 'index'));?></li>
	</ul>
</div>