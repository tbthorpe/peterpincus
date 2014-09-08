<script type="text/javascript">
var id = 0;
$(document).ready(function() {
	$('.thumb').click(function(){
		var filename = "/img/pieces/s_"+$(this).attr('big');
		var newtitle = $(this).attr('title');
		var newabout = $(this).attr('about');
		$('#featured-img').fadeOut('fast',function(){
			$('#main-piece-img').attr('src',filename);
			$('#featured-img').fadeIn('fast');
		});
		$('.pur_price').html($(this).attr('pr'));
		if($(this).attr('sale') == 'sold'){
			$("#sold_box").fadeIn('fast');
		} else {
			$("#sold_box").fadeOut('fast');
		}
		if($(this).attr('sale') == 'availableforsale'){
			$('#purchase_box').fadeIn('fast');
			id = $(this).attr('que');
		} else {
			$('#pur_price').html('');
			$('#purchase_box').fadeOut('fast');
		}
		return false;
	});
});


</script>
<?php //debug($pieces[0]['Pieces']);?>
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
					<img class="thumb" title="<?php echo $piece['title']; ?>" alt="<?php echo $piece['description']; ?>" que="<?php echo $piece['id']; ?>" sale="<?php echo $piece['purchaseStatus']; ?>"  big="<?php echo $piece['filename']; ?>" pr="<?php echo $piece['price']; ?>" src="/img/pieces/<?php 
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
			<div id="purchase_box" style="display:none;margin-top:25px;">$<span class="pur_price"></span> - <span id="pur_link" data-fancybox-type="iframe">Click to order</span></div>
			<div id="sold_box" style="display:none;margin-top:25px;">$<span class="pur_price"></span> - <img src='/img/sold_reddot.gif'>&nbsp; SOLD</div>
		</div>
	</div>
</div>
<script>
	$('SPAN#pur_link').live('click', function(){
		$.fancybox({
				minHeight	: 400,
				minWidth	: 350,
				maxWidth	: 400,				
				fitToView	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none',
				type: 'iframe', 
				href: 'http://peterpincus.com/pages/order/'+id
			});
	});
</script>