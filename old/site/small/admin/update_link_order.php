<?php
/* update_navigation.php */

function getLastOrder($cat){
	include "includes/dbConnect.php";
	
			$query="SELECT * FROM dd_links where category=$cat ORDER BY order_num DESC LIMIT 1";
			
	$result=mysql_query($query);
	
	if (mysql_num_rows($result) == 0){
		return 0;
	} else {
		$order=mysql_result($result,0,"order_num");
		return $order;
	}
}

$link = mysql_connect("localhost","root","newyork");
$db_selected = mysql_select_db('dayna', $link);
$cat = $_GET['cat'];
$lid = $_GET['lid'];
$item_order = getLastOrder();
$order_array = explode(",", urldecode($_GET['order_num']));

foreach($order_array as $k=> $order) {
	$sql = "UPDATE dd_links SET order_num = $item_order WHERE lid = '" . mysql_real_escape_string($order) . "'";
	mysql_query($sql);
	$item_order--;
}

$output = "Item order has been updated.";
//echo $back;
?>