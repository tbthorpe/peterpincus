
<?php foreach ($categories as $cat): ?>
	<div class="subcatListing">
		
		<div class="subcat_image">
			<img src="/img/categories/thumb.cat.<?php echo $cat['Category']['filename']; ?>">
		</div>
		<div class="subcat_copy" style="text-align:center;margin-top:20px;">
			<h3 style="align:center;"><a href="/categories/view/<?php echo $cat['Category']['id']; ?>"><?php echo $cat['Category']['title']; ?></a></h3>
			<?php echo $textile->parse($cat['Category']['copy']); ?>
		</div>
		
		<div style="clear:both;"></div>
	</div>
<?php endforeach; ?>
