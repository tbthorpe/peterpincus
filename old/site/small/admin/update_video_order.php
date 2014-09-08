<?php
/* update_navigation.php */

function getLastOrder(){
	include "includes/dbConnect.php";
	
			$query="SELECT * FROM talla_vids ORDER BY `order` DESC LIMIT 1";
			
	$result=mysql_query($query);
	
	if (mysql_num_rows($result) == 0){
		return 0;
	} else {
		$order=mysql_result($result,0,"order");
		return $order;
	}
}

$link = mysql_connect("localhost","root","newyork");
$db_selected = mysql_select_db('talla', $link);
$item_order = getLastOrder();
$order_array = explode(",", urldecode($_GET['order_num']));

foreach($order_array as $k=> $order) {
	$sql = "UPDATE talla_vids SET `order` = $item_order WHERE vid = '" . mysql_real_escape_string($order) . "'";
	mysql_query($sql);
	$item_order--;
}

$output = "Item order has been updated.";
//echo $back;
?>
