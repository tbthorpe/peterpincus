<?php
/* update_navigation.php */

function getLastOrder(){
	include "includes/dbConnect.php";
	$query="SELECT * FROM dd_news ORDER BY order_num DESC LIMIT 1";
	$result=mysql_query($query);
	$order=mysql_result($result,0,"order_num");
	
	return $order;
}

$link = mysql_connect("localhost","root","newyork");
$db_selected = mysql_select_db('dayna', $link);
$item_order = getLastOrder();
$order_array = explode(",", urldecode($_GET['order_num']));

foreach($order_array as $k=> $order) {
	$sql = "UPDATE dd_news SET order_num = $item_order WHERE nid = '" . mysql_real_escape_string($order) . "'";
	mysql_query($sql);
	$item_order--;
}

$output = "Item order has been updated.";
//echo $back;
?>
