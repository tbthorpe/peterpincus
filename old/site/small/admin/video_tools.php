<?php

	include "includes/dbConnect.php";



function displayVideoAdmin($msg){
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
	var url = "update_video_order.php"; // url to update_navigation.php
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
		

		putVideoInside();
		echo "</div>";
		
}
function putVideoInside(){
				//--------- ABOUT US --------------
		$query="SELECT * FROM talla_vids ORDER BY `order` DESC";
		$result2=mysql_query($query);
		$num=mysql_numrows($result2);
  
		echo "<BR><span style='font-size:15pt'><b><center>Current Videos</center></b></span><br><br>";
		displayVideoForm();
		$i=0;
		echo "<table width=100% border=0 cellpadding=5px style='border: 2px solid #5A0300;'><tr><td>";
		echo "<div id=\"fulllist\">\n";
			
		while ($data = mysql_fetch_assoc($result2)) {
			echo "<div id=\"item_".$data['vid']."\" style=\"background-color: #E1E1E1;\">";
				echo "<table width=100%><tr><td width=40%>".nl2br(stripslashes($data['title']))."...</td>";
				echo "<td width=50%>".html_entity_decode(stripslashes($data['code']))."</td>";
				echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$data['vid']."edit')\">&nbsp;&nbsp;&nbsp;<a onclick=\"removeItem('talla_vids',".$data['vid'].")\">X</a></td></tr>";
			

			putVideoEditDivAU($i, $data['vid'], $data['title'], $data['code']);
			echo "</table></div>";
			$i++;
		}
 
		echo "</div></td></tr></table>"; 
	echo "<BR>";
		
		
}

function putVideoEditDivAU($ct, $id, $title, $code){
	echo "<tr id=\"row".$id."edit\" style=\"display:none;\">";
		//echo "magic quotes" . get_magic_quotes_gpc();  
			echo "<td colspan=4 height=300px>";
	echo "<div id=\"row".$id."editDiv\" class=\"editDiv\">";
	?>
					<form id="PTEditForm" action="admin_video.php" method="POST" enctype="multipart/form-data">
						<input type="text" name="title" onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo stripslashes($title) ?>"><BR>
					<textarea rows=15 cols=45 name="code" class="newPostInput" onKeyUp="doOnChange(this);" oVal="<?php echo html_entity_decode(stripslashes($code)) ?>" ><?php echo html_entity_decode($code) ?></textarea><BR>
					
					<input type="hidden" name="vid" value="<?php echo $id ?>">
					<input type="hidden" name="edit" value="true">
					<input type="button" class="newPostInput" value="cancel edit" onClick="hideEdit('row<?php echo $id ?>edit');">
					<input type="submit" class="newPostInput">
	<?php
	echo "</form></td></tr>";	
}

function displayVideoForm(){

		
	?>
			<a href=# onClick="addNew('addNew')">+ Add video</a>
			<div id="addNew"  class="newPost">
				<form id="newsForm" action="admin_video.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						<tr>
							<td width=22% align="right" width=42%>Title:&nbsp;&nbsp;</td>
							<td width=78%><input class="newPostInput" type="title" name="title"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Video embedding code:&nbsp;&nbsp;</td>
							<td width=78%><textarea rows=15 cols=45 name="code" class="newPostInput" ></textarea></td>
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
?>

