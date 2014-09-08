<div class="pieces form">
<?php echo $this->Form->create('Piece');?>
	<fieldset>
		<legend><?php __('Edit Piece'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('price');
		echo $this->Form->input('etsyLink');
		echo $this->Form->input('filename');
		echo $this->Form->input('category_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Piece.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Piece.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pieces', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>