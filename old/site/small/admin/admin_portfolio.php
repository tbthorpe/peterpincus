<?php

include "allTools.php";
include "portfolio_tools.php";
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
				$link = mysql_escape_string($_POST['link']);
				if ((substr($link, 0, 7) != 'http://') && $link != ''){
						$link = "http://".$link;
				}
				$fileName = $_FILES['userfile']['name'];
				$tmpName  = $_FILES['userfile']['tmp_name'];
				$fileSize = $_FILES['userfile']['size'];
				$fileType = $_FILES['userfile']['type'];
	      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/portfolio_images/" . $_FILES["userfile"]["name"]);
				$query = "INSERT into portfolio (title, text, link, filename) VALUES ('$title', '$text', '$link', '$fileName');";
				$result = mysql_query($query);
				mysql_close();
				createthumb("images/portfolio_images/".$fileName,"images/portfolio_images_thumbs/tn_".$fileName,140,140);
				createthumb("images/portfolio_images/".$fileName,"images/portfolio_images_thumbs/pu_".$fileName,300,300);
				displayPortfolioForm("");
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
							$link = mysql_escape_string($_POST['link']);
							echo "LINK: ".$link;
							if ((substr($link, 0, 7) != 'http://') && $link != ''){
									$link = "http://".$link;
							}
							$i = $_POST['id'];
							$row = $_POST['rownumber'];
							$query = "UPDATE portfolio SET title='$title', link='$link', text='$text' where pfid=$i;";
							$result = mysql_query($query);
							mysql_close();										
							displayPortfolioForm("");
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
							$title = mysql_escape_string($_POST['title']);
							$text = mysql_escape_string($_POST['text']);
							$which = mysql_escape_string($_POST['which']);
							$link = mysql_escape_string($_POST['link']);
							if ((substr($link, 0, 7) != 'http://') && $link != ''){
									$link = "http://".$link;
							}
							$fileName = $_FILES['userfile']['name'];
							$tmpName  = $_FILES['userfile']['tmp_name'];
							$fileSize = $_FILES['userfile']['size'];
							$fileType = $_FILES['userfile']['type'];
				      move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/portfolio_images_thumbs/" . $_FILES["userfile"]["name"]);
				      $thumb_fileName = $_FILES['realpic']['name'];
							$thumb_tmpName  = $_FILES['realpic']['tmp_name'];
							$thumb_fileSize = $_FILES['realpic']['size'];
							$thumb_fileType = $_FILES['realpic']['type'];
				      move_uploaded_file($_FILES["realpic"]["tmp_name"],"images/portfolio_images/" . $_FILES["realpic"]["name"]);
				      list($width, $height, $type, $attr) = getimagesize("images/portfolio_images/" . $_FILES["realpic"]["name"]);
							$query = "INSERT into portfolio_page (title, text, thumb_filename, filename, link, which, height, width) VALUES ('$title', '$text', '$thumb_fileName', '$fileName', '$link', $which, $height, $width);";
							echo $query;
							$result = mysql_query($query);
							mysql_close();
	
							displayPortfolioForm("");

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
							$ppid = mysql_escape_string($_POST['ppid']);
							$link = mysql_escape_string($_POST['link']);
							if ((substr($link, 0, 7) != 'http://') && $link != ''){
									$link = "http://".$link;
							}
							$query = "UPDATE portfolio_page SET title='$title', text='$text', link='$link', which=$which WHERE ppid=$ppid;";
							echo $query;
							$result = mysql_query($query);
							mysql_close();
	
							displayPortfolioForm("");

							echo "</div>";
							echo "<img src='images/footer.jpg'>";
							echo "</div>";
							echo "</body>";
							echo "</html>";
					} elseif(isset($_POST['createBox2Attempt'])){
						
					} elseif(isset($_POST['editBox2Attempt'])){
						
					} elseif(isset($_POST['createBox3Attempt'])){
						
					} elseif(isset($_POST['editBox3Attempt'])){
						
					} 
					
					else {
							displayportfolioForm("");
							
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