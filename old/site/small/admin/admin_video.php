<?php
	session_start();
	include "always.php";

	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
			include "includes/dbConnect.php";
			include "video_tools.php";
			
			
			if (isset($_POST['add'])){

				include "includes/dbConnect.php";
				include "thumbs.php";
				$title = mysql_escape_string($_POST['title']);
				$code = htmlentities($_POST['code']);
				//echo "<br />CODE: ".$code."<br /><br />";
				$order = getLastOrder("vids");

				
				if (!get_magic_quotes_gpc()) {
					$query = sprintf("INSERT into talla_vids (`title`, `code`, `order`) VALUES ('%s', '%s', $order)", 
							          mysql_real_escape_string($title),
						            mysql_real_escape_string($code));
				} else {
					$query = sprintf("INSERT into talla_vids (`title`, `code`, `order`) VALUES ('%s', '%s', $order)", 
		          $title,$code);
				}
				
				
				//echo "Query:".$query."<br />";
				$result = mysql_query($query);
				mysql_close();
			} elseif (isset($_POST['edit'])){
					include "includes/dbConnect.php";
					include "thumbs.php";
					$title = mysql_escape_string($_POST['title']);
					$code = htmlentities($_POST['code']);
					$i = $_POST['vid'];
					
					$row = $_POST['rownumber'];
					
					
						if (!get_magic_quotes_gpc()) {
							$query = sprintf("UPDATE talla_vids SET `title`='%s', `code`='%s' where vid=$i", 
								          mysql_real_escape_string($title),
							            mysql_real_escape_string($text),
							            mysql_real_escape_string($code));
					} else {
						$query = sprintf("UPDATE talla_vids SET `title`='%s', `code`='%s' where vid=$i", 
								          $title,$text,$code);
					}
							
						
					//echo "<span style='color:white'>".$query."</span>";
					$result = mysql_query($query);
					mysql_close();
			} 
			displayVideoAdmin("");
			closePage();
	}
	?>
			
