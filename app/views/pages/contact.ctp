<div id="contact-container" class='main-contain'>
	<div id="contact-image">
		<img src="/img/contact_1.jpg">
		<div class="photocredit">Photo courtesy of <a href="http://www.mattdeturck.com/" target="_blank">Matt DeTurck</a></div>
	</div>
	<div id="contact-copy">
		<h2>Contact</h2>
		<br/><br/>
		<?php echo $textile->parse($content); ?>
		<br/><br/>
		<!-- Begin MailChimp Signup Form -->
		<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
		<style type="text/css">
			#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
			/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
			   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
		</style>
		<div id="mc_embed_signup" style="background-color:whitesmoke">
		<form action="//peterpincus.us8.list-manage.com/subscribe/post?u=f0db475f7b5a5a08911af2448&amp;id=679795b778" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<label for="mce-EMAIL" style="font-family:'lucida grande',verdana,helvetica,arial,sans-serif;">Or - subscribe to my mailing list!</label>
			<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
		    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
		    <div style="position: absolute; left: -5000px;"><input type="text" name="b_f0db475f7b5a5a08911af2448_679795b778" tabindex="-1" value=""></div>
		    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
		</form>
		</div>

		<!--End mc_embed_signup-->
	</div>
	
</div>
