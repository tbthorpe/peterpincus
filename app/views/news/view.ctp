<div class="news-view">
	<div class="full-news">
		<h2><?php echo $news['News']['title']; ?></h2>
		<p class="newsViewDate"><?php echo $news['News']['created']; ?></p>
		<p class="newsViewBody"><?php echo $news['News']['body']; ?></p>
		<?php if(!empty($news['News']['filename'])): ?>
			<div class="newsViewImg"><img src="/img/news/thumb.medium.<?php echo $news['News']['filename']; ?>"></div>
		<?php endif; ?>
	</div>
	<div id="fullNewsBack">
		<a href="/news"><< back</a>
	</div>
</div>
