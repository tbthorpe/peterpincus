<?php

	include "includes/dbConnect.php";
?>
<html>
		<head>
		<title>Home Page Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	
	<script src="includes/prototype.js" type="text/javascript"></script>
	<script src="includes/scriptaculous.js" type="text/javascript"></script>
	<script src="includes/lightbox.js" type="text/javascript"></script>
	<script src="includes/admin_tools.js" type="text/javascript"></script>


		<script language="JavaScript" type="text/JavaScript">
		<!--
		//-->
		</script>

		</head>
<body>
<div id="test" style="border:1px solid black;" onclick="change('test')">
<?php
$query="SELECT * FROM test";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		mysql_close();
  
		$i=0;
		
		while ($i < $num) {
			$page=mysql_result($result,$i,"text");
			echo $page;
			$i++;
		}
?>
</div>
</body>
</html>