<?php
	session_start();
	include "always.php";

	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
			include "includes/dbConnect.php";
			include "link_tools.php";
			
			
			if (isset($_POST['add'])){
				include "includes/dbConnect.php";
				//include "thumbs.php";
				$text = htmlentities($_POST['text']);
				$link = htmlentities($_POST['link']);
				if ((substr($link, 0, 7) != 'http://')&& $link != ''){
									$link = "http://".$link;
							}
				$cat = htmlentities($_POST['category']);
				$order = lastOrder($cat);
				
				
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];

				if ($fileName != ""){
		      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/links_images/" . $_FILES["userfile"]["name"]);
					
					$query = sprintf("INSERT into dd_links (l_text, url, category, filename, image, order_num) VALUES ('%s', '%s', $cat, '%s', 1, $order)", 
						          mysql_real_escape_string($text),
						          mysql_real_escape_string($link),
					            mysql_real_escape_string($fileName));
					//echo "<span style='color:white'>".$query."</span>";
					$result2 = mysql_query($query); 
				} else {
					$query = sprintf("INSERT into dd_links (l_text, url, category, filename, image, order_num) VALUES ('%s', '%s', $cat, '', 1, $order)", 
						          mysql_real_escape_string($text),
					            mysql_real_escape_string($link));
					$result = mysql_query($query);  
				}
				
				mysql_close();
			} elseif (isset($_POST['edit'])){

					include "includes/dbConnect.php";
						$text = htmlentities($_POST['text']);
						$link = htmlentities($_POST['link']);
						if ((substr($link, 0, 7) != 'http://')&& $link != ''){
											$link = "http://".$link;
									}
						$cat = htmlentities($_POST['category']);
							$id = $_POST['lid'];
							$row = $_POST['rownumber'];
							
							$fileName = $_FILES['userfile']['name'];
							$tmpName  = $_FILES['userfile']['tmp_name'];
							$fileSize = $_FILES['userfile']['size'];
							$fileType = $_FILES['userfile']['type'];
							
							if ($fileName != ""){
				      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/links_images/" . $_FILES["userfile"]["name"]);
							
							$query = sprintf("UPDATE dd_links set l_text='%s', url='%s', category=$cat, filename='%s' where lid=$id", 
								          mysql_real_escape_string($text),
								          mysql_real_escape_string($link),
							            mysql_real_escape_string($fileName));
							//echo "<span style='color:white'>".$query."</span>";
							//$result2 = mysql_query($query); 
						} else {
							if ($remove == 0){
									$query = sprintf("UPDATE dd_links set l_text='%s', url='%s', category=$cat where lid=$id", 
								          mysql_real_escape_string($text),
								          mysql_real_escape_string($link));
							          // echo "<span style='color:white'>".$query."</span>";
								} else {
									$query = sprintf("UPDATE dd_links set l_text='%s', url='%s', category=$cat, filename='' where lid=$id", 
								          mysql_real_escape_string($text),
								          mysql_real_escape_string($link));
							           // echo "<span style='color:white'>".$query."</span>";
								}
							
							$result = mysql_query($query);  
						}
						mysql_close();
			} 
			displayLinkAdmin("");
			closePage();
	}
	
	function lastOrder($cat){
	include "includes/dbConnect.php";
	
			$query="SELECT * FROM dd_links where category=$cat ORDER BY order_num DESC LIMIT 1";
			
	$result=mysql_query($query);
	
	if (mysql_num_rows($result) == 0){
		return 0;
	} else {
		$order=mysql_result($result,0,"order_num");
		return $order+1;
	}
}
	?>
			
