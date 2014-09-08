<?php
	session_start();
	include "always.php";

	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
			include "includes/dbConnect.php";
			include "album_tools.php";
			
			
			if (isset($_POST['add'])){
				include "includes/dbConnect.php";
				$title = mysql_escape_string($_POST['title']);
				$release = mysql_escape_string($_POST['release']);
				$tracks = addslashes($_POST['tracks']);
				$other = htmlentities($_POST['other']);
				$order = getLastOrder("news");
				
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
				
				if (!get_magic_quotes_gpc()) {
					$query = sprintf("INSERT into talla_discog (`title`, `release`, `tracks`, `filename`, `other`) VALUES ( '%s', '%s', '%s', '%s', '%s')", 
							          mysql_real_escape_string($title),
						            mysql_real_escape_string($release),
						            mysql_real_escape_string($tracks),
						            mysql_real_escape_string($fileName),
						            addslashes(mysql_real_escape_string($other)));
				} else {
					$query = sprintf("INSERT into talla_discog (`title`, `release`, `tracks`, `filename`, `other`) VALUES ( '%s', '%s', '%s', '%s', '%s')", 
		          $title,$release,$tracks,$fileName,addslashes($other));
				}
				if ($fileName != ""){
		      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/album_images/" . $_FILES["userfile"]["name"]);
					//createthumb("images/news_images/".$fileName,"images/album_thumbs/tn_".$fileName,250,250);
					//createthumb("images/news_images/".$fileName,"images/news_images_thumbs/pu_".$fileName,300,300);
				} else {
					if (!get_magic_quotes_gpc()) {
						$query = sprintf("INSERT into talla_discog (`title`, `release`, `tracks`, `other`) VALUES ( '%s', '%s', '%s', '%s')", 
						          mysql_real_escape_string($title),
						            mysql_real_escape_string($release),
						            mysql_real_escape_string($tracks),
						            addslashes(mysql_real_escape_string($other)));
					} else {
						$query = sprintf("INSERT into talla_discog (`title`, `release`, `tracks`, `other`) VALUES ( '%s', '%s', '%s', '%s')",
						         $title,$release,$tracks,addslashes($other));
					}
				}
				
				//echo "<span style='color:white'>".$query."</span>";

				$result = mysql_query($query);
				mysql_close();
			} elseif (isset($_POST['edit'])){
					include "includes/dbConnect.php";
					$title = mysql_escape_string($_POST['title']);
					$release = mysql_escape_string($_POST['release']);
					$tracks = addslashes($_POST['tracks']);
					$other = htmlentities($_POST['other']);
					$i = $_POST['aid'];
					
					$row = $_POST['rownumber'];
					
					$fileName = $_FILES['userfile']['name'];
					$tmpName  = $_FILES['userfile']['tmp_name'];
					$fileSize = $_FILES['userfile']['size'];
					$fileType = $_FILES['userfile']['type'];
					
					//print_r($_FILES);
					//echo "<BR><BR>";
						if (!get_magic_quotes_gpc()) {
							$query = sprintf("UPDATE talla_discog SET `title`='%s', `release`='%s', `tracks`='%s', `filename`='%s', `other`='%s' where `aid`=$i", 
								          mysql_real_escape_string($title),
						            mysql_real_escape_string($release),
						            mysql_real_escape_string($tracks),
						            mysql_real_escape_string($fileName),
						            mysql_real_escape_string($other));
					} else {
						$query = sprintf("UPDATE talla_discog SET `title`='%s', `release`='%s', `tracks`='%s', `filename`='%s', `other`='%s' where `aid`=$i", 
								          $title,$release,$tracks,$fileName,$other);
					}
							
					if ($fileName != ""){
			      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/album_images/" . $_FILES["userfile"]["name"]);
					} else {
						if (!get_magic_quotes_gpc()) {
							$query = sprintf("UPDATE talla_discog SET `title`='%s', `release`='%s', `tracks`='%s', `other`='%s' where `aid`=$i", 
										mysql_real_escape_string($title),
						            mysql_real_escape_string($release),
						            mysql_real_escape_string($tracks),
						            mysql_real_escape_string($other));
						} else {
							$query = sprintf("UPDATE talla_discog SET `title`='%s', `release`='%s', `tracks`='%s', `other`='%s' where `aid`=$i", 
								          $title,$release,$tracks,$other);
						}
					}					
					//echo "<span style='color:white'>".$query."</span>";
					//echo "Query:".$query."<BR>";
					$result = mysql_query($query);
					mysql_close();
			} 
			displayAlbumAdmin("");
			closePage();
	}
	?>
			
