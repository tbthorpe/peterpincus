<?php


function displayInfoAdmin($msg){
		include "includes/dbConnect.php";


		$query="SELECT * FROM info ORDER BY iid DESC";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		$i=0;
		if ($num != ''){
			echo "<table width=100% cellpadding='5px'>";
			echo "<tr style=\"background-color: #5A0300; color:#ffffff;\"><td><b>Thumb</b></td><td><b>Title</b></td><td><b>Text</b></td><td><b>Change</b></td></tr>";
			while ($i < $num) {
				$title=mysql_result($result,$i,"title");
				$id=mysql_result($result,$i,"iid");
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
						echo "<td width=15%><img src=\"images/info_images_thumbs/tn_".$picLoc."\"></td>";
					} else {
							echo "<td width=20%>none</td>";
					}
					echo "<td width=20%>".$title."</td>";
					echo "<td width=53% title=\"".$text."\">".substr(stripslashes($text),0,100)."...</td>";
					echo "<td width=7%><img src=\"images/edit.png\" onClick=\"showEdit('row".$i."edit')\">&nbsp;<img src=\"images/delete.png\" onClick=\"removePost('info',$id);\"></td>";

					putInfoEditDiv($id, $i);
					echo "</tr>";
					$i++;
				}
				echo "</table>";
		} else {
			echo "well you have no portfolio yet!  Add one!<BR><BR>";
		}
		
	
		
	//	mysql_close();
		//mysql_free_result($result);
		echo "<HR>";
}



function putInfoEditDiv($iid, $ct){
	include "includes/dbConnect.php";
	
		echo "<tr id=\"row".$ct."edit\" style=\"background-color: #9c0400; display:none;\">";
		echo "<td id=\"gangster\" colspan=5 height=300px>";
		$query="SELECT * FROM info where iid=$iid ORDER BY iid DESC";
		$result=mysql_query($query);
		$num=mysql_numrows($result);

		$i=0;
		$title=mysql_result($result,$i,"title");
		$text=mysql_result($result,$i,"text");
		$picLoc=mysql_result($result,$i,"filename");
			
	echo "<div id=\"row".$ct."editDiv\" class=\"editDiv\">";
	?>
				<form id="newsForm" action="admin_info.php" method="POST" enctype="multipart/form-data">
					Title: <input type="text" class="newPostInput" id="title" name="title" size=60 onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo $title ?>"><BR>
					Text: <textarea class="newPostInput" rows=15 cols=45 onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>" id="text" name="text"><?php echo stripslashes($text) ?></textarea><BR>
					<?php echo "<input type=\"hidden\" class=\"newPostInput\" id=\"nidedit\" name=\"nid\" value=\"$nid\">"; ?>
					<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
					<input type="hidden" name="editPicAttempt" value="true"><br>
					<input type="hidden" name="rownumber" value=<?php echo $ct ?>>
					<input type="hidden" name="id" value=<?php echo $iid ?>>
						<?php
							echo "<a href=\"images/portfolio_images/".$picLoc."\" rel=\"lightbox\"><img src=\"images/portfolio_images_thumbs/tn_".$picLoc."\"></a><BR>"; 
						?>
					<input type="submit" class="newPostInput" value="Submit the edit" >
					<input type="button" class="newPostInput" value="close this window" onClick="hideEdit('row<?php echo $ct ?>edit');" >
				</form>
			
		 <!-- from the first line of this function -->
	<?php
		echo "</div></td></tr></tr></tr>";
		//mysql_free_result($result);
		
}

function displayInfoFormAdd($msg){
	echo "<BR><span style='font-size:13pt'><b><center>Current Info Pictures</center></b></span>";
	?>
		
			<a href=# onClick="addNew('addNew')">+ Add new picture into the info section</a>
			<div id="addNew"  class="newPost">
				<form id="newsForm" action="admin_info.php" method="POST" enctype="multipart/form-data">
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
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
					<input type="hidden" name="upPicAttempt" value="true">
				</form>
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew')";>
		</div>
		<BR><BR>
<?php



}

function displayInfoForm($msg){
	?>
		<html>
		<head>
		<title>Info Page Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen">
<script type="text/javascript" src="includes/prototype.js"></script>
<script type="text/javascript" src="includes/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="includes/lightbox.js"></script>
<style type="text/css">
<!--
.sec:link {
	color: #FFFFFF;
}
.sec:visited {
	color: #FFFFFF;
}
.sec:hover {
	color: #FF0000;
}
.sec:active {
	color: #FFFFFF;
}
-->
</style>


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
							showInfoInside();
							echo "</div>";


}

function showInfoInside(){
	echo "<BR><span style='font-size:15pt'><b><center>Current Info Page</center></b></span><BR><BR>";
	displayInfoFormAdd("");
	displayInfoAdmin("");
	echo "<BR>";
	displayBoxFormInfo(1, "pricing");
	//displayDisplayRulesInfo(6,1);
	displayBoxAdminInfo(1, "pricing");
	echo "<BR><HR><BR>";
	displayBoxFormInfo(2, "package");
	//displayDisplayRulesInfo(6,2);
	displayBoxAdminInfo(2, "package");
	echo "<BR><HR><BR>";
	displayBoxFormInfo(3, "new");
	//displayDisplayRulesInfo(6,3);
	displayBoxAdminInfo(3, "new");
}

function displayDisplayRulesInfo($page, $which){
	include "includes/dbConnect.php";
	

		$query="SELECT * FROM sections where `s_pid` = $page AND `s_num`=$which";
		$result=mysql_query($query);
		
		$displays=mysql_result($result,0,"display_rules");
		$id=mysql_result($result,0,"sid");
		
		$title = $displays{0};
		$text = $displays{1};
		$price = $displays{2};
		$link = $displays{3};
		echo "<form id=\"newsForm\" action=\"admin_info.php\" method=\"POST\">";
		echo "<input type=\"hidden\" name=\"id\" value=$id >";
		echo "<input type=\"hidden\" name=\"editRules\" value='true' >";
		echo "Show title: ";
		
		displayDisplayChoice($title, 'title');
		echo "<BR>";
		echo "Show text: ";
		displayDisplayChoice($text, 'text');
		echo "<BR>";
		echo "Show price: ";
		displayDisplayChoice($price, 'price');
		echo "<BR>";
		echo "Show link: ";
		displayDisplayChoice($link, 'link');
		echo "<BR>";
		echo "<input type='submit' value='Submit'>";
		echo "</form>";
}
function displayBoxFormInfo($which, $section){
	$row = $which.$section;
	echo "<BR><span style='font-size:13pt'><b><center>Current $section Box</center></b></span>";
	?>
	<a href=# onClick="addNew('addNew<?php echo $row; ?>')">+ Add new piece into the <?php echo $section ?> section</a>
			<div id="addNew<?php echo $row ?>"  class="newPost">
				<form id="newsForm" action="admin_info.php" method="POST" enctype="multipart/form-data">
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
						<tr>
							<td align="center" width=25%>Quick text:</td>
							<td width=75%><input class="newPostInput" type="text" name="quicktext"></td>
						</tr>
						<tr>		
							<td align="center" width=25%>Link:</td>
							<td width=75%><input class="newPostInput" type="text" name="link"></td>
						</tr>
						<tr>		
							<td align="center" width=25%>Price:</td>
							<td width=75%><input class="newPostInput" type="text" name="price"></td>
						</tr>
						<tr>
							<td align="center" width=25%>Image:</td>
							<td width=75%><input class="newPostInput" name="userfile" type="file" id="userfile"></td>
						</tr>
						<tr>
								<td colspan=2 align=center><input class="newPostInput" type="submit" value="Post this"></td>
						</tr>
					</table>
					<input type="hidden" name="createBoxAttempt" value="true">
					<input type="hidden" name="which" value=<?php echo $which ?>>
				</form>
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew<?php echo $row; ?>')";>
		</div>
		<BR><br>
<?php
}

function putBoxEditDivInfo($ipid, $ct, $which, $section){
	include "includes/dbConnect.php";
	$row = $ct.$which.$section;
	echo "<tr id=\"row".$row."edit\" style=\"background-color: #9c0400; display:none;\">";
	echo "<td id=\"gangster\" colspan=5 height=300px>";
	$query="SELECT * FROM info_page where ipid=$ipid";
	
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	$i=0;
	$title=mysql_result($result,$i,"title");
	$text=mysql_result($result,$i,"text");
	$price=mysql_result($result,$i,"price");
	$quicktext=mysql_result($result,$i,"quicktext");
	$link=mysql_result($result,$i,"link");
	$picLoc=mysql_result($result,$i,"filename");
	$row = $ct.$which.$section;
	echo "<div id=\"row".$ct.$which.$section."editDiv\" class=\"editDiv\">";
	?>
				<form id="newsForm" action="admin_info.php" method="POST">
					Title: <input type="text" class="newPostInput" id="title" name="title" size=60 onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo $title ?>"><BR>
					Quick text: <input type="text" class="newPostInput" id="quicktext" name="quicktext" size=60 onKeyUp="doOnChange(this);" oVal="<?php echo $quicktext ?>" value="<?php echo $quicktext ?>"><BR>
					Text: <textarea class="newPostInput" rows=15 cols=45 onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>" id="text" name="text"><?php echo stripslashes($text) ?></textarea><BR>
					Price: $<input type="text" class="newPostInput" id="price" name="price" size=60 onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo $price ?>"><BR>
					<?php
						if ($link != ''){
							echo "Try this: <a class='sec' href=\"".$link."\">".$link."</a>";
						}
					?>
					
					Link: <input class="newPostInput" type="text" name="link" value="<?php echo $link ?>" onKeyUp="doOnChange(this);" oVal="<?php echo $link ?>"<BR><BR>
					<?php
						if ($picLoc != ""){
							echo "<a href=\"images/info_images/".$picLoc."\" rel=\"lightbox\"><img src=\"images/info_images_thumbs/tn_".$picLoc."\"></a><BR><BR>"; 
						}
						?>
					<?php echo "<input type=\"hidden\" class=\"newPostInput\" id=\"nidedit\" name=\"nid\" value=\"$nid\">"; ?>
					<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
					<input type="hidden" name="editBoxAttempt" value="true"><br>
					<input type="hidden" name="rownumber" value=<?php echo $ct ?>>
					<input type="hidden" name="which" value=<?php echo $which ?>>
					<input type="hidden" name="id" value=<?php echo $ipid ?>>
						
					<input type="submit" class="newPostInput" value="Submit the edit" >
					<input type="button" class="newPostInput" value="close this window" onClick="hideEdit('row<?php echo $row ?>edit');" >
				</form>
			
		 <!-- from the first line of this function -->
	<?php
		echo "</div></td></tr></tr></tr>";
		//mysql_free_result($result);
		
}

function displayBoxAdminInfo($which, $section){
		include "includes/dbConnect.php";
		$query="SELECT * FROM info_page where `which`=$which ORDER BY ipid DESC";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		//echo "<HR><BR><b><center>Current $section Box</center></b><br>";
		$i=0;
		if ($num != ''){
			echo "<table width=100% cellpadding='5px'>";
			echo "<tr style=\"background-color: #5A0300; color=#ffffff;\" cellpadding='5px'><td><b>Title</b></td><td><b>Text</b></td><td><b>Price</b></td><td><b>Change</b></td></tr>";
			while ($i < $num) {
				$title=mysql_result($result,$i,"title");
				$id=mysql_result($result,$i,"ipid");
				$text=mysql_result($result,$i,"text");
				$quicktext=mysql_result($result,$i,"quicktext");
				$price=mysql_result($result,$i,"price");

				$result2=mysql_query($query);
				
				$numpics=mysql_numrows($result2);
					if (($i%2) == 1){
						echo "<tr id=\"row".$i."\" style=\"background-color: #B4B4B4;\">";
					} else {
						echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
					}

					echo "<td width=35%>".$title."</td>";
					echo "<td width=50% title=\"".$quicktext."\">".$quicktext."...</td>";
					echo "<td width=8%>".$price."</td>";
					echo "<td width=7%><img src=\"images/edit.png\" onClick=\"showEdit('row".$i.$which.$section."edit')\">&nbsp;<img src=\"images/delete.png\" onClick=\"removePost('info_page',$id);\"></td>";

					putBoxEditDivInfo($id, $i, $which, $section);
					echo "</tr>";
					$i++;
				}
				echo "</table>";
		} else {
			echo "well you have no info yet!  Add one!<BR><BR>";
		}
		
	
		
	//	mysql_close();
		//mysql_free_result($result);
		
}
?>