<?php

include "allTools.php";
include "info_tools.php";
include "always.php";
	session_start();
	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
		if (isset($_POST['upPicAttempt'])){
				include "includes/dbConnect.php";
				include "thumbs.php";
				$title = mysql_escape_string($_POST['title']);
				$text = mysql_escape_string($_POST['text']);

				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
	      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/info_images/" . $_FILES["userfile"]["name"]);
	      list($width, $height, $type, $attr) = getimagesize("images/info_images/" . $_FILES["userfile"]["name"]);
				$query = "INSERT into info (title, text, filename, height, width) VALUES ('$title', '$text', '$fileName', $height, $width);";
				$result = mysql_query($query);
				mysql_close();
				createthumb("images/info_images/".$fileName,"images/info_images_thumbs/tn_".$fileName,200,200);
				createthumb("images/info_images/".$fileName,"images/info_images_thumbs/stillbig_".$fileName,300,300);
				displayInfoForm("");
				echo "</div>";
											echo "<img src='images/footer.jpg'>";
							echo "</div>";
				echo "</body>";
				echo "</html>";
		} elseif (isset($_POST['editPicAttempt'])){
			var_dump($_POST);
							include "includes/dbConnect.php";
							include "thumbs.php";
							$title = mysql_escape_string($_POST['title']);
							$text = mysql_escape_string($_POST['text']);
							$i = $_POST['id'];
							$row = $_POST['rownumber'];
							$query = "UPDATE info SET title='$title', text='$text' where iid=$i;";
							$result = mysql_query($query);
							mysql_close();										
							displayInfoForm("");
							echo "</div>";								
							echo "<script>";
							echo "showEdit(\"row".$row."edit\");";
							echo "</script>";
							echo "<img src='images/footer.jpg'>";
							echo "</div>";
							echo "</body>";
							echo "</html>";
			
					} elseif(isset($_POST['createBoxAttempt'])){
							include "includes/dbConnect.php";
							include "thumbs.php";
							$title = mysql_escape_string($_POST['title']);
							$text = mysql_escape_string($_POST['text']);
							$which = mysql_escape_string($_POST['which']);
							$quicktext = mysql_escape_string($_POST['quicktext']);
							$price = mysql_escape_string($_POST['price']);
							$link = mysql_escape_string($_POST['link']);
							if ((substr($link, 0, 7) != 'http://') && $link != ''){
									$link = "http://".$link;
							}
							$fileName = $_FILES['userfile']['name'];
							$tmpName  = $_FILES['userfile']['tmp_name'];
							$fileSize = $_FILES['userfile']['size'];
							$fileType = $_FILES['userfile']['type'];
				      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/info_images/" . $_FILES["userfile"]["name"]);
				      createthumb("images/info_images/".$fileName,"images/info_images_thumbs/tn_".$fileName,140,140);
							$query = "INSERT into info_page (title, text, link, which, price, filename, quicktext) VALUES ('$title', '$text', '$link', $which, '$price', '$fileName', '$quicktext');";
							echo $query;
							$result = mysql_query($query);
							mysql_close();
	
							displayInfoForm("");

							echo "</div>";
							echo "<img src='images/footer.jpg'>";
							echo "</div>";
							echo "</body>";
							echo "</html>";
							
					} elseif(isset($_POST['editBoxAttempt'])){
												include "includes/dbConnect.php";
							$title = mysql_escape_string($_POST['title']);
							$text = mysql_escape_string($_POST['text']);
							$which = mysql_escape_string($_POST['which']);
							$ipid = mysql_escape_string($_POST['id']);
							$price = mysql_escape_string($_POST['price']);
							$quicktext = mysql_escape_string($_POST['quicktext']);
							$link = mysql_escape_string($_POST['link']);
							if ((substr($link, 0, 7) != 'http://') && $link != ''){
									$link = "http://".$link;
							}
							$query = "UPDATE info_page SET title='$title', text='$text', link='$link', price='$price', quicktext='$quicktext', which=$which WHERE ipid=$ipid;";
							echo $query;
							$result = mysql_query($query);
							mysql_close();
	
							displayInfoForm("");

							echo "</div>";
							echo "<img src='images/footer.jpg'>";
							echo "</div>";
							echo "</body>";
							echo "</html>";
					} elseif (isset($_POST['editRules'])){
						echo "asdf";
						include "includes/dbConnect.php";
						echo "3";
						$rules = $_POST['title'].$_POST['text'].$_POST['price'].$_POST['link'];
						echo "rules";
						$id = $_POST['id'];
						$query = "UPDATE sections SET display_rules=$rules where sid=$id;";
						$result = mysql_query($query);
						displayInfoForm("");
						echo "</div>";
							echo "<img src='images/footer.jpg'>";
							echo "</div>";
						echo "</body>";
						echo "</html>";
					}  elseif(isset($_POST['editBox2Attempt'])){
						
					} elseif(isset($_POST['createBox3Attempt'])){
						
					} elseif(isset($_POST['editBox3Attempt'])){
						
					} 
					
					else {
							displayInfoForm("");
							
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