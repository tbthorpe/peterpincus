<?php

	include "includes/dbConnect_old2.php";

function displayGalForm($msg){
	?>
		<html>
		<head>
		<title>Gallery Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	
	<script src="includes/prototype3.js" type="text/javascript"></script>
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
		<a href=# onClick="addNew('addNew')">+ Add new gallery</a>
		<div id="addNew"  class="newPost">
				<form id="galForm" action="admin_gallery.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						<tr>
							<td align="center" width=25%>Title:</td>
							<td width=75%><input class="newPostInput" type="text" id="title" name="title"></td>
						</tr>
						<tr>
							<td align="center" width=25%>Description:</td>
							<td width=75%><textarea class="newPostInput" rows=15 cols=45 name="text"></textarea></td>
						</tr>
						<tr>
							<td align="center" width=25%>First Picture:</td>
							<td width=75%><input class="newPostInput" name="userfile" type="file" id="userfile"></td>
						</tr>
						<tr>
							<td align="center" colspan=2><input class="newPostInput" type="submit" value="Add Picture"></td>
						</tr>
					</table>
		<input type="hidden" name="uploadAttempt" value="true">
		<input type="hidden" name="MAX_FILE_SIZE" value="104857600">
			</form>
			
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew')";>
		</div>
<?php
}




function displayGalAdmin($msg){
		include "includes/dbConnect_old2.php";

	//$query="SELECT * FROM `photo_gallery` g JOIN `gallery_pics` p on g.`pid`=p.`gal_id` order by p.`pid` DESC";
	$query = "select fj_photo_gallery.pid as galpid, fj_photo_gallery.filename as galfilename, fj_photo_gallery.title as galtitle, fj_photo_gallery.text as galtext, fj_gallery_pics.pid as ppid, fj_gallery_pics.filename as pfilename from fj_photo_gallery,fj_gallery_pics where fj_photo_gallery.thumb_pid = fj_gallery_pics.pid;";
// echo "<BR><BR>".$query;
 //$query = "SELECT *, (SELECT count(*) from gallery_pics where gal_id=gid) as ct FROM gallery_galleries left join gallery_pics on thumb_pid = pid ORDER BY gid DESC;";
		$result=mysql_query($query);
		//$info = mysql_fetch_array( $result ); 
		//var_dump($info);
		$num=mysql_numrows($result);


		
  
		
		echo "<b><center>Current Photo List</center></b><br><br>";
		$i=0;
		$x = 0;
		
			
	//	$query2="SELECT * FROM gallery_pics where pid=133";
	//	echo $query2;
	//	$second=mysql_query($query2);
		//$filename=mysql_result($second,$x,"filename");
	//	echo mysql_result($second,0);
		echo "<table width=100%>";
		echo "<tr style=\"background-color: #ffffff;\"><td><b>Thumb</b></td><td><b>Title</b></td><td><b>Text</b></td><td><b>Change</b></td></tr>";
		while ($i < $num) {
		//while ($row = mysql_fetch_assoc($result)){
			
			$title=mysql_result($result,$i,"galtitle");
			$id=mysql_result($result,$i,"galpid");
			$text=mysql_result($result,$i,"galtext");
			$filename=mysql_result($result,$i,"galfilename");
			
			$ppid=mysql_result($result,$i,"ppid");
			$pfilename=mysql_result($result,$i,"pfilename");
			

			if (($i%2) == 1){
				echo "<tr id=\"row".$i."\" style=\"background-color: #B4B4B4;\">";
			} else {
				echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
			}
			if ($filename != ''){
				//echo "<td width=120px><a href=\"images/newsUploads/".$picLoc."\" title=\"".$text."\"rel=\"lightbox[newstest]\"><img src=\"images/newsUploads_thumbs/tn_".$picLoc."\"></a><br></a></td>";
				echo "<td width=15%><img src=\"images/gallery/".$id."_thumbs/tn_".$pfilename."\"></td>";
			} else {
					echo "<td width=15% onClick=\"showEdit('row".$i."imageEdit')\">none</td>";
			}
			//echo "<td width=120px><a href=\"images/gallery/".$id."/".$filename."\" rel=\"lightbox\"><img src=\"images/gallery/".$id."_thumbs/tn_".$filename."\"></a></td>";
			echo "<td width=30%>".$title."</td>";
			echo "<td width=45% title=\"".$text."\">".substr($text,0,225)."...</td>";

			echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$i."edit')\">&nbsp;";
			echo "<img src=\"images/delete.gif\" onClick=\"removePost('fj_photo_gallery',$id);\"></td></tr>";
		
			

								echo "<tr id=\"row".$i."edit\" style=\" display:none;\">";
		
			echo "<td id=\"gangster\" colspan=5 height=300px>";
			//THIS IS WHERE THE EDIT DIV GOES -- Gotta be $i+1 because of the damn things.
			putGalEditDiv($id, $i);

				
			//THIS IS WHERE THE IMAGE UPLOADING GOES!	
			//echo "</tr>";
				//echo "<BR>ID: ".$id.", CT: ".$i."<BR>";
			//	echo "<tr lean=\"shoulda\" id=\"row".$i."imageEdit\" style=\"background-color: #FFFFAA; display:none;\">";
		
		//	echo "<td colspan=5 height=325px>";
		echo "<fieldset class=\"borderless\" id=\"row".$id."imageList\" style=\"display:block;\">";
			putGalImageEditDiv($id, $i, -1);
			echo "</fieldset></form>";
			echo "</td></tr>";
			//echo "</tr>";
			
			$i++;
		}
 
		echo "</table>";
		mysql_free_result($result);
}



function putGalEditDiv($pid, $ct){
	include "includes/dbConnect_old2.php";
	$query="SELECT * FROM `fj_photo_gallery` where `pid`=$pid";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
		
		mysql_close();
		$i=0;
		
		
			$title=mysql_result($result,$i,"title");
			$pid=mysql_result($result,$i,"pid");
			$text=mysql_result($result,$i,"text");
			$cat=mysql_result($result,$i,"category");
	
	?>
					<form id="galEdit<?php echo $ct ?>Form" action="admin_gallery.php" method="POST" enctype="multipart/form-data">
						<?php
						echo "<fieldset style=\"border: 0px;\" class=\"editDiv\" id=\"row".$pid."editDiv\">";
						?>
					
					Title: <input type="text" class="newPostInput" id="title" name="title" onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo $title ?>"><BR>
					Description: <textarea class="newPostInput" rows=15 cols=45 name="text" onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>" ><?php echo $text ?></textarea><BR>
					<input type="hidden" name="pid" value=<?php echo $pid ?>>
					<input type="hidden" name="editGalAttempt" value="true">
					<input type="hidden" name="MAX_FILE_SIZE" value="104857600">
					<input type="hidden" name="rownumber" value=<?php echo $ct ?>>
					<input type="button" class="newPostInput" value="edit images" onClick="showEdit('row<?php echo $ct ?>imageEdit');">
					<input type="button" class="newPostInput" value="close this window" onClick="hideEdit('row<?php echo $ct ?>edit');" >
					<input type="submit" class="newPostInput" value="Edit this picture">
			
		 <!-- from the first line of this function -->
	<?php
		//echo "</div></td></tr></tr></tr>";
		echo "</fieldset>";
		mysql_free_result($result);
		
}

function showCategories($c){
	switch ($c){
		case 1:
			echo "<SELECT name='category'><option value=1 SELECTED>Gallery</option><option value=2>Fashion</option><option value=3>Wedding</option></SELECT>";
			break;
		case 2:
			echo "<SELECT name='category'><option value=1>Gallery</option><option value=2 SELECTED>Fashion</option><option value=3>Wedding</option></SELECT>";
			break;
		case 3:
			echo "<SELECT name='category'><option value=1>Gallery</option><option value=2>Fashion</option><option value=3 SELECTED>Wedding</option></SELECT>";
			break;
		default:
			break;
	}		
}
?>
