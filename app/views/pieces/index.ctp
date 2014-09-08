<script type="text/javascript">
function mycarousel_initCallback(carousel) {
    $('.jcarousel-control a').bind('click', function() {
        carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
        return false;
    });

    $('.jcarousel-scroll select').bind('change', function() {
        carousel.options.scroll = jQuery.jcarousel.intval(this.options[this.selectedIndex].value);
        return false;
    });

    $('#car-move-right').bind('click', function() {
        carousel.next();
        return false;
    });

    $('#car-move-left').bind('click', function() {
        carousel.prev();
        return false;
    });
};


$(document).ready(function() {
    $("#piece-carousel").jcarousel({
        scroll: 1,
		visible: 6,
		initCallback: mycarousel_initCallback,
        // This tells jCarousel NOT to autobuild prev/next buttons
        buttonNextHTML: null,
        buttonPrevHTML: null
    });
	$('.thumb').click(function(){
		var filename = "/img/pieces/s_"+$(this).attr('big');
		var newtitle = $(this).attr('title');
		var newabout = $(this).attr('about');
		$('#main-piece-img').fadeOut('fast',function(){
			$('#main-piece-img').attr('src',filename);
			$('#featured-desc').text(newabout);
			$('#piece-right h2').text(newtitle);
			$('#main-piece-img').fadeIn('fast');
		});
		
	});
});


</script>
<div class="pieces-page">
	<div id="categories-nav">
		<ul>
		<?php foreach ($categories as $c_id => $name):?>
			<li><a class="<?php echo ($this->passedArgs[0] == $c_id)? "on" : "off"; ?>" href="/pieces/index/<?php echo $c_id; ?>"><?php echo $name; ?></a></li>
		<?php endforeach;?>
		</ul>
	</div>
	
	<div id="carousel-container">
		<div class="nextprevbutton"><img src="/img/prev.png" id="car-move-left"></div>
		<ul id="piece-carousel" class="jcarousel-skin-work">

		   	<?php foreach ($pieces as $piece): ?>
				<li class="piece-tn">
					<img class="thumb" title="<?php echo $piece['Piece']['title']; ?>" alt="<?php echo $piece['Piece']['description']; ?>" big="<?php echo $piece['Piece']['filename']; ?>" src="/img/pieces/<?php 
						$ext = strtolower(substr(basename($piece['Piece']['filename']), strrpos(basename($piece['Piece']['filename']), ".") + 1)); 
						$extLen = strlen($ext)+1;
						$filename = substr_replace($piece['Piece']['filename'],"_tn",strlen($piece['Piece']['filename'])-$extLen,0);
						echo $filename; ?>">
				</li>
			<?php endforeach; ?>
		</ul>
	<div class="nextprevbutton"><img src="/img/lr.png" id="car-move-right"></div>
	<div style="clear:both;"></div>
	</div>
	
	<div id="featured-piece">
		<div id="piece-left">
			<center><img id="main-piece-img" src="/img/pieces/s_<?php echo $pieces[0]['Piece']['filename']; ?>"></center>
		</div>
		<div id="piece-right">
			<h2><?php echo $pieces[0]['Piece']['title']; ?></h2>
			<p class="featured-desc"><?php echo $pieces[0]['Piece']['description']; ?></p>
		</div>
		<div style="clear:both;"></div>
	</div>
	

	

	
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
