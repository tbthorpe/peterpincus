<?php

	include "includes/dbConnect.php";



function displayHomePageAdmin($msg){
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
		

		putHomepageInside();
		echo "</div>";
		
}
function putHomepageInside(){
				//--------- ABOUT US --------------
		$query="SELECT * FROM mcdc_news ORDER BY order_num DESC";
		$result2=mysql_query($query);
		$num=mysql_numrows($result2);
  
		echo "<BR><span style='font-size:15pt'><b><center>Current News</center></b></span><br><br>";
		displayNewsForm();
		$i=0;
		echo "<table width=100% border=0 cellpadding=5px style='border: 2px solid #5A0300;'><tr><td>";
		echo "<div id=\"fulllist\">\n";
			
		while ($data = mysql_fetch_assoc($result2)) {
			echo "<div id=\"item_".$data['nid']."\" style=\"background-color: #E1E1E1;\">";
				echo "<table width=100%><tr><td width=40%>".nl2br(stripslashes($data['title']))."...</td>";
				echo "<td width=50%>".nl2br(stripslashes($data['text']))."</td>";
				echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$data['nid']."edit')\">&nbsp;&nbsp;&nbsp;<a onclick=\"removeItem('mcdc_news',".$data['nid'].")\">X</a></td></tr>";
			

			putHomePageEditDivAU($i, $data['nid'], $data['text'], $data['filename'], $data['title']);
			echo "</table></div>";
			$i++;
		}
 
		echo "</div></td></tr></table>"; 
	echo "<BR>";
		
		
}

function putHomePageEditDivAU($ct, $id, $text, $filename, $title){
	echo "<tr id=\"row".$id."edit\" style=\"display:none;\">";
		//echo "magic quotes" . get_magic_quotes_gpc();  
			echo "<td colspan=4 height=300px>";
	echo "<div id=\"row".$id."editDiv\" class=\"editDiv\">";
	?>
					<form id="PTEditForm" action="admin_homepage.php" method="POST" enctype="multipart/form-data">
						<input type="text" name="title" onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo stripslashes($title) ?>"><BR>
					<textarea rows=15 cols=45 name="text" class="newPostInput" onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>" ><?php echo str_replace("<br />","",nl2br(stripslashes($text))) ?></textarea><BR>
					<?php 
						if ($filename != "noneski"){
							echo "<a href=\"images/news_images/".$filename."\" rel=\"lightbox[newstest]\"><img src=\"images/news_images_thumbs/tn_".$filename."\"></a><BR>"; 
							echo "Change this picture<BR>";
							echo "<input name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						} else {
							echo "Add a picture below<BR>";
							echo "<input name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						}
						?>
					<input type="hidden" name="nid" value="<?php echo $id ?>">
					<input type="hidden" name="edit" value="true">
					<input type="button" class="newPostInput" value="cancel edit" onClick="hideEdit('row<?php echo $id ?>edit');">
					<input type="submit" class="newPostInput">
	<?php
	echo "</form></td></tr>";	
}

function displayNewsForm(){

		
	?>
			<a href=# onClick="addNew('addNew')">+ Add new  news posting</a>
			<div id="addNew"  class="newPost">
				<form id="newsForm" action="admin_homepage.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						<tr>
							<td width=22% align="right" width=42%>Title:&nbsp;&nbsp;</td>
							<td width=78%><input class="newPostInput" type="title" name="title"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Text:&nbsp;&nbsp;</td>
							<td width=78%><textarea rows=15 cols=45 name="text" class="newPostInput" ></textarea></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Picture:&nbsp;&nbsp;</td>
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



function displayNewsAdmin($section, $which){
			include "includes/dbConnect.php";

		$query="SELECT *, DATE_FORMAT(add_date, '%M %e, %Y') as d FROM news where `section` = $which ORDER BY nid DESC ";
		//echo $query;
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
	
		
	//	echo "<BR><b><center>Current ".$section." News</center></b><br>";
		$i=0;
		if ($num != ''){
			echo "<table width=100% cellpadding='5px'>";
			echo "<tr style=\"background-color: #5A0300; color: #ffffff;\"><td><b>Title</b></td><td><b>Link</b></td><td><b>Change</b></td></tr>";
			while ($i < $num) {
				$title=mysql_result($result,$i,"title");
				$id=mysql_result($result,$i,"nid");
				$link=mysql_result($result,$i,"link");
					$date=mysql_result($result,$i,"d");

					if (($i%2) == 1){
						echo "<tr id=\"row".$i."\" style=\"background-color: #B4B4B4;\">";
					} else {
						echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
					}
					
						
				
					echo "<td width=35%>".$title."</td>";
					echo "<td width=58% title=\"".$link."\">".$link."...</td>";
					echo "<td width=7%><img src=\"images/edit.png\" onClick=\"showEdit('".$which."row".$i."edit')\">&nbsp;<img src=\"images/delete.png\" onClick=\"removePost('news',$id);\"></td>";

					putNewsEditDiv($id, $i, $which);
					echo "</tr>";
					$i++;
				}
				echo "</table>";
		} else {
			echo "well you have no news yet!  Add one!<BR><BR>";
		}
}



function putNewsEditDiv($nid, $ct, $which){
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

