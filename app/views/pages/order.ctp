<style type="text/css" media="screen">
	#orderform{
		font-family: 'IM Fell French Canon SC', serif;
	}
	label{display:block;}
	body{background-color:#f5f5f5;}
</style>
<?php //echo $ordered;?>
<?php if($ordered == false): ?>
<div id="orderform">
<h3>Please fill out the form<br>to start the process</h3>
<?php echo $this->Form->create('Page',array('type'=>'file'));?>
	<?php
		echo $this->Form->input('name',array('label'=>'Your name:'));
		echo $this->Form->input('email',array('label'=>'Your email:'));
		echo $this->Form->input('message',array('type'=>'textarea', 'label'=>'Any notes or messages for me<br>regarding the order?'));
		//echo $this->Form->input('order_id', array('value'=> $order_id, 'type'=>'hidden'))
	?>
<?php echo $this->Form->end(__('Place Order', true));?>
</div>
<?php else: ?>
	<h2>I will be in touch as soon as possible to fulfill the order!</h2>
<?php endif;?>
