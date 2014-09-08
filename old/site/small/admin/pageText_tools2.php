<?php

	include "includes/dbConnect_old2.php";



function displayPageTextAdmin($msg){
		include "includes/dbConnect_old2.php";
			?>
		<html>
		<head>
		<title>Page Text Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	
	<script src="includes/prototype.js" type="text/javascript"></script>
	<script src="includes/scriptaculous.js" type="text/javascript"></script>
	<script src="includes/lightbox.js" type="text/javascript"></script>


		<script language="JavaScript" type="text/JavaScript">
		<!--
		//-->
		</script>

		</head>
		
		<body>
		<div id="centeringDiv">
			<?php include "includes/topNav.php";
		echo "<div id=\"AdminTable\">";
		$query="SELECT * FROM page_text ORDER BY ptid DESC";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		mysql_close();
  

		echo "<b><center>Current Page Text</center></b><br><br>";
		$i=0;
		echo "<table width=100% border=0>";
			echo "<tr style=\"background-color: #ffffff;\"><td><b>Page</b></td><td><b>Text</b></td><td><b>Change</b></td></tr>";
		while ($i < $num) {
		
			$page=mysql_result($result,$i,"page_name");
			$id=mysql_result($result,$i,"ptid");
			$text=mysql_result($result,$i,"page_text");
			if (($i%2) == 1){
				echo "<tr id=\"row".$i."\" style=\"background-color: #B4B4B4;\">";
			} else {
				echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
			}
			echo "<td width=35%>".$page."</td>";
			echo "<td width=55% title=\"".stripslashes($text)."\">".nl2br(stripslashes($text))."...</td>";
			
			//echo "<td><input type=\"button\" value=\"Edit\" onClick=\"getInfo('gallery_galleries',$id);\">";
			//echo "<td><input type=\"button\" value=\"Edit\" onClick=\"showEdit('row".$i."edit')\">&nbsp;";
			echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$i."edit')\">";
			//echo "<input type=\"button\" value=\"Delete\" onClick=\"removePost('gallery_galleries',$id);\"></td>";
			echo "</tr>";
			
				
			
			//THIS IS WHERE THE EDIT DIV GOES -- Gotta be $i+1 because of the damn things.
			putPageTextEditDiv($i, $id, $text);
				//echo "</tr>";
					//	echo "<tr lean=\"shoulda\" id=\"row".$i."imageEdit\" style=\"background-color: #FFFFAA; display:none;\">";
		
			//echo "<td colspan=5 height=325px>";
					//echo "<div id=\"row".$i."imageFull\" style=\"display:none;\" >";
				//putPageImageEditDiv($pageID, $i);
		//	echo "</div></form></td></tr>";
			echo "</form></td></tr>";
			$i++;
		}
 
		echo "</table></div>";
		mysql_free_result($result);
}


function putPageTextEditDiv($ct, $ptid, $text){
	echo "<tr id=\"row".$ct."edit\" style=\"display:none;\">";
		
			echo "<td colspan=4 height=300px>";
	echo "<div id=\"row".$ct."editDiv\" class=\"editDiv\">";
	?>
					<form id="PTEdit<?php echo $ct ?>Form" action="admin_pagetext.php" method="POST">
					<textarea rows=15 cols=45 name="aedit" class="newPostInput" onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>" ><?php echo stripslashes($text) ?></textarea><BR>
					<input type="button" class="newPostInput" value="edit images" onClick="showEdit2('row<?php echo $ct ?>imageFull')">
					<input type="hidden" name="ptid" value="<?php echo $ptid ?>">
					<input type="hidden" name="editPTAttempt" value="true">
					<input type="button" class="newPostInput" value="cancel edit" onClick="hideEdit('row<?php echo $ct ?>edit');">
					<input type="submit" class="newPostInput">
	<?php
		
}




?>
