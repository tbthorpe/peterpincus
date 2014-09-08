<?php 
session_start();
if(!isset($_SESSION['bobloblaw'])){
	header('Location: admin.php');
}else{
	
		include('includes/database.php');
		$db= new Database();
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$tags=array('[bold]','[/bold]','[italics]','[/italics]','[red]','[/red]','\n');
		$real_tags=array('<b>','</b>','<i>','</i>','<span style="color:red;">','</span>','<br/>');
		
		$text=htmlentities(mysql_real_escape_string($_POST['text']));
		$title=mysql_real_escape_string($_POST['title']);
		$text=str_replace($tags,$real_tags,$text);
		$title=str_replace($tags,$real_tags,$title);

		$now=date('Y-m-d H:i:s');
			
		// NEW
		//print_r($_POST);
			$db->insert('blog',array('null',$title,$text,$now,$now));
		
		// UPDATE

		
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<title>PeterPincus :: Work</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">

		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="includes/swfobject.js"></script>

		<script type="text/javascript" src="includes/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="includes/js/jcrop/jquery.Jcrop.js"></script>
		<script type="text/javascript" src="includes/js/jqueryui.js"></script>
		
		<link rel="stylesheet" type="text/css" href="includes/style.css" media="screen" />

		<link rel="stylesheet" type="text/css" href="includes/js/jcrop/jquery.Jcrop.css" media="screen" />

<script src="includes/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>
<style>
	* {
    margin: 0;
    padding: 0;
}
.category{
	padding:5px;
	margin:5px;
	background-color:red;
	border:1px solid #000000;
	position:relative;
}	
.new_category{

	background-color:yellow;

}
.top_category{
	height:25px;
	position:relative;
}
.sub_category{
	display:block;
	height:25px;
	background-color:#f5f5f5;
	position:relative;
}
.new{
	border:1px dashed black;
}
.add_box{
	position:absolute;
	top:0px;
	right:0px;
	border:1px solid black;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=60);				
	opacity:0.6;
	background-color:#000000;
	height:20px;
	width:20px;
	z-index:100;
}

.remove_box{
	position:absolute;
	top:0px;
	right:0px;
	border:1px solid black;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=60);				
	opacity:0.6;
	background-color:#000000;
	height:20px;
	width:20px;
	z-index:100;
}

.save_box{
	position:absolute;
	top:0px;
	right:50px;
	border:1px solid black;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=60);				
	opacity:0.6;
	background-color:#000000;
	height:20px;
	width:20px;
	z-index:100;
}
.edit_box{
	position:absolute;
	bottom:0px;
	right:25px;
	border:1px solid black;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=60);				
	opacity:0.6;
	background-color:#000000;
	height:20px;
	width:20px;
	z-index:100;
}
.full_box{
	position:absolute;
	bottom:0px;
	right:50px;
	border:1px solid black;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=60);				
	opacity:0.6;
	background-color:#000000;
	height:20px;
	width:20px;
	z-index:100;
}
.add_box:hover,.edit_box:hover,.save_box:hover{
	border:1px solid white;
		-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; 
	filter: alpha(opacity=80);				
	opacity:0.8;
}
</style>
		


<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
	var isSorting = false;
	$.getJSON("includes/admin_contentGET.php",{which:'categories'},function(data){gotCategories(data);sortInit();});
});

function sortInit(){
	$(document).ready(function() {
		$.getJSON("includes/admin_contentGET.php",{which:'categories'},gotCategories);
		$( "#fulllist" ).sortable({
		   start: function(event, ui) { 
		   		 isSorting = true;
		   	},
		   stop: function(event,ui){
		   		a=$('#fulllist').sortable("toArray");
		   		var orders='';
		   		for (x in a){
		   			orders += a[x]+",";
		   		}
				//alert(orders);
		   		$.getJSON("includes/admin_contentGET.php",{which:'cat',sort:'true',order:orders});
		  	}
		});
	}); 
}

function gotCategories(data){
		var x=1;
		
					$('#fulllist').html("");
					
					
					
					 $.each(data.c, function(i,item){
							var elem = '<div class="category" id="'+item.id+'">';
							elem += '<div class="top_category" id="top_category_' + item.id + '"><div class="top_category_'+item.id+'_text">'+item.name+'</div>'
							+ '<div class="add_box" id="add_'+item.id+'"><img src="/site/small/admin/images/add.gif" class="thumbsup"/></div>'
							+ '</div></div>'
							$('#fulllist').append(elem);
							$("#add_"+item.id).click(function(event){
			      		event.stopPropagation();
			      		addItem(item.id);
			      	});
							x = x+1;
						}); //end each
						
						$.each(data.sc, function(i,item){
							var elem = '<div class="sub_category" id="sub_category_' + item.category_id + '_'+ item.id+'">'
							+ '<div id="sub_category_'+item.category_id+'_'+item.id+'_text">'+item.name+'</div>'
							+ '<div class="save_box" id="save_'+item.id+'"><img src="/site/small/admin/images/save.gif"/></div>'
							+ '<div class="edit_box" id="edit_'+item.id+'"><img src="/site/small/admin/images/edit.gif"/></div>'
							+ '<div class="remove_box" id="remove_'+item.id+'"><img src="/site/small/admin/images/remove.gif"/></div>'
							+ '</div></div>'
							$('#' + item.category_id).append(elem);
							$("#edit_"+item.id).click(function(event){
			      		event.stopPropagation();
			      		makeEditable($('#sub_category_' + item.category_id + '_'+ item.id+'_text'));
			      	});
			      	$("#remove_"+item.id).click(function(event){
			      		event.stopPropagation();
			      		removeItem(item.id,'sc');
			      	});
			      	$("#save_"+item.id).click(function(event){
			      		event.stopPropagation();
			      		updateItem(item.id,'sc',$('#sub_category_' + item.category_id + '_'+ item.id+'_text'));
			      	});
							x = x+1;
						}); //end each
}

function addCategory(){
	adding = true;
	var elem = '<div class="category new_category" id="category_new">'
							+ '<div id="new_category_text" contenteditable="true">New Category (edit me)</div>'
							+ '<div class="save_box" id="save_new_category"><img src="/site/small/admin/images/save.gif"/></div>'
							+ '</div>';
							$('#fulllist').append(elem);
							$("#save_new_category").click(function(event){
			      		event.stopPropagation();
			      		saveNewCategory($('#new_category_text').text());
			      	});
}

function addItem(cat){
	var elem = '<div class="sub_category" id="sub_category_'+cat+'_new">'
							+ '<div id="sub_category_new_'+cat+'_text" contenteditable="true">EDITME</div>'
							+ '<div class="save_box" id="save_new_'+cat+'"><img src="/site/small/admin/images/save.gif"/></div>'
							+ '</div>';
							$('#' + cat).append(elem);
							$("#save_new_"+cat).click(function(event){
			      		event.stopPropagation();
			      		saveNew(cat,$('#sub_category_new_' + cat + '_text').text());
			      	});
	//$("<div>").attr("id","sub_category_new_"+i+"_"+item_id).addClass("sub_category").addClass('new').attr('contenteditable','true').appendTo("#category_"+item_id);
   //$("#sub_category_new_"+i+"_"+item_id).html('EDIT ME!');
}

function saveNew(cat,text){
	$.getJSON("includes/admin_contentGET.php",{which:'sc',insert:'true',cat_id:cat,name:text},gotCategories);
}

function saveNewCategory(text){
	adding=false;
	$.getJSON("includes/admin_contentGET.php",{which:'cat',insert:'true',name:text},gotCategories);
}

function updateItem(item_id, type,el){
	var x = el.text();
	switch (type){
		case 'sc':
			$.getJSON("includes/admin_contentGET.php",{which:'sc',update:'true',id:item_id,name:x},function(data){});
			$( "#fulllist" ).sortable("enable");
			break;
		default:
			break;
	}
}
function saveItem(cat){
	alert(cat);
}
function removeItem(item_id,type){
	 var answer = confirm("You wanna delete this one? On the real?");
	 if (answer){
		alert(type + ", " + item_id);
		$.getJSON("includes/admin_contentGET.php",{which:type,remove:'true',id:item_id},gotCategories);
	}
	return false;
}
function makeEditable(elem){
	$( "#fulllist" ).sortable("disable");
	elem.attr('contenteditable','true');
}
//$('#fileInput').uploadify({
//'uploader'  : 'includes/uploadify.swf',
//'script'    : 'includes/uploadify.php',
//'cancelImg' : 'includes/cancel.png',
//'auto'      : false,
//'folder'    : '/site/small/images/work',
//'onComplete': function(event, queueID, fileObj, response, data){
//                    doSomething(event, queueID, fileObj, response, data); 
//                }
//
//});

//$.ajax({
//   type: "POST",
//   url: "includes/admin_content.php",
//   data: "which=work",
//   dataType: 'application/json',
//   success: function(msg){
//   	var m =2;
//    $.each(msg,function(i,piece){var x = 3;});
//   }
// });


// ]]></script>
		<script language="JavaScript" type="text/JavaScript">
	<!--
window.onload = siteInitialize; 
function siteInitialize() {
	var adding = false;
	//Sortable.create('fulllist',{tag: 'div', constraint: false, onUpdate:updateList});
}
function gotPosts(data){
		var x;
	//clear out the thing first.
			$('#fulllist').html("");
	
      $.each(data, function(i,item){
    	$("<div>").attr("id","post_"+item.id).addClass("post").appendTo("#fulllist");
    	$("<div>").attr("id","post_title_"+item.id).addClass("post_title").appendTo("#post_"+item.id);
    	$("#post_title_"+item.id).html(item.title);
    	$("<div>").attr("id","post_text_"+item.id).addClass("post_text").appendTo("#post_"+item.id);
//    	
//    	 var regEx = new RegExp( "\\n", "g" );
//			x = (item.text).replace(regEx, "");
//			
    	$("#post_text_"+item.id).html(item.text);
      //$("<img/>").attr("src", "/site/small/images/work/thumbs/thumbnail."+item.img_name).appendTo("#thumb_"+item.id);
      $("<div>").attr("id", "remove_"+item.id).addClass("remove_box").appendTo("#post_"+item.id);
      $("<img/>").attr("src", "/site/small/admin/images/remove.gif").appendTo("#remove_"+item.id);
      $("#remove_"+item.id).click(function(event){
      		event.stopPropagation();
      		removeItem(item.id);
      	});
      	
      $("<div>").attr("id", "full_"+item.id).addClass("full_box").appendTo("#post_"+item.id);
      $("<img/>").attr("src", "/site/small/admin/images/full.gif").appendTo("#full_"+item.id);
      $("#full_"+item.id).click(function(event){
      		event.stopPropagation();
      		$("#post_text_"+item.id).slideToggle("fast");
      	});
      
      $("<div>").attr("id", "edit_"+item.id).addClass("edit_box").appendTo("#post_"+item.id);
      $("<img/>").attr("src", "/site/small/admin/images/edit.gif").appendTo("#edit_"+item.id);
      $("#edit_"+item.id).click(function(event){
      		event.stopPropagation();
      		makeEditable(item.id);
      	});
    });
          
}

function editItem(item_id){
	$("#edit_"+item_id).unbind('click');
	$("#post_text_"+item_id).attr('contenteditable','false');
	$("#post_title_"+item_id).attr('contenteditable','false');
	$("#edit_"+item_id).click(function(event){
      		event.stopPropagation();
      		makeEditable(item_id);
   });
	var x = $("#post_title_"+item_id).html();
	var y = $("#post_text_"+item_id).html();
	$.getJSON("includes/admin_contentGET.php",{which:'blog',update:'true',id:item_id,title:x,text:y},function(data){});
}
function doSomething(event, queueID, fileObj, response, data){
	var x =1;
	$('#cropbox').attr('src',fileObj.filePath);
	$('#cropbox').css('display','block');
	$('#thumb_src').attr('value',fileObj.name);
	$('#jcrop_form').css('display','block');

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
function catChange(el){
	
	  $('#cat').val(el.options[el.selectedIndex].value);
}
function suCatChange(el){
	$('#subcat').val(el.options[el.selectedIndex].value);
}

function categoryShow(c,sc){
	//TODO: update sc to come from params
	$('.thumb').css('display','none');
	$('.cat_'+c+'.sc_1').css('display','block');
	
}
function testThing(){
	alert($("#ttt").html());
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
<?php

?>
		<div id="centeringDiv">
			<img src='images/header_t.png'><div id='inner' style='height:100%; padding:10px; background-color:white;'><div id="topNav"><a href="blog_admin.php">Blog</a>&nbsp;|&nbsp;<a href="work_admin.php">Work</a>&nbsp;|&nbsp;<a href="category_admin.php">Work Categories</a>&nbsp;|&nbsp;<a href="statement_admin.php">Statement</a>&nbsp;|&nbsp;<a href="logout.php">Logout</a></div><div id="AdminTable"><br />
<BR><span style='font-size:15pt'><b><center>Blog Administration</center></b></span><br><br>		<!--<span onclick="$('#fileInput').uploadify({cancelImg:'something.png'});">asfasdf</span>-->

			<a href=# onClick="addCategory()">+ Add new blog post</a>
						<div id="addNew"  class="newPost">
							<form id="newsForm" action="blog_admin.php" method="POST" enctype="multipart/form-data">
								<table border=0px width=100% align=center>
									<tr>
										<td width=22% align="right" width=42%>Title:&nbsp;&nbsp;</td>
										<td width=78%><input class="newPostInput" type="title" name="title"></td>
									</tr>
									<tr>
										<td width=22% align="right" width=42%>Text:&nbsp;&nbsp;</td>
										<td width=78%><textarea rows=15 cols=45 name="text" class="newPostInput" ></textarea></td>
									</tr>
									<!--<tr>
										<td width=22% align="right" width=42%>Picture:&nbsp;&nbsp;</td>
										<td width=78%><input name="userfile" type="file" id="userfile"></td>
									</tr>-->
									<tr>
											<td colspan=2 align=center><input class="newPostInput" type="submit" value="Post this"></td>
									</tr>
								</table>
								<input type="hidden" name="add" value="true">
							</form>
						<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew')";>
					</div>
		
<BR><br><br><table width=100% border=0 cellpadding=5px style='border: 2px solid #5A0300;'><tr><td><div id="fulllist">
<?php //workContent($db, 1,1); ?>


</div></td></tr></table><BR></div></div></div></body></html>			
<?php } ?>
