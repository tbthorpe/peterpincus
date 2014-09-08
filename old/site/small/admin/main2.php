<?php
session_start();

include "tools.php";
include "always.php";
if (!isset ($_POST['logAttempt'])){
	displayLoginForm("");
} else {
	include "includes/dbConnect.php";
	$u = $_POST['a'];
	$p = $_POST['b'];
	$query="SELECT * FROM `admins` where `user`='".md5($u)."' AND `pass`='".md5($p)."';";
	$result=mysql_query($query);
	
	$num=mysql_numrows($result);
	
	mysql_close();
	
	
	if ($num != 1){
		session_destroy();
		displayLoginForm("Login failed miserably.");
	} else {
	// store session data
	$_SESSION['bobloblaw']=1;
	$_SESSION['uname'] = $u;

	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html>
	<head>
	<title>Admin Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<script language="JavaScript" type=text/Javascript" src="includes/tools.js"></script>
	<script language="JavaScript" type="text/JavaScript">
	<!--
	
	//-->
	</script>
	<link href="includes/admin.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
	<div id="centeringDiv">
	
		<?php include "includes/topNav.php"; ?>
		
		<BR><BR>
		Congrats.  You're in.  Click a link above and begin administrating
	</div>
	</div>
	</body>
	</html>
	<?php
}
}  //end isset logAtt
exit();
?>