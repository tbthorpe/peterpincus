<?php
	session_start();
	include "always.php";

	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
			include "includes/dbConnect.php";
			include "photo_tools.php";
			
			
			if (isset($_POST['add'])){
				include "includes/dbConnect.php";
				include "thumbs.php";
				$title = mysql_escape_string($_POST['title']);
				$text = htmlentities($_POST['text']);
				$thumb_text = htmlentities($_POST['thumb_text']);
				$order = getLastOrder("pg");
				$category = $_POST['category'];
				$gallery = $_POST['gallery'];
				
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
				
				$fileName_t = $_FILES['userfile_t']['name'];
				$tmpName_t  = $_FILES['userfile_t']['tmp_name'];
				$fileSize_t = $_FILES['userfile_t']['size'];
				$fileType_t = $_FILES['userfile_t']['type'];

				if ($fileName != ""){
		      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/gallery_images/" . $_FILES["userfile"]["name"]);
		      if ($fileName_t != ""){
		      	 move_uploaded_file($_FILES["userfile_t"]["tmp_name"],"images/gallery_images_thumbs/" . $_FILES["userfile_t"]["name"]);
		      	if (!get_magic_quotes_gpc()) {
						$query = sprintf("INSERT into mcdc_photos (`title`, `filename`, `filename_t`, `gallery`, `order`) VALUES ( '%s', '%s', '%s', '%s', $order)", 
							          mysql_real_escape_string($title),
						            mysql_real_escape_string($fileName),
						            mysql_real_escape_string($fileName_t),
						            mysql_real_escape_string($gallery));
						} else {
							$query = sprintf("INSERT into mcdc_photos (`title`, `filename`, `filename_t`, `gallery`, `order`) VALUES ( '%s', '%s', '%s', '%s', $order)", 
								          $title,$fileName,$fileName_t,$gallery);
						}
		      } else {
		      	if (!get_magic_quotes_gpc()) {
						$query = sprintf("INSERT into mcdc_photos (`title`, `filename`, `order`, `gallery`) VALUES ('%s', '%s', $order, '%s')", 
							          mysql_real_escape_string($title),
						            mysql_real_escape_string($text),
						            mysql_real_escape_string($gallery));
						} else {
							$query = sprintf("INSERT into mcdc_photos (`title`, `filename`, `order`, `gallery`) VALUES ('%s', '%s', $order, '%s')", 
								          $title,$text);
						}
		      }
				} else {
					echo "Yo, you didn't upload a photo OR a thumbnail.  wtf?<BR>";
				}
				
				$result = mysql_query($query);
				
			} elseif (isset($_POST['edit'])){
				//var_dump($_POST);
				//echo "<BR>";
				//var_dump($_FILES);
					include "includes/dbConnect.php";
					include "thumbs.php";
					$title = mysql_escape_string($_POST['title']);
					$text = mysql_escape_string($_POST['text']);
					$i = $_POST['gid'];
					$thumb = $_POST['rowthumb'];
					$row = $_POST['rownumber'];
					$category = $_POST['category'];
					$gallery = $_POST['gallery'];
					
					$fileName = $_FILES['userfile']['name'];
					$tmpName  = $_FILES['userfile']['tmp_name'];
					$fileSize = $_FILES['userfile']['size'];
					$fileType = $_FILES['userfile']['type'];
					
					
					
					//if ($fileName != ""){
			     // move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/gallery_images/" . $_FILES["userfile"]["name"]);
						//createthumb("images/gallery_images/".$fileName,"images/gallery_images_thumbs/tn_".$fileName,150,150);
						//createthumb("images/gallery_images/".$fileName,"images/gallery_images_thumbs/pu_".$fileName,300,300);
						//Insert the new picture into the photo holding database with the right gallery_id
						//$ph_query = sprintf("INSERT into dd_pg_photo (filename, gallery_gid) VALUES ('%s', $i)", 
					            //mysql_real_escape_string($fileName));
						//$result = mysql_query($ph_query);
						
						// Update the gallery holding database with the id, so it can go in the thumbnail field
						//$query = sprintf("UPDATE dd_pg_gallery SET title='%s', text='%s', thumb_pid=LAST_INSERT_ID(), last_update=NOW()  where gid=$i", 
						         // mysql_real_escape_string($title),
					            //mysql_real_escape_string($text));
						//$result = mysql_query($query);
					//} 
						// No file was uploaded. Don't gotta do shit but the text and title.
						if (!get_magic_quotes_gpc()) {
							$query = sprintf("UPDATE mcdc_photos SET title='%s', gallery=$gallery  where gid=$i", 
										mysql_real_escape_string($title),
										mysql_real_escape_string($gallery));
						} else {
							$query = sprintf("UPDATE mcdc_photos SET title='%s', gallery=$gallery  where gid=$i", 
										$title,$gallery);
						}
							$result = mysql_query($query);
									
					//echo "<span style='color:white'>".$query."</span>";
					
					
					
					
					mysql_close();
			} 
			displayPGAdmin("");
			closePage();
	}
	
	function lastOrder($id){
	include "includes/dbConnect.php";
	
			$query="SELECT * FROM dd_pg_photo where gallery_gid=$id ORDER BY order_num DESC LIMIT 1";
			
	$result=mysql_query($query);
	
	if (mysql_num_rows($result) == 0){
		return 0;
	} else {
		$order=mysql_result($result,0,"order_num");
		return $order+1;
	}
}
	?>
			
