<?php

	include "includes/dbConnect.php";



function displayAlbumAdmin($msg){
		include "includes/dbConnect.php";
			?>
		<html>
		<head>
		<title>Home Page Administration - News</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	
<script src="../scriptac/prototype.js" type="text/javascript"></script>
<script src="../scriptac/scriptaculous.js" type="text/javascript"></script>


		<script language="JavaScript" type="text/JavaScript">
	<!--
window.onload = siteInitialize; 
function siteInitialize() {
	Sortable.create('fulllist',{tag: 'div', constraint: false, onUpdate:updateList});
}
function removeItem(table, id){
	var answer = confirm("Really delete the entry?");
	if (answer){
		var url = "includes/delete.php"; // url to update_navigation.php
		var updateNavigation = new Ajax.Request(
			url,
			{
				method: 'get',
				parameters: "table="+table+"&id="+id,
				onComplete: updateAfterDeleting

			});
	return true;
	}	
}
function updateAfterDeleting(originalRequest) {
	//alert(originalRequest.responseText);
	$('AdminTable').innerHTML = originalRequest.responseText;
}
function updateList() {
	var url = "update_news.php"; // url to update_navigation.php
	var sorted = escape(Sortable.sequence('fulllist'));
	var updateNavigation = new Ajax.Request(
			url,
			{
				method: 'get',
				parameters: "order_num=" + sorted,
				onComplete: showUpdate

			});
	return true;
}

function showUpdate(originalRequest) {
	//alert(originalRequest.responseText);
}
-->
		</script>
<style>
	#fulllist {
  padding:0;
  margin:0;
  }
#fulllist li {
  list-style-type:none;
  }
	</style>
		</head>
		
		<body>
		<div id="centeringDiv">
			<?php include "includes/topNav.php";
		echo "<div id=\"AdminTable\">";
		

		putAlbumInside();
		echo "</div>";
		
}
function putAlbumInside(){
				//--------- ABOUT US --------------
		$query="SELECT * FROM talla_discog ORDER BY aid DESC";
		$result2=mysql_query($query);
		$num=mysql_numrows($result2);
  
		echo "<BR><span style='font-size:15pt'><b><center>Albums</center></b></span><br><br>";
		displayAlbumForm();
		$i=0;
		echo "<table width=100% border=0 cellpadding=5px style='border: 2px solid #5A0300;'><tr><td>";
		echo "<div id=\"fulllist\">\n";
			
		while ($data = mysql_fetch_assoc($result2)) {
			echo "<div id=\"item_".$data['aid']."\" style=\"background-color: #E1E1E1;\">";
				echo "<table width=100%><tr><td width=40%>".nl2br(stripslashes($data['title']))."...</td>";
				echo "<td width=50%>".nl2br(stripslashes($data['release']))."</td>";
				echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$data['aid']."edit')\">&nbsp;&nbsp;&nbsp;<a onclick=\"removeItem('talla_discog',".$data['aid'].")\">X</a></td></tr>";
			

			putAlbumEditDivAU($i, $data['aid'], $data['title'], $data['release'], $data['tracks'], $data['filename'], $data['other']);
			echo "</table></div>";
			$i++;
		}
 
		echo "</div></td></tr></table>"; 
	echo "<BR>";
		
		
}

function putAlbumEditDivAU($ct, $id, $title, $release, $tracks, $filename, $other){
	echo "<tr id=\"row".$id."edit\" style=\"display:none;\">";
		//echo "magic quotes" . get_magic_quotes_gpc();  
			echo "<td colspan=4 height=300px>";
	echo "<div id=\"row".$id."editDiv\" class=\"editDiv\">";
	?>
					<form id="PTEditForm" action="admin_albums.php" method="POST" enctype="multipart/form-data">
						<input type="text" name="title" onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo stripslashes($title) ?>"><BR>
						<input type="text" name="release" onKeyUp="doOnChange(this);" oVal="<?php echo $release ?>" value="<?php echo stripslashes($release) ?>"><BR>
					<textarea rows=15 cols=45 name="tracks" class="newPostInput" onKeyUp="doOnChange(this);" oVal="<?php echo $tracks ?>" ><?php echo str_replace("<br />","",nl2br(stripslashes($tracks))) ?></textarea><BR>
					<textarea rows=15 cols=45 name="other" class="newPostInput" onKeyUp="doOnChange(this);" oVal="<?php echo $other ?>" ><?php echo str_replace("<br />","",nl2br(stripslashes($other))) ?></textarea><BR>
					<?php 
						if ($filename != "noneski"){
							echo "<img src=\"images/album_images/".$filename."\"></a><BR>"; 
							echo "Change this picture<BR>";
							echo "<input name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						} else {
							echo "Add a picture below<BR>";
							echo "<input name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						}
						?>
					<input type="hidden" name="aid" value="<?php echo $id ?>">
					<input type="hidden" name="edit" value="true">
					<input type="button" class="newPostInput" value="cancel edit" onClick="hideEdit('row<?php echo $id ?>edit');">
					<input type="submit" class="newPostInput">
	<?php
	echo "</form></td></tr>";	
}

function displayAlbumForm(){

		
	?>
			<a href=# onClick="addNew('addNew')">+ Add album</a>
			<div id="addNew"  class="newPost">
				<form id="newsForm" action="admin_albums.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						<tr>
							<td width=22% align="right" width=42%>Title:&nbsp;&nbsp;</td>
							<td width=78%><input class="newPostInput" type="title" name="title"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Release Date:&nbsp;&nbsp;</td>
							<td width=78%><input class="newPostInput" type="text" name="release"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Tracks:&nbsp;&nbsp;</td>
							<td width=78%><textarea rows=15 cols=45 name="tracks" class="newPostInput" ></textarea></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Tracks:&nbsp;&nbsp;</td>
							<td width=78%><textarea rows=15 cols=45 name="other" class="newPostInput" ></textarea></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Cover:&nbsp;&nbsp;</td>
							<td width=78%><input name="userfile" type="file" id="userfile"></td>
						</tr>
						<tr>
								<td colspan=2 align=center><input class="newPostInput" type="submit" value="Post this"></td>
						</tr>
					</table>
					<input type="hidden" name="add" value="true">
				</form>
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew')";>
		</div>
		
<?php
echo "<BR><br><br>";
//displayDisplayRules(1,$which);
//displayNewsAdmin($section, $which);

}







function putAlbumEditDiv($nid, $ct, $which){
	include "includes/dbConnect.php";
	
			echo "<tr id=\"".$which."row".$ct."edit\" style=\"background-color: #9C0400; display:none;\">";
			echo "<td id=\"gangster\" colspan=5 height=150px>";
			$query="SELECT * FROM news where nid=$nid and `section`=$which ORDER BY nid DESC";
			//echo $query."<BR>";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		mysql_close();
		$i=0;
		
		
			$title=mysql_result($result,$i,"title");
			$link=mysql_result($result,$i,"link");
			$linktext=mysql_result($result,$i,"linktext");
	
	echo "<div id=\"row".$ct."editDiv\" class=\"editDiv\">";
	?>
				<form id="newsForm" action="admin_homepage.php" method="POST">
					Title: <input type="text" class="newPostInput" id="aedit" name="aedit" size=60 onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo $title ?>"><BR>
					<?php
						if ($link != ''){
							echo "Try this: <a href=\"".$link."\">".$link."</a><BR>";
						}
					?>
					Link text: <input class="newPostInput" size=60 type="text" name="linktext" value="<?php echo $linktext ?>" onKeyUp="doOnChange(this);" oVal="<?php echo $linktext ?>"<BR>
					Link: <input class="newPostInput" type="text" name="link" value="<?php echo $link ?>" onKeyUp="doOnChange(this);" oVal="<?php echo $link ?>"<BR>
					<?php echo "<input type=\"hidden\" class=\"newPostInput\" id=\"nidedit\" name=\"nid\" value=\"$nid\">"; ?>
					<input type="hidden" name="editNews" value="true"><br>
					<input type="hidden" name="rownumber" value=<?php echo $ct ?>>
					<input type="hidden" name="which" value=<?php echo $which ?>>
					<input type="submit" class="newPostInput" value="Submit the edit" >
					<input type="button" class="newPostInput" value="close this window" onClick="hideEdit('<?php echo $which ?>row<?php echo $ct ?>edit');" >
				</form>
			
		 <!-- from the first line of this function -->
	<?php
		echo "</div></td></tr></tr></tr>";
		mysql_free_result($result);
		
}
?>

