<?php
	session_start();
	include "always.php";

	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
			include "includes/dbConnect.php";
			include "services_tools.php";
			if (isset($_POST['addNews'])){
				include "includes/dbConnect.php";
				$date = date("Y-m-d g:i a");
				$a = mysql_escape_string($_POST['a']);
				$b = htmlentities($_POST['b']);
				$which =$_POST['which'];
				$query = "INSERT into services_page (title, text, section) VALUES ('$a', '$b', $which);";
				echo $query;
				$result = mysql_query($query);
				mysql_close();
			} elseif (isset($_POST['editNews'])){
					include "includes/dbConnect.php";
					$a = mysql_escape_string($_POST['aedit']);
					$b = mysql_escape_string($_POST['bedit']);
					$i = $_POST['spid'];
					$row = $_POST['rownumber'];
					$query = "UPDATE services_page SET title='$a', text='$b' where spid=$i;";
					$result = mysql_query($query);
					mysql_close();
			} 
			displayServicesAdmin("");
			closePage();
	}
	?>
			
