<div class="news-page">
	<div id="news-container">
		<?php foreach ($news as $news): ?>	
			<div class="news">
				<h2><a href="/news/view/<?php echo $news['News']['id'];?>"> <?php echo $news['News']['title']; ?></a></h2>
				<p class="newsdate"><?php echo date('l, d F Y', strtotime($news['News']['created'])); ?></p>
				<div class="news-copy">
					<?php echo $textile->parse($news['News']['body']); ?>
				</div>
				<?php if(!empty($news['News']['filename'])): ?>
					<div class="newsimg"><img src="/img/news/thumb.small.<?php echo $news['News']['filename']; ?>"></div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev(__('<<', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('>>', true), array(), null, array('class' => 'disabled'));?>
	</div>
</div>