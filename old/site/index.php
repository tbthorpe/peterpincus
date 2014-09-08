<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>PETERpincus</title>
	<meta name="verify-v1" content="8Fcv4zU4kEpmqFt1JgX8TNobfjaWLWwA7/MpesGh5B4=" />
	<link rel="stylesheet" media="screen" type="text/css" href="g/a.css" />
	<script type="text/javascript" src="g/mootools.js"></script><script type="text/javascript" src="g/core.js"></script>
	<script type="text/javascript" src="static/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="static/js/jquery.jscrollpane.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+French+Canon&subset=latin' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="static/css/jquery.jscrollpane.css" type="text/css" media="screen" />
	<!--[if IE]><meta http-equiv="imagetoolbar" content="no" /><meta http-equiv="X-UA-Compatible" content="IE=8" /><![endif]-->
	<!--Site by Eirik Backer-->
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
#bg {
    position: fixed;
}

#bg div {
    height:200%;
    left:-50%;
    position:absolute;
    top:-50%;
    width:200%;
}

#bg td {
    text-align:center;
    vertical-align:middle;
}

#bg img {
    margin:0 auto;
    min-height:50%;
    min-width:50%;
}

#menu{
	position:absolute;
	top:20px;
	background:#d2b848;
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)"; 
	filter: alpha(opacity=60);				

	opacity:0.6;
	z-index:80;
	width:100%;
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



#menu #nav .menu{
	color:white;
	text-decoration:none;
	cursor:pointer;
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
	height: 500px;
	width:50%;
	color: white;
	margin:0 auto;
	padding-left:10px;
	padding-top:10px;
	font-size:10pt;
}
.scroll-pane
			{
				overflow: auto;
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
				$.ajax({
				  url: page+".php",
				  success: function(data) {
				    $('.jspPane').html(data);
				  }
				});
				return false;
			}
		</script>

</head>
<body>
	<div id="menu">
			<h1 style="position:relative;"><span class="menu index" id="home"><b>PETER</b>pincus</span></h1>
			<div id="nav">
				<ul>
					<li id="work" class="menu off">WORK</li>
					<li id="blog" class="menu off">BLOG</li>
					<li id="something" class="menu off">SOMETHING</li>
					<li id="else" class="menu off">ELSE</li>
				</ul>
			</div>
		</div>
		<div id="content" class="scroll-pane">
			So what I was going for was basically - simplicity without being boring.  I hope I'm on the path to getting it right.
		</div>
	<div id="bg">
	    <div>
	        <table cellspacing="0" cellpadding="0">
	            <tr>
	                <td>
	                    <img src="static/images/ppincus_bg2.jpg" alt=""/>
	                </td>
	            </tr>
	        </table>
	    </div>
	</div>
</body>
</html>