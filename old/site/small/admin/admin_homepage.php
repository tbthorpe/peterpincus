<?php
	session_start();
	include "always.php";

	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
			include "includes/dbConnect.php";
			include "homepage_tools.php";
			
			
			if (isset($_POST['add'])){
				include "includes/dbConnect.php";
				include "thumbs.php";
				$title = mysql_escape_string($_POST['title']);
				$text = htmlentities($_POST['text']);
				$order = getLastOrder("news");
				
				
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
				
				if (!get_magic_quotes_gpc()) {
					$query = sprintf("INSERT into mcdc_news (date_added, title, text, filename, order_num) VALUES (NOW(), '%s', '%s', '%s', $order)", 
							          mysql_real_escape_string($title),
						            mysql_real_escape_string($text),
						            mysql_real_escape_string($fileName));
				} else {
					$query = sprintf("INSERT into mcdc_news (date_added, title, text, filename, order_num) VALUES (NOW(), '%s', '%s', '%s', $order)", 
		          $title,$text,$fileName);
				}
				if ($fileName != ""){
		      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/news_images/" . $_FILES["userfile"]["name"]);
					createthumb("images/news_images/".$fileName,"images/news_images_thumbs/tn_".$fileName,150,150);
					createthumb("images/news_images/".$fileName,"images/news_images_thumbs/pu_".$fileName,300,300);
				} else {
					if (!get_magic_quotes_gpc()) {
						$query = sprintf("INSERT into mcdc_news (date_added, title, text, order_num) VALUES (NOW(), '%s', '%s', $order)", 
						          mysql_real_escape_string($title),
					            mysql_real_escape_string($text));
					} else {
						$query = sprintf("INSERT into mcdc_news (date_added, title, text, order_num) VALUES (NOW(), '%s', '%s', $order)", 
						         $title,$text);
					}
				}
				
				//echo "<span style='color:white'>".$query."</span>";
				$result = mysql_query($query);
				mysql_close();
			} elseif (isset($_POST['edit'])){
					include "includes/dbConnect.php";
					include "thumbs.php";
					$title = mysql_escape_string($_POST['title']);
					$text = addslashes($_POST['text']);
					$i = $_POST['nid'];
					
					$row = $_POST['rownumber'];
					
					$fileName = $_FILES['userfile']['name'];
					$tmpName  = $_FILES['userfile']['tmp_name'];
					$fileSize = $_FILES['userfile']['size'];
					$fileType = $_FILES['userfile']['type'];
						if (!get_magic_quotes_gpc()) {
							$query = sprintf("UPDATE mcdc_news SET title='%s', text='%s', filename='%s' where nid=$i", 
								          mysql_real_escape_string($title),
							            mysql_real_escape_string($text),
							            mysql_real_escape_string($fileName));
					} else {
						$query = sprintf("UPDATE mcdc_news SET title='%s', text='%s', filename='%s' where nid=$i", 
								          $title,$text,$fileName);
					}
							
					if ($fileName != ""){
			      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/news_images/" . $_FILES["userfile"]["name"]);
						createthumb("images/news_images/".$fileName,"images/news_images_thumbs/tn_".$fileName,150,150);
						createthumb("images/news_images/".$fileName,"images/news_images_thumbs/pu_".$fileName,300,300);
					} else {
						if (!get_magic_quotes_gpc()) {
							$query = sprintf("UPDATE mcdc_news SET title='%s', text='%s' where nid=$i", 
										mysql_real_escape_string($title),
										mysql_real_escape_string($text));
						} else {
							$query = sprintf("UPDATE mcdc_news SET title='%s', text='%s' where nid=$i", 
										$title,$text);
						}
					}					
					//echo "<span style='color:white'>".$query."</span>";
					$result = mysql_query($query);
					mysql_close();
			} 
			displayHomePageAdmin("");
			closePage();
	}
	?>
			
