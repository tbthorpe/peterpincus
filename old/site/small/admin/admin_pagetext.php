<?php
	session_start();
	include "always.php";

	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
			include "includes/dbConnect_old2.php";
			include "pageText_tools.php";
			include "pageText_tools2.php";

			if (isset($_POST['editPTAttempt'])){
				include "includes/dbConnect_old2.php";
				$a = htmlentities($_POST['aedit']);
				$ptid = $_POST['ptid'];
				$query = "UPDATE `page_text` SET `page_text`='$a' where `ptid`=$ptid;";
				$result = mysql_query($query);
				mysql_close();
				
				displayPageTextAdmin("");
				closePage();	
			} 
			else {
				displayPageTextAdmin("");
				closePage();
			} 
	}
	?>
			
