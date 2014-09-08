<?php

function displayLoginForm($msg){
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<title>Admin</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
		<script language="JavaScript" type="text/Javascript" src="includes/prototype.js"></script>
		<script language="JavaScript" type="text/JavaScript">
		<!--
		//-->
		</script>
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		</head>
		
		<body>
		<div id="centeringDiv">
		<?php include "includes/topNav.php"; ?>
				<BR>
				<form id="loginForm" action="main2.php" method="POST">
				<input type="hidden" name="logAttempt" value="true">
					<table width=100%>
						<tr>
							<td align=right width=50%>Username:&nbsp;&nbsp;</td><td><input type="text" name="a"></td>
						</tr>
						<tr>
							<td align=right width=50%>Password:&nbsp;&nbsp;</td><td><input type="password" name="b"></td>
						<tr>
						<tr>
							<td align=center colspan=2><input type="submit" value="Login"></td>
						<tr>
					</table>
			</form>
		</div>

		</div>
		</body>
		</html>
<?php
}
function closePage(){
		echo "</div>";
		echo "</div>";
		echo "</body>";
		echo "</html>";
}
function showOrderSelector($gid, $row, $ordernum, $pid, $tab, $before){
	switch ($tab) {
	case "resume_pics":
		$id = "res_id";
		break;
	case "fj_gallery_pics":
		$id = "gal_id";
		break;
	default:
		break;
	}
	include "includes/dbConnect.php";
	if ($ordernum > 0){
		$query="SELECT * FROM $tab where $id=$gid ORDER BY order_num";
	} else {
			$query="SELECT * FROM $tab where $id=$gid";
	}
	//echo $query."<BR>";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	$i=1;
	if ($ordernum == 0){
		echo "<SELECT class=\"newPostInput\" NAME =\"image".$row."order\">";
			$c=1;
		while ($c < $num+7) {
			if ($c == $row+$num+1){
				
				echo "<OPTION name=\"order\" Value =". $c . " oval=\"".$c."\" SELECTED>" . $c . "</OPTION>";
			} else {
					echo "<OPTION name=\"order\" Value =". $c . " oval=\"".$c."\">" . $c . "</OPTION>";
			}
			$c++;
		} 
	}else {
		//if (($ordernum > $before) && ($before != -1)){
			//echo "ordernum was ".$ordernum.", but now it's";
			//$ordernum = $ordernum-1;
			//echo $ordernum.", because before is ".$before."<BR>";
		//}	
		echo "<SELECT NAME =\"PEImage".$row."order\">";
			while ($i < $num+1) {
				
				
				if ($ordernum == $i){
					echo "<OPTION name=\"order\" Value =\"". $pid."x".$i . "\" oval=\"".$ordernum."\" SELECTED>" . $i . "</OPTION>";
				} else {
					echo "<OPTION name=\"order\" Value =\"". $pid."x".$i . "\" oval=\"".$ordernum."\" >" . $i . "</OPTION>";
				}
				$i++;
			}
	}
	echo "</SELECT>";
	mysql_close();
	mysql_free_result($result);
}
function showIfActive($id, $showit){
//echo "SHOWIT: ".$showit."<BR>";
	//include "includes/dbConnect_old2.php";

			//$query="SELECT * FROM gallery_galleries where gid=$id";

		//$result=mysql_query($query);
		
		//$num=mysql_numrows($result);
		//echo $query."<BR>";
		//echo "NUM IS: ".$num;
		//$orderby=mysql_result($result,$i,"order_num");
				$i=0;
			

				echo "<SELECT class=\"newPostInput\" NAME =\"showit\">";
					while ($i < 2) {
								//$showit=mysql_result($result,$i,"showit");
						if ($showit == $i){
							if ($i == 0){
								echo "<OPTION name=\"order\" Value =\"". $i . "\" oval=\"".$showit."\" SELECTED>No</OPTION>";
							} else {
								echo "<OPTION name=\"order\" Value =\"". $i . "\" oval=\"".$showit."\" SELECTED>Yes</OPTION>";
							}
						} else {
							if ($i == 0){
									echo "<OPTION name=\"order\" Value =\"". $i . "\" oval=\"".$showit."\" >No</OPTION>";
							} else {
									echo "<OPTION name=\"order\" Value =\"". $i . "\" oval=\"".$showit."\" >Yes</OPTION>";
							}
						}
						$i++;
					}
					
							echo "</SELECT>";
}


function displayDisplayChoice($opt, $name){
	if ($opt == 0){
		echo "No&nbsp;<input type='radio' name='".$name."' value='0' CHECKED>&nbsp;Yes&nbsp;<input type='radio' name='".$name."' value='1'>";
	} else {
		echo "No&nbsp;<input type='radio' name='".$name."' value='0'>&nbsp;Yes&nbsp;<input type='radio' name='".$name."' value='1' CHECKED>";
	}
	
}

function getLastOrder($tab){
	include "includes/dbConnect.php";
	switch ($tab){
		case "pg":
			$query="SELECT * FROM mcdc_photos ORDER BY `order` DESC LIMIT 1";
			break;
		case "news":
			$query="SELECT * FROM mcdc_news ORDER BY order_num DESC LIMIT 1";
			break;
		case "vids":
			$query="SELECT * FROM mcdc_vids ORDER BY `order` DESC LIMIT 1";
			break;
	}
	$result=mysql_query($query);
	
	if (mysql_num_rows($result) == 0){
		return 0;
	} else {
		$order=mysql_result($result,0,"order");
		return $order+1;
	}
}
?>