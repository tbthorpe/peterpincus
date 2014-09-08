<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>PETERPINCUS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>PETERpincus</title>
	<meta name="verify-v1" content="8Fcv4zU4kEpmqFt1JgX8TNobfjaWLWwA7/MpesGh5B4=" />
	<link rel="stylesheet" media="screen" type="text/css" href="g/a.css" />
		<link rel="stylesheet" href="static/css/jquery.jscrollpane.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="static/css/jquery.lightbox-0.5.css" media="screen" />
	<script type="text/javascript" src="g/mootools.js"></script><script type="text/javascript" src="g/core.js"></script>
	<script type="text/javascript" src="static/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="static/js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="static/js/jquery.lightbox-0.5.js"></script>
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon&subset=latin' rel='stylesheet' type='text/css'>

<style>
	* {
    margin: 0;
    padding: 0;
}

html, body, #bg, #bg table, #bg td {
    height:100%;
    width:100%;
    overflow:hidden;
    font-family: helvetica, arial, serif;
}
h1 {
	font-family: 'IM Fell French Canon', arial, serif; 
}
#menu{
	position:absolute;
	top:20px;
	background:#d2b848;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=60);				

	opacity:0.6;
	z-index:80;
	width:1000px;
	color: white;
	height:70px;
}
#menu #nav li{
	float:left;
	padding:5px;
	list-style-type:none;
}
#menu h1{
	font-weight:normal;
}



#menu #nav .menu.off{
	color:white;
	text-decoration:none;
	cursor:pointer;
}
#menu #nav .menu.on{
	color:#261910;
}

#menu #nav .menu{
	color:white;
}

#menu .menu .index{
	color:#c47ca1;
	cursor:pointer;
}
#content{
	position:absolute;
	top:120px;
	background:#644a2f;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=60);	
	opacity:0.6;
	z-index:80;
	height: 450px;
	width:700px;
	color: white;
	margin:0 auto;
	padding-left:10px;
	padding-top:10px;
	font-size:10pt;
	text-align:left;
}
.work_nav{
	position:absolute;
	display:none;
	top:120px;
	left:790px;
	color:white;
	background:#644a2f;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=75);	
	opacity:0.75;
	z-index:80;
	height:400px;
	width:175px;
}
.scroll-pane
			{
				overflow: auto;
			}
			
#work_nav{
	font-size:12px;
	text-align: left;
	padding:10px 0 0 10px;
}
#work_nav a{
	color:white;
	text-decoration:none;
}

#work_nav .category{
	margin:0 0 10px 0;
}
#work_nav .top_category{
	font-size:14px;
	font-weight:bold;
	margin-bottom:4px;
}
#work_nav .subcategory{
	margin-left:10px;
}
.post_time{
	color:#241A10;
	font-weight:bold;
	font-size:10px;
}
.post_title{
	color:#241A10;
	font-weight:bold;
	font-size:13px;
}
.post{
	background:#f5f5f5;
	padding:10px;
	margin:15px 10px 10px 0;
	color:#241A10;
}
.post .post_text{
	margin-top:15px;
}
.statement{
	color:#ffffff;
	font-size:13px;
	
}
</style>
<script type="text/javascript" id="sourcecode">
			$(function()
			{
				$('.scroll-pane').jScrollPane({showArrows: true});
				$('.menu').each(function(){
						$(this).click(menuClick);
				});
			});
			
			function menuClick(){
				var page = this.id;
				$('#content').animate({
			    opacity: 0.0
			  	}, 200, function() {
				    $.ajax({
						  url: page+".php",
						  success: function(data) {
						    //$('.scroll-pane').empty().html(data).jScrollPane({showArrows: true});
						    $('.menu').removeClass('on');
						    $('#'+page).addClass('on');
						    $('.jspPane').html(data);
						    $('.scroll-pane').jScrollPane({showArrows: true});
						    //$('#content').css('height','450px');
						    $('#content').animate({
							    opacity: 0.6
							  	},200, function() {
								    switch (page){
								    	case 'work':
								    		$('.bozo').lightBox({fixedNavigation:true});
											$('.scroll-pane').jScrollPane({showArrows: true});
								    		//FILL IN WORK NAV
								    		populateWorkNav();
								    		$('#work_nav').fadeIn('slow');
								    		break;
								    	default:
								    		$('#work_nav').fadeOut('fast');
								    		break;
								    }
							  });
						  }
						});
			  });

				
				
					

				
				return false;
			}
			
			function populateWorkNav(){
				if (!($('#work_nav').text())){
					//pop
					$.getJSON("admin/includes/admin_contentGET.php",{which:'categories'},function(data){
							$.each(data.c, function(i,item){
							var elem = '<div class="category" id="category_'+item.id+'">';
							elem += '<div class="top_category" id="top_category_' + item.id + '"><div class="top_category_'+item.id+'_text">'+item.name+'</div>'
							+ '</div></div>'
							$('#work_nav').append(elem);
						}); //end each
						
						$.each(data.sc, function(i,item){
							var elem = '<div class="subcategory" id="sub_category_' + item.category_id + '_'+ item.id+'">'
							+ '<div id="sub_category_'+item.category_id+'_'+item.id+'_text"><a href="#" onclick="showNewCat('+item.category_id+','+item.id+');return false;">'+item.name+'</a></div>'
							+ '</div>';
							$('#category_' + item.category_id).append(elem);
							$("#edit_"+item.id).click(function(event){
			      		event.stopPropagation();
			      		makeEditable($('#sub_category_' + item.category_id + '_'+ item.id+'_text'));
			      	});
						}); //end each
						});
				} else{
					//already done!
				}
			}
			
			function showNewCat(c,sc){
				$('.piece').css('display','none');
				$('.c_'+c+'.sc_'+sc).css('display','block');
				$('.scroll-pane').jScrollPane({showArrows: true});
			}
		</script>
</head>

<body style="background:#b3b2b2;">
	<div style="margin-top:5px; width:100%;text-align:center;">
		<div style="margin:0 auto;width:1000px;">
			
			
			
			<div style="width:100%;height:100%;overflow:hidden;position:relative;">
				
				<div id="menu">
				<h1 style="position:absolute;text-align:left;left:0px;"><span class="menu index" id="home"><b>Peter</b>Pincus</span></h1>
					<div id="nav" style="position:absolute;top:40px;">
						<ul>
							<li id="work" class="menu off">WORK</li>
							<li id="blog" class="menu off">BLOG</li>
							<li id="statement" class="menu off">STATEMENT</li>
						</ul>
					</div>
				</div>
				
				<div id="content" class="scroll-pane">
					Welcome to peterpincus.com. <br/><br/>
					Peter - I need text for here.
				</div>
				<div id="work_nav" class="work_nav"></div>
				<img src="static/images/bg_small2.jpg">
			</div>
    </div>
    
	</div> 
</body>
</html>