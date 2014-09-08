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

		// echo $this->Html->css('pincusstyles');
		// 		echo $this->Html->css('imgareaselect-animated');


	
		// echo $scripts_for_layout;
	?>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js' type='text/javascript'></script>
	<script src='/js/jquery.imgareaselect.js' type='text/javascript'></script>
	<script src='/js/jquery.jcarousel.min.js' type='text/javascript'></script>
	
	<?php echo $this->Html->script('BOOM'); ?>
	

	<link href='http://fonts.googleapis.com/css?family=Sorts+Mill+Goudy' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Alike+Angular' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon+SC' rel='stylesheet' type='text/css'>
</head>
<body>
	
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
</body>
</html>