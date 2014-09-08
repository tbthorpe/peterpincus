<?php

include "allTools.php";
include "green_tools.php";
include "always.php";
	session_start();
	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
		if (isset($_POST['createAttempt'])){
				include "includes/dbConnect.php";
				include "thumbs.php";
				$title = mysql_escape_string($_POST['title']);
				$text = mysql_escape_string($_POST['text']);
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
	      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/green_images/" . $_FILES["userfile"]["name"]);
				$query = "INSERT into green_page_pics (title, text, filename) VALUES ('$title', '$text', '$fileName');";
				$result = mysql_query($query);
				mysql_close();
				createthumb("images/green_images/".$fileName,"images/green_images_thumbs/tn_".$fileName,200,200);
				createthumb("images/green_images/".$fileName,"images/green_images/stillbig_".$fileName,300,300);
				displayGreenForm("");
				echo "</div>";
				echo "<img src='images/footer.jpg'>";
				echo "</div>";
				echo "</body>";
				echo "</html>";
		} elseif (isset($_POST['editAttempt'])){
							include "includes/dbConnect.php";
							include "thumbs.php";
							$date = date("Y-m-d g:i a");
							$title = mysql_escape_string($_POST['title']);
							$text = mysql_escape_string($_POST['text']);
							$i = $_POST['id'];
							$row = $_POST['rownumber'];
							$query = "UPDATE green_page_pics SET title='$title', text='$text' where gpid=$i;";
							$result = mysql_query($query);
							mysql_close();										
							displayGreenForm("");
							echo "</div>";								
							echo "<script>";
							echo "showEdit(\"row".$row."edit\");";
							echo "</script>";
							echo "<img src='images/footer.jpg'>";
							echo "</div>";
							echo "</body>";
							echo "</html>";
			
					} elseif(isset($_POST['textedit'])){
							include "includes/dbConnect.php";
							$a = htmlentities($_POST['aedit']);
							$ptid = $_POST['ptid'];
							$query = "UPDATE `page_text` SET `text`='$a' where `ptid`=$ptid;";
							$result = mysql_query($query) or die("nah bitch");
							displayGreenForm("");
							echo "</div>";
							echo "<img src='images/footer.jpg'>";
							echo "</div>";
							echo "</body>";
							echo "</html>";
						}else {
							displayGreenForm("");
							echo "</div>";
							
							echo "<img src='images/footer.jpg'>";
							echo "</div>";
							echo "</body>";
							echo "</html>";
					}
		
		?>
			
		<?php
	}
?>