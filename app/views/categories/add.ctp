<div class="categories form">
<?php echo $this->Form->create('Category');?>
	<fieldset>
		<legend><?php __('Add Category'); ?></legend>
	<?php
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Categories', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List L2categories', true), array('controller' => 'l2categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New L2category', true), array('controller' => 'l2categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pieces', true), array('controller' => 'pieces', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Piece', true), array('controller' => 'pieces', 'action' => 'add')); ?> </li>
	</ul>
</div>