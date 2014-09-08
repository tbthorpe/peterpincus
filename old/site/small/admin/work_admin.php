<?php 
session_start();
if(!isset($_SESSION['bobloblaw'])){
	header('Location: admin.php');
}else{
	
		include('includes/database.php');
		$db= new Database();
	//include('includes/admin_content.php');
	//the name of the passed image
	//example would be:   http://myapplication.com/image.php?i=photo.jpg
	$src = $_POST['thumb_src'];
	
	//folder where the images are 
	$loc = $_SERVER['SERVER_NAME'];
	switch ($loc){
		case 'tim.peter.com':
			$create_src_folder = $_SERVER['DOCUMENT_ROOT'].'/site/small/images/work/';
			$src_folder = '/site/small/images/work/';
			$thumb_folder = $_SERVER['DOCUMENT_ROOT'].'/site/small/images/work/thumbs/'; 
			break;	
		case 'peterpincus.com':
			$create_src_folder = $_SERVER['DOCUMENT_ROOT'].'/site/small/images/work/';
			$src_folder = '/site/small/images/work/';
			$thumb_folder = $_SERVER['DOCUMENT_ROOT'].'/site/small/images/work/thumbs/'; 
			break;	
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		require('includes/inc/imagemanipulation.php');


//TODO - RESIZE TO LIKE 450 PX!
		$objImage = new ImageManipulation($create_src_folder . $src);
		if ( $objImage->imageok ) {
			$objImage->setCrop($_POST['x'], $_POST['y'], $_POST['w'], $_POST['h']);			
			$objImage->resize(100,100);
			$objImage->save($thumb_folder . 'thumbnail.' .$src);
			$db->insert('work',array('null',$src,$_POST['cat'],$_POST['subcat'],$_POST['input_title'],$_POST['input_details'],$_POST['input_dimensions'],$_POST['input_date'],0));
		} else {
			echo 'Error!';
		}
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

		<script type="text/javascript" src="includes/js/jquery-1.4.2.min.js"></script>
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
.thumb{
	padding:5px;
	margin:5px;
	float:left;
	background-color:#f5f5f5;
	border:1px solid #000000;
	position:relative;
}	
.thumb_deets{
	padding:5px;
	display:none;
	margin:5px;
	float:left;
	background-color:#f5f5f5;
	border:1px solid #000000;
	position:relative;
}	
.remove_box{
	position:absolute;
	bottom:0px;
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
.remove_box:hover{
	border:1px solid white;
		-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; 
	filter: alpha(opacity=80);				
	opacity:0.8;
}
#work_nav a{
	color:#D51B0B;
	text-decoration:none;
}

#work_nav .category{
	margin:0 0 10px 0;
}
#work_nav .top_category{
	font-size:14px;
	font-weight:bold;
	margin-bottom:4px;
	color:#7E1107;
}
#work_nav .subcategory{
	margin-left:10px;
}
</style>
		


<script type="text/javascript">// <![CDATA[
	var categoryData;
	var category;
	var subcategory;
	var isSorting = false;
$(document).ready(function() {
$('#fileInput').uploadify({
'uploader'  : 'includes/uploadify.swf',
'script'    : 'includes/uploadify.php',
'cancelImg' : 'includes/cancel.png',
'auto'      : false,
'folder'    : '/site/small/images/work',
'onComplete': function(event, queueID, fileObj, response, data){
                    doSomething(event, queueID, fileObj, response, data); 
                }

});

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

$.getJSON("includes/admin_contentGET.php",{which:'work'},gotImages);
//$.getJSON("includes/admin_contentGET.php",{which:'work',cat:5,subcat:4},gotImages);
$.getJSON("includes/admin_contentGET.php",{which:'categories'},fillCategorySelects);


$.getJSON("includes/admin_contentGET.php",{which:'categories'},function(data){
							$.each(data.c, function(i,item){
							var elem = '<div class="category" id="category_'+item.id+'">';
							elem += '<div class="top_category" id="top_category_' + item.id + '"><div class="top_category_'+item.id+'_text">'+item.name+'</div>'
							+ '</div></div>'
							$('#work_nav').append(elem);
						}); //end each
						
						$.each(data.sc, function(i,item){
							var elem = '<div class="subcategory" id="sub_category_' + item.category_id + '_'+ item.id+'">'
							+ '<div id="sub_category_'+item.category_id+'_'+item.id+'_text"><a href="#" onclick="showNewCategory('+item.category_id+','+item.id+');return false;">'+item.name+'<a></div>'
							+ '</div>'
							$('#category_' + item.category_id).append(elem);
						}); //end each
						});



});
// ]]></script>
		<script language="JavaScript" type="text/JavaScript">
	<!--
	function showNewCategory(c,sc){
		category = c;
		subcategory = sc;
		$('#fulllist').html('');
		$.getJSON("includes/admin_contentGET.php",{which:'work',cat:c,subcat:sc},gotImages);
	}
	function fillCategorySelects(data){
		categoryData=data;
		var x=true;
		$.each(data.c,function(i,item){
			$('#categories').append('<option value="'+item.id+'">'+item.name+'</option>');
			$('#categories_view').append('<option value="'+item.id+'">'+item.name+'</option>');
			if (x){
				$('#cat').val(item.id);
				x=false;
			}
		});
		x=true;
		$.each(data.sc,function(i,item){
			if (item.category_id == categoryData.c[0].id){
				$('#sub_categories').append('<option value="'+item.id+'">'+item.name+'</option>');
				$('#sub_categories_view').append('<option value="'+item.id+'">'+item.name+'</option>');
				if (x){
					$('#subcat').val(item.id);
					x=false;
				}
			}
		});
		
	}
	
window.onload = siteInitialize; 
function siteInitialize() {
	//Sortable.create('fulllist',{tag: 'div', constraint: false, onUpdate:updateList});
}
function gotImages(data){
	
	//clear out the thing first.
			$('#fulllist').html("");
	
      $.each(data, function(i,item){
      $("<div>").attr("id",item.id).addClass("thumb").addClass("cat_"+item.cat).addClass("sc_"+item.subcat).appendTo("#fulllist");
    	$("<div>").attr("id","thumb_"+item.id).appendTo("#"+item.id);
      $("<img/>").attr("src", "/site/small/images/work/thumbs/thumbnail."+item.img_name).appendTo("#thumb_"+item.id);
      $("<div>").attr("id", "remove_"+item.id).addClass("remove_box").appendTo("#thumb_"+item.id);
      $("<img/>").attr("src", "/site/small/admin/images/remove.gif").appendTo("#remove_"+item.id);
      $("#remove_"+item.id).click(function(){removeImg(item.id);});
      $("<div>").attr("id","thumb_deets_"+item.id).addClass("thumb_deets").addClass("cat_deet_"+item.cat).addClass("sc_deet_"+item.subcat).appendTo("#"+item.id);
      var stuff = "Title:&nbsp;&nbsp;<div id='"+item.id+"_title'>"+item.title+"</div><hr style='padding:0 10px 0 10px;'>";
      stuff += "Details:&nbsp;&nbsp;<div id='"+item.id+"_details'>"+item.details+"</div><hr style='padding:0 10px 0 10px;'>";
      stuff += "Dimensions:&nbsp;&nbsp;<div id='"+item.id+"_dimensions'>"+item.dimensions+"</div><hr style='padding:0 10px 0 10px;'>";
      stuff += "Date:&nbsp;&nbsp;<div id='"+item.id+"_date'>"+item.make_date+"</div><hr style='padding:0 10px 0 10px;margin-bottom:10px;'>";
      stuff += "<span id='save_deets_"+item.id+"'>save</span>";
      $('#thumb_deets_'+item.id).append(stuff);
      $("#thumb_"+item.id).toggle(function() {
							  if (!isSorting){
							  	$( "#fulllist" ).sortable("disable");
						   	 	$('#thumb_deets_'+item.id).slideDown("slow");
						   	 	$('#'+item.id+'_title').attr('contenteditable','true');
						  		$('#'+item.id+'_details').attr('contenteditable','true');
						  		$('#'+item.id+'_dimensions').attr('contenteditable','true');
						  		$('#'+item.id+'_date').attr('contenteditable','true');
						  	} else {
						  		isSorting=false;
						  	}
							}, function() {
								$( "#fulllist" ).sortable("enable");
							  $('#thumb_deets_'+item.id).slideUp("slow");
							});
      
//      $("#thumb_"+item.id).click(function(){
//      	if (!isSorting){
//		   	 	$('#thumb_deets_'+item.id).slideToggle("slow");
//		   	 	$('#'+item.id+'_title').attr('contenteditable','true');
//		  		$('#'+item.id+'_details').attr('contenteditable','true');
//		  		$('#'+item.id+'_dimensions').attr('contenteditable','true');
//		  		$('#'+item.id+'_date').attr('contenteditable','true');
//		  	} else {
//		  		isSorting=false;
//		  	}
//    	});
    	$("#save_deets_"+item.id).click(function(){
    		var title = $('#'+item.id+'_title').text();
    		var details = $('#'+item.id+'_details').text();
    		var dimensions = $('#'+item.id+'_dimensions').text();
    		var make_date = $('#'+item.id+'_date').text();
     	  $.getJSON("includes/admin_contentGET.php",{which:'work',update:'true',id:item.id,title:title,dimensions:dimensions,details:details,make_date:make_date},gotImages);
    	});
    });
  $( "#fulllist" ).sortable({
   start: function(event, ui) { 
   		isSorting = true;
   	},
   stop: function(event,ui){
   	//event.stopPropagation();
   		a=$('#fulllist').sortable("toArray");
   		var orders='';
   		for (x in a){
   			orders += a[x]+",";
   		}
   		$.getJSON("includes/admin_contentGET.php",{which:'work',sort:'true',order:orders});
  	}
});
    
}
function removeImg(item_id){
	var answer = confirm("You wanna delete this one? On the real?");
	if (answer){
		$.getJSON("includes/admin_contentGET.php",{which:'work',remove:'true',id:item_id},gotImages);
	}
}
function doSomething(event, queueID, fileObj, response, data){
	var x =1;
	alert(response);
	alert(data);
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
function catChange(el){
	$('#sub_categories').html('');
	var x=true;
	$.each(categoryData.sc,function(i,item){
			if (item.category_id == el.options[el.selectedIndex].value){
				$('#sub_categories').append('<option value="'+item.id+'">'+item.name+'</option>');
				if (x){
					$('#subcat').val(item.id);
					x=false;
				}
			}
		});
	  $('#cat').val(el.options[el.selectedIndex].value);
}

function catViewChange(el){
	$('#sub_categories_view').html('');
	$.each(categoryData.sc,function(i,item){
			if (item.category_id == $(el).val()){
				$('#sub_categories_view').append('<option value="'+item.id+'">'+item.name+'</option>');
			}
		});
}

function subCatChange(el){
	$('#subcat').val(el.options[el.selectedIndex].value);
}

function categoryShow(el){
	//TODO: update sc to come from params
	$('.thumb').css('display','none');
	$('.cat_'+$(el).val()).css('display','block');
}
function subcategoryShow(el){
	//TODO: update sc to come from params
	$('.thumb').css('display','none');
//	var cat = $('#categories_view').options[$('#categories_view').selectedIndex].value;
//	var sc = el.options[el.selectedIndex].value;
var cat =$('#categories_view').val();
var sc= $('#sub_categories_view').val();
	$('.cat_'+cat+'.sc_'+sc).css('display','block');
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
<BR><span style='font-size:15pt'><b><center>Current Photos</center></b></span><br><br>		<!--<span onclick="$('#fileInput').uploadify({cancelImg:'something.png'});">asfasdf</span>-->

			<a href=# onClick="addNew('addNew')">+ Add new photo</a>
			<!-- image for Jcrop -->
		

		<!-- selection dimentions -->
		<div id="handw" class="toggle" >Selection Dimentions<br /><span id="picw"></span> x <span id="pich"></span></div>
			<div id="addNew"  class="newPost">
<img id="cropbox" style="display:none;" />
				<input id="fileInput" name="fileInput" type="file" />
				<div id="jcrop_form" style="display:none;">
					<form id="jcropform" action="work_admin.php" method="post" onsubmit="return checkCoords();">
			      <input type="hidden" id="x" name="x" />
			      <input type="hidden" id="y" name="y" />
			      <input type="hidden" id="w" name="w" />
			      <input type="hidden" id="h" name="h" />
			      <input type="hidden" id="cat" name="cat" value=1 />
			      <input type="hidden" id="subcat" name="subcat" value=1 />
			      <input type="hidden" id="thumb_src" name="thumb_src" value="xxx" />
			      Title: &nbsp;&nbsp;&nbsp;<input type="text" id="input_title" name="input_title"><br/>
			      Details: &nbsp;&nbsp;&nbsp;<input type="text" id="input_details" name="input_details"><br/>
			      Dimensions: &nbsp;&nbsp;&nbsp;<input type="text" id="input_dimensions" name="input_dimensions"><br/>
			      Date: &nbsp;&nbsp;&nbsp;<input type="text" id="input_date" name="input_date"><br/>
			      <input type="submit" class="submit" value="Create Thumbnail" /> <br/>
			    </form>
			  </div>
				<form id="newsForm" action="admin_photo.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						
						
						</tr>
						<tr>

							<td width=22% align="right" width=42%>Main Category:&nbsp;&nbsp;</td>
							<td width=78%>
								<select name="categories" id="categories" onChange="catChange(this);">
								</select>
								<select name="sub_categories" id="sub_categories" onChange="subCatChange(this);">
								</select>
									</td>
						</tr>

					</table>

					<input type="hidden" name="add" value="true">
				</form>
			<input type="button" class="newPostInput" value="Upload!" onClick="$('#fileInput').uploadifyUpload();";>
		</div>
		
<BR><br><br><table width=100% border=0 cellpadding=5px style='border: 2px solid #5A0300;'><tr><td>
								<!--<select name="categories" id="categories_view" onChange="categoryShow(this);catViewChange(this);">
								</select>
								<select name="sub_categories_view" id="sub_categories_view" onChange="subcategoryShow(this);">
								</select>--><div id="work_nav" class="work_nav" style="width:200px;margin-right:20px;border:2px solid #ff8888;float:left;"></div><div id="fulllist" style="float:right;width:630px;">
<br/>
<?php //workContent($db, 1,1); ?>


</div></td></tr></table><BR></div></div></div></body></html>			
<?php } ?>
