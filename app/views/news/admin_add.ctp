<div class="news form">
<?php echo $this->Form->create('News', array('type'=>'file'));?>
	<fieldset>
		<legend><?php __('Admin Add News'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('body');
		echo $this->Form->input('filename',array('type'=>'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List News', true), array('action' => 'index'));?></li>
	</ul>
</div>