<div class="purchase-page">
	<div id="purchase-container">
		<ul id="buyables" >
			<?php if(!empty($pieces)){ ?>
		   	<?php foreach ($pieces as $piece): ?>
				<li class="buyable">
					<a href="<?php echo $piece['Piece']['etsyLink']; ?>" target="_blank"><img class="thumb" title="<?php echo $piece['Piece']['title']; ?>" alt="<?php echo $piece['Piece']['description']; ?>" big="<?php echo $piece['Piece']['filename']; ?>" src="/img/pieces/<?php 
						$ext = strtolower(substr(basename($piece['Piece']['filename']), strrpos(basename($piece['Piece']['filename']), ".") + 1)); 
						$extLen = strlen($ext)+1;
						$filename = substr_replace($piece['Piece']['filename'],"_buy",strlen($piece['Piece']['filename'])-$extLen,0);
						echo $filename; ?>"></a>
						<p class="purchase-price">$<?php echo $piece['Piece']['price'] ?></p>
				</li>
			<?php endforeach; ?>
			<?php } else{ ?>
				Update - Coming *very* soon. Work should be up here and buyable by Saturday, Sept 21 at noon!. Check back during the week for more updates!
				<?php } ?>
		</ul>
		<div style="clear:both;">
	</div>
	<div style="clear:both;">
	<!-- <p>
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
	</div> -->
</div>
