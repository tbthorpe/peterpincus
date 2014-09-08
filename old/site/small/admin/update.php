<?php
	include "includes/dbConnect.php";
$new = $_GET['new'];

		$query="UPDATE test set `text`='$new' where 1";
		//echo $query.".....";
		$result=mysql_query($query);
	
		$query="SELECT * FROM test";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		mysql_close();
  
		$i=0;
		
		while ($i < $num) {
			$page=mysql_result($result,$i,"text");
			$return .= $page;
			$i++;
		}
		echo $return;


?>