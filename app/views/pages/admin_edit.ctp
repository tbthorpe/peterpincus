
<div class="pages form" id="pages-edit">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Admin Edit Page'); ?></legend>
	<?php
		echo "<h2>".$this->data['Page']['name']."</h2>";
		echo $this->Form->input('id');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Pages', true), array('action' => 'index'));?></li>
	</ul>
</div>