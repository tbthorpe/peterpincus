<div class="categories form">
<?php echo $this->Form->create('Category',array('type'=>'file'));?>
	<fieldset>
		<legend><?php __('Admin Add Category'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('copy');
		echo $this->Form->input('filename',array('type'=>'file'));
		echo $this->Form->input('parent_id', array('options' => $parents, 'empty' => ''));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Categories', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>