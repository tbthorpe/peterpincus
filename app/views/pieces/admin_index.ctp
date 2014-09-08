<div class="pieces index">
	<h2><?php __('Pieces');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('filename');?></th>
			<th><?php echo $this->Paginator->sort('category_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pieces as $piece):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $piece['Piece']['id']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link(__($piece['Piece']['title'], true), array('action' => 'view', $piece['Piece']['id'])); ?></td>
		<td><img src="/img/pieces/<?php 
			$ext = strtolower(substr(basename($piece['Piece']['filename']), strrpos(basename($piece['Piece']['filename']), ".") + 1)); 
			$extLen = strlen($ext)+1;
			$filename = substr_replace($piece['Piece']['filename'],"_tn",strlen($piece['Piece']['filename'])-$extLen,0);
			echo $filename; 
		
		?>">&nbsp;</td>
		<td>
			<?php echo $this->Html->link($piece['Category']['title'], array('controller' => 'categories', 'action' => 'view', $piece['Category']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $piece['Piece']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $piece['Piece']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $piece['Piece']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Piece', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>