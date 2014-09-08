<script type="text/javascript">
$(document).ready(function() {
	$('.thumb').click(function(){
		var filename = "/img/pieces/s_"+$(this).attr('big');
		var newtitle = $(this).attr('title');
		var newabout = $(this).attr('about');
		$('#featured-img').fadeOut('fast',function(){
			$('#main-piece-img').attr('src',filename);
			$('#featured-img').fadeIn('fast');
		});
		return false;
	});
});


</script>
<div class="pieces-page">
	<div id="categories-nav">
		<ul>
		<?php foreach ($siblings as $sib):?>
			<li class="subcat" style="width:<?php echo 860/(count($siblings))?>px;">
				<a href="/categories/view/<?php echo $sib['Category']['id'] ?>"><?php echo $sib['Category']['title']?></a>
			</li>
		<?php endforeach; ?>
		</ul>
		<div style="clear:both;"></div>
	</div>
	<div id="piece-left">
		<ul id="pieces thumbs">

			<?php foreach ($pieces[0]['Pieces'] as $piece):?>
		
				<li class="piece-tn">
					<img class="thumb" title="<?php echo $piece['title']; ?>" alt="<?php echo $piece['description']; ?>" big="<?php echo $piece['filename']; ?>" src="/img/pieces/<?php 
						$ext = strtolower(substr(basename($piece['filename']), strrpos(basename($piece['filename']), ".") + 1)); 
						$extLen = strlen($ext)+1;
						$filename = substr_replace($piece['filename'],"_tn",strlen($piece['filename'])-$extLen,0);
						echo $filename; ?>">
				</li>
			
			<?php endforeach; ?>
		</ul>
	</div>
	
	<div id="piece-right">
		<div id="featured-img">
			<?php
			if ($pieces[0]['Pieces'][0]['filename'] != ""){ ?>
			<img id="main-piece-img" class="fullImage" title="<?php echo $pieces[0]['Pieces'][0]['title']; ?>" alt="<?php echo $pieces[0]['Pieces'][0]['description']; ?>" src="/img/pieces/s_<?php echo $pieces[0]['Pieces'][0]['filename']; ?>">
			<?php } else{ ?>
				Coming soon
			<?php } ?>
		</div>
	</div>
</div>