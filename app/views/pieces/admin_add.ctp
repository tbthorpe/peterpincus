<div class="pieces form">
<?php echo $form->create('Piece', array('action' => 'createimagestep2', "enctype" => "multipart/form-data"));?> 
	<fieldset>
		<legend><?php __('Admin Add Piece'); ?></legend>
		
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('description');
			echo $this->Form->input('filename',array('type'=>'file'));
			echo $this->Form->input('price');
			// echo $this->Form->input('etsyLink');
			// echo $this->Form->input('buyable',array('type'=>'checkbox'));
			echo $this->Form->input('purchaseStatus',array('type'=>'select','options'=>array('notforsale'=>'Not for sale', 'sold'=>'Sold', 'availableforsale'=>'Available For Sale')));
			// echo $this->Form->input('category_id');
			echo "<select name='data[Piece][category_id]' id='PieceCategoryId'>";
			foreach ($categories as $category){
				if ($category['Category']['parent_id'] == NULL){
					echo "<optgroup label='".$category['Category']['title']."'>";
					foreach ($category['childCats'] as $subcat){
						echo "<option value='".$subcat['id']."'>".$subcat['title']."</option>";
						
					}
					echo "</optgroup>";
				}
			}
			echo "</select>";
		?>
	</fieldset>
<?php echo $form->end('Upload'); ?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pieces', true), array('action' => 'index'));?></li>
	</ul>
</div>