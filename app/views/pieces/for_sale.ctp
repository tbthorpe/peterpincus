<style type="text/css" media="screen">
	#buyables li .sold-piece {text-align:center;}
	.purchase-price, .sold-piece{cursor:pointer;font-family:'Open Sans Condensed', 'IM Fell French Canon SC', serif;color:#B8492B;}
	.sold-piece{cursor:default;}
	
	.piecetitle{text-align:center;text-transform:uppercase;font-family:'Open Sans Condensed', 'IM Fell French Canon SC', serif;height:35px;margin-top:8px;}
	
	#purchase-container{margin-top:35px;}
</style>
<div class="purchase-page">
	<div id="purchase-container">
		<ul id="buyables" >
			<?php if(false && !empty($pieces)){ ?>
		   	<?php foreach ($pieces as $piece): ?>
				<li class="buyable">
					<a class="work_thumb_<?php echo $piece['Piece']['id']; ?>"><img class="thumb" title="<?php echo $piece['Piece']['title']; ?>" alt="<?php echo $piece['Piece']['description']; ?>" big="<?php echo $piece['Piece']['filename']; ?>" src="/img/pieces/<?php 
						$ext = strtolower(substr(basename($piece['Piece']['filename']), strrpos(basename($piece['Piece']['filename']), ".") + 1)); 
						$extLen = strlen($ext)+1;
						$filename = substr_replace($piece['Piece']['filename'],"_buy",strlen($piece['Piece']['filename'])-$extLen,0);
						echo $filename; ?>"></a>
						<p class="piecetitle"><?php echo $piece['Piece']['title'] ?></p>
						<?php if ($piece['Piece']['purchaseStatus'] == 'sold'): ?>
							<p class="sold-piece" que='<?php echo $piece['Piece']['id'] ?>'><img src="/img/sold_new.png">&nbsp;SOLD</p>
						<? else: ?>
							<p class="purchase-price" que='<?php echo $piece['Piece']['id'] ?>'>$<?php echo $piece['Piece']['price'] ?></p>
						<? endif; ?>
				</li>
				<div style="display:none;" id="title_<?php echo $piece['Piece']['id']; ?>">
					<?php echo $textile->parse($piece["Piece"]["description"]).'<br><br><a class="inboxbuy" que="'.$piece["Piece"]["id"].'">$'.$piece["Piece"]["price"]. '- PURCHASE</a>'; ?>
				</div>
			<?php endforeach; ?>
			<?php } else{ ?>
				* Update coming soon - stay tuned *
				<?php } ?>
		</ul>
		<div style="clear:both;"></div>
	</div>
</div>
<script>
	$('P.purchase-price').live('click', function(){
		$.fancybox({
				minHeight	: 400,
				minWidth	: 350,
				maxWidth	: 400,				
				fitToView	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none',
				type: 'iframe', 
				href: '/pages/order/'+$(this).attr('que')
			});
	});
	$('A.inboxbuy').live('click', function(){
		$.fancybox.close();
		$.fancybox({
				minHeight	: 400,
				minWidth	: 350,
				maxWidth	: 400,				
				fitToView	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none',
				type: 'iframe', 
				href: 'http://peterpincus.com/pages/order/'+$(this).attr('que')
			});
	});
	// $('.work_thumb').fancybox({
	// 	fitToView	: false,
	// 	closeClick	: false,
	// 	openEffect	: 'none',
	// 	closeEffect	: 'none',
	// 	maxHeight	: 600, 
	// });
	<? foreach ($pieces as $piece): ?>

			$('.work_thumb_<?= $piece["Piece"]["id"]; ?>').click(function(){
				$.fancybox.open([
					{href : '/img/pieces/<?= $piece["Piece"]["filename"]; ?>'},
					<? foreach ($piece['Images'] as $k=>$img): ?>
					{href : '/img/pieces/<?= $img["filename"]; ?>'}, 
					<? endforeach; ?>
					],
					{
						'margin'		: 0,
						'padding'		: 0,
						'prevEffect'	: 'fade',
						'nextEffect'	: 'fade',
							fitToView	: false,
							closeClick	: false,
							openEffect	: 'none',
							closeEffect	: 'none',
							maxHeight	: 600,
							helpers : {
								title : {
									type : 'inside'
								}
							},
							beforeLoad: function() {
					            var el
				                el = $('#title_' + <?= $piece["Piece"]["id"]; ?>);
				                if (el.length) {
				                    this.title = el.html();
				                }
					        }
					});
					
				});
<?php endforeach; ?>
</script>
