<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo "Peter Pincus - ". $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('pincusstyles');
		echo $this->Html->css('jquery.fancybox');
		echo $this->Html->css('imgareaselect-animated');


	
		echo $scripts_for_layout;
	?>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js' type='text/javascript'></script>
	<script src='/js/jquery.imgareaselect.js' type='text/javascript'></script>
	<script src='/js/jquery.jcarousel.min.js' type='text/javascript'></script>

	<script src='/js/jquery.fancybox.js' type='text/javascript'></script>
	
	<?php echo $this->Html->script('BOOM'); ?>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			var x = window.location.pathname.toString();
			if (x.search("categories") >= 0){
				fillTheBar();
				$('#workCatsNav').css('display','block');
			}
			if (x.search("statement") >= 0 || x.search("biography") >= 0 || x.search("contact") >= 0 || x.search("cv") >= 0){
				fillTheBar();
				$('#aboutPageNav').css('display','block');
			}
		});
	</script>

	<link href='http://fonts.googleapis.com/css?family=Sorts+Mill+Goudy' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Alike+Angular' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="container">
		<div id="header">
			<div id="headborder">
				<div id="head0">
					<div id="head1">
						<div id="head2"> 
							<div id="head3">
								<div class="shorter"  id="head4"></div>
								<div class="shorter"  id="head5"></div>
								<div class="shorter"  id="head6"></div>
								<div class="shorter"  id="head7"></div>
								<div class="shorter"  id="head8"></div>
								<div class="shorter" id="head9">
									<h1>Peter Pincus</h1>
									<h2>ceramic artist.</h2>
								</div>
							</div>
							<ul id="nav">
								<!-- <li class="link">
																contact
															</li> -->
								<li class="link">
									<a href="/news">news</a>
								</li>
								<li class="link">
									<a href="/for_sale">purchase</a>
								</li>
								<li class="link">
									<span style="cursor:pointer;" id="aboutNav">about</span>
								</li>
								<li class="link">
									<!-- <a href="/pieces/index/1"> -->
									<span style="cursor:pointer;" id="workNav">work</span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="bottomNavBar" id="workCatsNav" style="height:25px;"></div>
			<div class="bottomNavBar" id="aboutPageNav" style="height:25px;">
				<ul>
					<li><a href="/contact">contact</a></li>
					<li><a href="/cv">CV</a></li>
					<li><a href="/biography">biography</a></li>
					<li><a href="/statement">statement</a></li>
			</div>
			
			
			
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			&copy;&nbsp;<?php echo date('Y'); ?>
			<div style="float:right;height:25px;witdh:25px;margin-left:10px;">
				<a href="http://instagram.com/peterpincusporcelain" target="_blank"><img src="/img/instagram-small.png" height=30></a>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-36594400-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</body>
</html>