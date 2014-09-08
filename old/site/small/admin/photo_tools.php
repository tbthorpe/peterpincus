<?php

	include "includes/dbConnect.php";



function displayPGAdmin($msg){
		include "includes/dbConnect.php";
			?>
		<html>
		<head>
		<title>MCDC Admin :: Photographs</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="includes/swfobject.js"></script>

		<script type="text/javascript" src="includes/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="includes/js/jcrop/jquery.Jcrop.js"></script>
		
		<link rel="stylesheet" type="text/css" href="includes/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="includes/js/jcrop/jquery.Jcrop.css" media="screen" />

<script src="includes/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>

		


<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
$('#fileInput').uploadify({
'uploader'  : 'includes/uploadify.swf',
'script'    : 'includes/uploadify.php',
'cancelImg' : 'includes/cancel.png',
'auto'      : true,
'folder'    : '/site/small/images/work',
'onComplete': function(event, queueID, fileObj, response, data){
                    doSomething(event, queueID, fileObj, response, data); 
                }

});

});
// ]]></script>
		<script language="JavaScript" type="text/JavaScript">
	<!--
window.onload = siteInitialize; 
function siteInitialize() {
	//Sortable.create('fulllist',{tag: 'div', constraint: false, onUpdate:updateList});
}
function doSomething(event, queueID, fileObj, response, data){
	var x =1;
	$('#cropbox').attr('src',fileObj.filePath);
	$('#cropbox').css('display','block');
	
	setTimeout(function(){var api = $.Jcrop('#cropbox',{
    onChange: updateCoords,
    onSelect: updateCoords,
    aspectRatio: 1
  }); },2000);
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
function updateImageList(id) {
	var url = "update_image_order.php"; // url to update_navigation.php
	var sorted = escape(Sortable.sequence(id));
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
function updateAfterDeleting(originalRequest) {
	//alert(originalRequest.responseText);
	$('#AdminTable').innerHTML = originalRequest.responseText;
}
function updateCoords(c) {
	$('#handw').show();
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#w').val(c.w);
  $('#h').val(c.h);
  $('#pich').html(c.h);
  $('#picw').html(c.w);
};

function checkCoords()
{
  if (parseInt($('#x').val())) return true;
  alert('Please select a crop region then press submit.');
  return false;
};
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
		

		putPGInside();
		echo "</div>";
		
}
function putPGInside(){
				//--------- ABOUT US --------------
		//$query="SELECT * FROM talla_pg_gallery left outer join talla_pg_photo on talla_pg_photo.pid=talla_pg_gallery.thumb_pid ORDER BY talla_pg_gallery.order_num DESC";
		$query="SELECT * FROM mcdc_photos ORDER BY `gallery` DESC, `order` DESC";
		$result2=mysql_query($query);
		$num=mysql_num_rows($result2);
  
		echo "<BR><span style='font-size:15pt'><b><center>Current Photos</center></b></span><br><br>";
		displayPGForm();
		$i=0;
		echo "<table width=100% border=0 cellpadding=5px style='border: 2px solid #5A0300;'><tr><td>";
		echo "<div id=\"fulllist\">\n";
			
		while ($data = mysql_fetch_assoc($result2)) {
			echo "<div id=\"item_".$data['pid']."\" style=\"background-color: #E1E1E1;\">";
				echo "<table width=100%><tr>";
				echo "<td width=5%>".$data['gallery']."...</td>";
				if ($data['filename']){
						echo "<td width=20%><img src=\"images/gallery_images_thumbs/".$data['filename_t']."\"></td>";
				}else {
						echo "<td width=20%><img src=\"images/nothumb.jpg\"></td>";
				}
				echo "<td width=20%>".nl2br(stripslashes($data['title']))."...</td>";
				
				echo "<td width=10%>&nbsp;&nbsp<a onclick=\"removeItem('mcdc_photos',".$data['pid'].")\">X</a></td></tr>";
			

			//putPGEditDivAU($i, $data['gid'], $data['g_text'], $data['filename'], $data['title'], $data['gallery']);
			echo "</table></div>";
			$i++;
		}
 
		echo "</div></td></tr></table>"; 
	echo "<BR>";
		
		
}

function putPGEditDivAU($ct, $id, $text, $filename, $title,$gallery){
	echo "<tr id=\"row".$id."edit\" style=\"display:none;\">";
		
			echo "<td colspan=4 height=300px align=center>";
	echo "<div id=\"row".$id."editDiv\" class=\"editDiv\">";
	?>
					<form id="PTEditForm<?php echo $id ?>" action="admin_photo.php" method="POST" enctype="multipart/form-data">
						 
					<input type="text" name="title" onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo stripslashes($title) ?>"><BR>
					<?php 
						if ($filename != "noneski"){
							echo "<a href=\"images/news_images/".$filename."\" rel=\"lightbox[newstest]\"><img src=\"images/news_images_thumbs/tn_".$filename."\"></a><BR>"; 
							echo "Change this picture<BR>";
							echo "<input name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						} else {
							echo "Add a picture below<BR>";
							echo "<input name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						}
						
						if ($filename_t != "noneski"){
							echo "<a href=\"images/news_images/".$filename_t."\" rel=\"lightbox[newstest]\"><img src=\"images/gallery_images_thumbs/tn_".$filename_t."\"></a><BR>"; 
							echo "Change this picture<BR>";
							echo "<input name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						} else {
							echo "Add a picture below<BR>";
							echo "<input name=\"userfile\" type=\"file\" id=\"userfile\"><BR>";
						}
					?>
					<input type="hidden" name="pid" value="<?php echo $id ?>">

					<input type="hidden" name="edit" value="true">
					<div style="clear:both;">
						<input type="button" class="newPostInput" value="cancel edit" onClick="hideEdit('row<?php echo $id ?>edit');">
						<input type="submit" class="newPostInput">
					</div>
	<?php
	echo "</form></td></tr>";	
}

function displayPGForm(){

		
	?>
		<!--<span onclick="$('#fileInput').uploadify({cancelImg:'something.png'});">asfasdf</span>-->
			<a href=# onClick="addNew('addNew')">+ Add new photo</a>
			<!-- image for Jcrop -->
		<img id="cropbox" style="display:none;" />

		<!-- selection dimentions -->
		<div id="handw" class="toggle" >Selection Dimentions<br /><span id="picw"></span> x <span id="pich"></span></div>
			<div id="addNew"  class="newPost">
				<input id="fileInput" name="fileInput" type="file" />
				<form id="newsForm" action="admin_photo.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						
						
						<tr>
							<td width=22% align="right" width=42%>Title:&nbsp;&nbsp;</td>
							<td width=78%><input class="newPostInput" type="title" name="title"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Photo:&nbsp;&nbsp;</td>
							<td width=78%><input name="userfile" type="file" id="userfile"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Thumbnail:&nbsp;&nbsp;</td>
							<td width=78%><input name="userfile_t" type="file" id="userfile_t"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Gallery ID:&nbsp;&nbsp;</td>
							<td width=78%>
								<select name="gallery">
									<option value="6">Audition 2010/2011</option>
									<option value="5">SCIENCE 2010</option>
									<option value="1">audition 2010</option>
									<option value="2">group</option>
									<option value="3">action</option>
									<option value="4">press event 2010</option>
									</td>
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




