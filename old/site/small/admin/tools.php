<?php


function displayNewsForm($msg){
	?>
		<html>
		<head>
		<title>News Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen">

	<script src="includes/prototype.js" type="text/javascript"></script>
	<script src="includes/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
	<script src="includes/lightbox.js" type="text/javascript"></script>


		<script language="JavaScript" type="text/JavaScript">
		<!--

		//-->
		</script>

		</head>
		
		<body>
		<div id="centeringDiv">
					<?php include "includes/topNav.php"; ?>
		<?php echo $msg."<BR>"; ?>
			<a href=# onClick="showEdit('addNew')">+ Add new news posting</a>
			<div id="addNew" style="display:none;">
				<form id="newsForm" action="admin_news.php" method="POST" enctype="multipart/form-data">
					title: <input type="text" name="a"><BR>
					text: <textarea rows=15 cols=45 name="b"></textarea>
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
					<input name="userfile" type="file" id="userfile">
					<input type="hidden" name="newsAttempt" value="true">
					<input type="submit" value="show that news, cuz">
			</form>
			<input type="button" value="cancel" onClick="hideEdit('addNew')";>
		</div>
		
<?php
}
function displayNewsAdmin($msg){
		include "includes/dbConnect_old2.php";


		$query="SELECT * FROM news ORDER BY nid DESC";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);

		echo "<b><center>Current News</center></b><br><br>";
		$i=0;
		echo "<table width=797px border=0>";
		echo "<tr style=\"background-color: #FFAAFF;\"><td><b>Thumb</b></td><td><b>Title</b></td><td><b>Text</b></td><td><b>Change</b></td></tr>";
		while ($i < $num) {
		$title=mysql_result($result,$i,"title");
		$id=mysql_result($result,$i,"nid");
		$text=mysql_result($result,$i,"news_text");
		$picLoc=mysql_result($result,$i,"pic_name");
			
		//$query="SELECT * FROM resume_pics where res_id=$id";
		//echo $query;
		$result2=mysql_query($query);
		
		$numpics=mysql_numrows($result2);
			if (($i%2) == 1){
				echo "<tr id=\"row".$i."\" style=\"background-color: #B4B4B4;\">";
			} else {
				echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
			}
			if ($picLoc != ""){
				echo "<td width=120px><a href=\"images/newsUploads/".$picLoc."\" title=\"".$text."\"rel=\"lightbox[newstest]\"><img src=\"images/newsUploads_thumbs/tn_".$picLoc."\"></a><br></a></td>";
			} else {
					echo "<td width=120px>*no image*</td>";
			}
			echo "<td width=200px>".$title."</td>";
			echo "<td width=397px title=\"".$text."\">".substr($text,0,225)."...</td>";
			echo "<td><input type=\"button\" value=\"Edit\" onClick=\"showEdit('row".$i."edit')\">";
			echo "<input type=\"button\" value=\"Delete\" onClick=\"removePost('news',$id);\"></td></tr>";
		
			

			
			//THIS IS WHERE THE EDIT DIV GOES -- Gotta be $i+1 because of the damn things.
			putNewsEditDiv($id, $i);

				
			//THIS IS WHERE THE IMAGE UPLOADING GOES!	
			echo "</tr>";
			$i++;
		}
		echo "</table>";
		mysql_close();
		mysql_free_result($result);
		
}



function putNewsEditDiv($nid, $ct){
	include "includes/dbConnect_old2.php";
	
					echo "<tr id=\"row".$ct."edit\" style=\"background-color: #FFFFAA; display:none;\">";
		
			echo "<td id=\"gangster\" colspan=5 height=300px>";
			
	
				
			$query="SELECT * FROM news where nid=$nid ORDER BY nid DESC";
			echo $query."<BR>";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		mysql_close();
		$i=0;
		
		
			$title=mysql_result($result,$i,"title");
			$text=mysql_result($result,$i,"news_text");
			//$resdesc=mysql_result($result,$i,"description");
			///$cat=mysql_result($result,$i,"res_cid");
			//$showit=mysql_result($result,$i,"showit");
	
	echo "<div id=\"row".$ct."editDiv\">";
	?>
				<form id="newsForm" action="admin_news.php" method="POST" enctype="multipart/form-data">
					title: <input type="text" id="aedit" name="aedit" value="<?php echo $title ?>"><BR>
					text: <textarea rows=15 cols=45 id="bedit" name="bedit"><?php echo $text ?></textarea><BR>
					<?php echo "<input type=\"hidden\" id=\"nidedit\" name=\"nid\" value=\"$nid\">"; ?>
					<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
					<input type="hidden" name="editAttempt" value="true">
					<input name="userfile" type="file" id="userfile"><BR>
					Remove picture? <input type="radio" name="remove" value=1>Yes &nbsp;&nbsp; <input type="radio" name="remove" value=0 checked>No
					<input type="submit" value="edit that news, cuz" ><BR>
					<input type="button" value="close this window" onClick="hideEdit('row<?php echo $ct ?>edit');" >
				</form>
			
		 <!-- from the first line of this function -->
	<?php
		echo "</div></td></tr></tr></tr>";
		mysql_free_result($result);
		
}


?>