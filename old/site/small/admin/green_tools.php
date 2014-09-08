<?php


function displayGreenAdmin($msg){
		include "includes/dbConnect.php";


		$query="SELECT * FROM green_page_pics ORDER BY gpid DESC";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);

		$i=0;
		if ($num != ''){
			echo "<table width=100% cellpadding='5px'>";
			echo "<tr style=\"background-color: #5A0300; color:#ffffff;\"><td><b>Thumb</b></td><td><b>Title</b></td><td><b>Text</b></td><td><b>Change</b></td></tr>";
			while ($i < $num) {
				$title=mysql_result($result,$i,"title");
				$id=mysql_result($result,$i,"gpid");
				$text=mysql_result($result,$i,"text");
				$picLoc=mysql_result($result,$i,"filename");
					
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
						//echo "<td width=120px><a href=\"images/newsUploads/".$picLoc."\" title=\"".$text."\"rel=\"lightbox[newstest]\"><img src=\"images/newsUploads_thumbs/tn_".$picLoc."\"></a><br></a></td>";
						echo "<td width=15%><img src=\"images/green_images_thumbs/tn_".$picLoc."\"></td>";
					} else {
							echo "<td width=5%>none</td>";
					}
					echo "<td width=20%>".$title."</td>";
					echo "<td width=52% title=\"".$text."\">".substr(stripslashes($text),0,300)."...</td>";
					echo "<td width=7%><img src=\"images/edit.png\" onClick=\"showEdit('row".$i."edit')\">&nbsp;<img src=\"images/delete.png\" onClick=\"removePost('green_page_pics',$id);\"></td>";

					putGreenEditDiv($id, $i);
					echo "</tr>";
					$i++;
				}
				echo "</table>";
		} else {
			echo "well you have no green page pictures yet!  Add one!<BR><BR>";
		}
		
	
		
	//	mysql_close();
		//mysql_free_result($result);
		
}



function putGreenEditDiv($gpid, $ct){
	include "includes/dbConnect.php";
	
					echo "<tr id=\"row".$ct."edit\" style=\"background-color: #9c0400; display:none;\">";
		
			echo "<td id=\"gangster\" colspan=5 height=300px>";
			
	
				
			$query="SELECT * FROM green_page_pics where gpid=$gpid ORDER BY gpid DESC";
			//echo $query."<BR>";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		//mysql_close();
		$i=0;
		
		
			$title=mysql_result($result,$i,"title");
			$text=mysql_result($result,$i,"text");
			$picLoc=mysql_result($result,$i,"filename");
			
	echo "<div id=\"row".$ct."editDiv\" class=\"editDiv\">";
	?>
				<form id="newsForm" action="admin_green.php" method="POST" enctype="multipart/form-data">
					Title: <input type="text" class="newPostInput" id="title" name="title" size=60 onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo $title ?>"><BR>
					Text: <textarea class="newPostInput" rows=15 cols=45 onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>" id="text" name="text"><?php echo stripslashes($text) ?></textarea><BR>
					<input type="hidden" name="editAttempt" value="true"><br>
					<input type="hidden" name="rownumber" value=<?php echo $ct ?>>
					<input type="hidden" name="id" value=<?php echo $gpid ?>>
						<?php 
					
							echo "<a href=\"images/green_images/".$picLoc."\" rel=\"lightbox\"><img src=\"images/green_images_thumbs/tn_".$picLoc."\"></a><BR>"; 

						?>
					<input type="submit" class="newPostInput" value="Submit the edit" >
					<input type="button" class="newPostInput" value="close this window" onClick="hideEdit('row<?php echo $ct ?>edit');" >
				</form>
			
		 <!-- from the first line of this function -->
	<?php
		echo "</div></td></tr></tr></tr>";
		//mysql_free_result($result);
		
}

function displayGreenForm($msg){
	?>
		<html>
		<head>
		<title>Green Page Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen">
<script type="text/javascript" src="includes/prototype.js"></script>
<script type="text/javascript" src="includes/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="includes/lightbox.js"></script>



		<script language="JavaScript" type="text/JavaScript">
		<!--

		//-->
		</script>

		</head>
		
		<body>
		<div id="centeringDiv">
					<?php include "includes/topNav.php"; ?>
		
		
<?php


							echo "<div id=\"AdminTable\">";
							displayGreenInside();
							echo "</div>";


}

function displayGreenFormAdd($msg){
	echo "<BR><span style='font-size:13pt'><b><center>Current Page Pictures</center></b></span><br>";
	?>
			<a href=# onClick="addNew('addNew')">+ Add new picture into the green page</a>
			<div id="addNew"  class="newPost">
				<form id="newsForm" action="admin_green.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						<tr>
							<td align="center" width=25%>Title:</td>
							<td width=75%><input class="newPostInput" type="text" name="title"></td>
						</tr>
						<tr>
							<td align="center" width=25%>Text:</td>
							<td width=75%><textarea class="newPostInput" rows=15 cols=45 name="text"></textarea></td>
						</tr>
						<tr>
							<td align="center" width=25%>Image:</td>
							<td width=75%><input class="newPostInput" name="userfile" type="file" id="userfile"></td>
						</tr>
						<tr>
								<td colspan=2 align=center><input class="newPostInput" type="submit" value="Post this"></td>
						</tr>
					</table>
					<input type="hidden" name="createAttempt" value="true">
				</form>
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew')";>
		</div>
		<BR><BR>
<?php



}
function displayGreenInside(){
	echo "<BR><span style='font-size:15pt'><b><center>Current Green Page</center></b></span><br><br>";
	displayGreenFormAdd("");
	displayGreenAdmin("");
	echo "<BR><HR><BR>";
	displayGreenPageText();
}

function displayGreenPageText(){
		$query="SELECT * FROM page_text where `p_id`=4";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
  
		echo "<BR><span style='font-size:13pt'><b><center>Current Page Text</center></b></span><br>";
		$i=0;
		echo "<table width=100% style='border:2px solid #5A0300;' cellpadding='5px'>";
			
		while ($i < $num) {
		
			$text=mysql_result($result,$i,"text");
			$ptid=mysql_result($result,$i,"ptid");
			
			echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
			echo "<td width=90% title=\"".stripslashes($text)."\">".nl2br(stripslashes($text))."...</td>";
			echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$i."textedit')\">";
			echo "</tr>";

			putGreenEditDivText($i, $ptid, $text);

			
			$i++;
		}
 
		echo "</table>"; 
		echo "<HR>";
}

function putGreenEditDivText($ct, $ptid, $text){
	echo "<tr id=\"row".$ct."textedit\" style=\"background-color:#9c0400; display:none;\">";
		
			echo "<td colspan=4 height=300px>";
	echo "<div id=\"row".$ct."editDiv\" class=\"editDiv\">";
	?>
					<form id="PTEditForm" action="admin_green.php" method="POST">
					<textarea rows=15 cols=45 name="aedit" class="newPostInput" onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>" ><?php echo stripslashes($text) ?></textarea><BR>
					<input type="hidden" name="ptid" value="<?php echo $ptid ?>">
					<input type="hidden" name="textedit" value="true">
					<input type="button" class="newPostInput" value="cancel edit" onClick="hideEdit('row<?php echo $ct ?>textedit');">
					<input type="submit" class="newPostInput">
	<?php
	echo "</form></td></tr>";	
}
?>