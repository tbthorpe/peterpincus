<?php

	include "includes/dbConnect.php";



function displayLinkAdmin($msg){
		include "includes/dbConnect.php";
			?>
		<html>
		<head>
		<title>Home Page Administration - Links</title>
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
	//Sortable.create('fulllist',{tag: 'div', constraint: false, onUpdate:updateList});
}

function updateList() {
	var url = "update_gallery_order.php"; // url to update_navigation.php
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
function updateList(id, cat, lid) {
	var url = "update_link_order.php"; // url to update_navigation.php
	var sorted = escape(Sortable.sequence(id));
	var updateNavigation = new Ajax.Request(
			url,
			{
				method: 'get',
				parameters: "lid="+lid+"&cat=" + cat + "&order_num=" + sorted,
				onComplete: showUpdate

			});
	return true;
}

function showUpdate(originalRequest) {
	//alert(originalRequest.responseText);
}
function updateAfterDeleting(originalRequest) {
	//alert(originalRequest.responseText);
	$('AdminTable').innerHTML = originalRequest.responseText;
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
		

		putLinkInside();
		echo "</div>";
		
}
function putLinkInside(){
				echo "<BR><span style='font-size:15pt'><b><center>Current Links</center></b></span><br><br>";
			displayLinkForm();
			$a=0;
			echo "<table width=100% border=0 cellpadding=5px style='border: 2px solid #5A0300;'><tr><td>";

	include "includes/dbConnect.php";
	
	for ($i=1; $i <= 5; $i++){
//echo "NUM:".$i."<BR>";
		include "includes/dbConnect.php";
			$query="SELECT * FROM dd_links inner join dd_links_categories on category=lcid where category=$i ORDER BY order_num DESC";
		//	echo $query."<BR>";
			$result=mysql_query($query);
			$num2=mysql_numrows($result);
			
			switch ($i){
				case 1:
						echo "Photographers<BR>";
						break;
				case 2:
						echo "Models<BR>";
						break;
				case 3:
						echo "Shopping<BR>";
						break;
				case 4:
						echo "Magazines<BR>";
						break;
				case 5:
						echo "Misc<BR>";
						break;
				default:
						break;
			}
			
			if ($num2 != ''){
				//echo "NAME: ".mysql_result($result,0,'name');
				echo "<div id=\"fulllist_".$i."\">\n";
					
						while ($data = mysql_fetch_assoc($result)) {
							echo "<div id=\"item_".$data['lid']."\" style=\"background-color: #E1E1E1;\">";
								echo "<table width=100%><tr>";
								if ($data['filename'] != ""){
										echo "<td width=40%><img src=\"images/gallery_images/".$data['filename']."\"></td>";
								}else {
										echo "<td width=40%>".nl2br(stripslashes($data['l_text']))."</td>";
								}
								echo "<td width=40%>".nl2br(stripslashes($data['url']))."...</td>";
								echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$data['lid']."edit')\">&nbsp;&nbsp;&nbsp
									<a onclick=\"removeItem('dd_links',".$data['lid'].")\">X</a></td></tr>";
							
				
							putLinkEditDivAU($i, $data['lid'], $data['l_text'], $data['filename'], $data['url'], $data['category']);
							echo "</table></div>";
							$id = $data['lid'];
						}
						echo "</div>";
						?>
						<script>
						Sortable.create('fulllist_'+<?php echo $i ?>,{overlap: 'vertical', tag: 'div', constraint: false, onUpdate:
							function() { updateList('fulllist_'+<?php echo $i ?>,<?php echo $i ?>,<?php echo $id ?> )}
							});	
					</script>
						<?php
					}
	}
	echo "</div></td></tr></table>"; 
			echo "<BR>";	
}

function putLinkEditDivAU($ct, $id, $text, $filename, $url, $cat){
	echo "<tr id=\"row".$id."edit\" style=\"display:none;\">";
		
			echo "<td colspan=4 height=300px align=center>";
	echo "<div id=\"row".$id."editDiv\" class=\"editDiv\">";
	?>
					<form id="linkForm<?php echo $id ?>" action="admin_link.php" method="POST" enctype="multipart/form-data">
					Category: <?php showLinksCategories("edit", $cat); ?> <BR>
					Text: <input class="newPostInput" type="text" name="text" size=65 value="<?php echo $text ?>" onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>"><BR>
						<?php
						if ($url != ''){
							echo "<BR>Try this: <a target='_blank' href=\"".$url."\">".$url."</a><BR>";
						}
					?>
					
					Link: <input class="newPostInput" type="text" size=65 name="link" value="<?php echo $url ?>" onKeyUp="doOnChange(this);" oVal="<?php echo $url ?>"<BR><BR>
					<?php echo "<input type=\"hidden\" id=\"cidedit\" name=\"lid\" value=\"$id\">"; ?>
					<input type="hidden" name="edit" value="true">
					<input type="hidden" name="rownumber" value="<?php echo $ct ?>">
					
					<?php 
						if ($filename != ""){
							echo "<img src=\"images/links_images/".$filename."\"><BR>"; 
							?>
								Remove picture? <input class="newPostInput" type="radio" name="remove" value=1>Yes &nbsp;&nbsp; <input type="radio" name="remove" value=0 checked>No<BR><BR>
							<?php
						} else {
							echo "Add a picture below<BR>";
							echo "<input class=\"newPostInput\" name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						}
						?>
					<input type="submit" class="newPostInput" value="Edit Link" ><BR>
					<input type="button" class="newPostInput" value="close this window" onClick="hideEdit('row<?php echo $ct ?>edit');" >
				</form>
	<?php
	echo "</form></td></tr>";	
}

function displayLinkForm(){

		
	?>
			<a href=# onClick="addNew('addNew')">+ Add new Link</a>
			<div id="addNew"  class="newPost">
				<form id="linkForm" action="admin_link.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						<tr>
							<td align="center" width=25%>Category:</td>
							<td width=75%><?php showLinksCategories("",-1); ?></td>
						</tr>
						<tr>
							<td align="center" width=25%>Text:</td>
							<td width=75%><input class="newPostInput" type="text" name="text"></td>
						</tr>
						<tr>		
							<td align="center" width=25%>Link:</td>
							<td width=75%><input class="newPostInput" type="text" name="link"></td>
						</tr>
						<tr>
							<td align="center" width=25%>Image:</td>
							<td width=75%><input class="newPostInput" name="userfile" type="file" id="userfile"></td>
						</tr>
						<tr>
							<td colspan=2 align=center><input class="newPostInput" type="submit" value="Add link"></td>
						</tr>
					</table>
					<input type="hidden" name="add" value="true">
				</form>
				</form>
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew')";>
		</div>
		
<?php
echo "<BR><br><br>";
//displayDisplayRules(1,$which);
//displayNewsAdmin($section, $which);

}

function showLinksCategories($e, $cat){
	include "includes/dbConnect.php";
	
	
	//THIS NEXT LINE IS ALL THAT NEEDS TO CHANGE FOR ANY CATEGORIES ON ANY PAGE!  ONE FUNCTION!
	
	
			$query="SELECT * FROM dd_links_categories ORDER BY lcid ASC";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		mysql_close();
		$i=0;
		//	echo "E: ".$e.", CAT: ".$cat."<BR>";
		echo "<SELECT class=\"newPostInput\" NAME =\"category\">";
		//Set if $e == "edit" to try to do something.
	
		if ($e == "edit"){
			while ($i < $num) {
				$name=mysql_result($result,$i,"name");
				$id=mysql_result($result,$i,"lcid");
					if ($cat == $id){
					echo "<OPTION name=\"cat\" Value =". $id . " SELECTED>" . $name . "</OPTION>";
					} else{
						echo "<OPTION name=\"cat\" Value =". $id . ">" . $name . "</OPTION>";
					}
				$i++;
			}
		} else { 
				while ($i < $num) {
					$name=mysql_result($result,$i,"name");
					$id=mysql_result($result,$i,"lcid");
						echo "<OPTION name=\"cat\" Value =". $id . ">" . $name . "</OPTION>";
					$i++;
				}
		}
		
		echo "</SELECT>";
		mysql_free_result($result);
}

?>




