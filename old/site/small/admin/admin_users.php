<?php
session_start();
include "includes/dbConnect_old2.php";
include "always.php";
include "allTools.php";
include "user_tools.php";
	session_start();
	if (!isset ($_SESSION['bobloblaw'])){
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
			session_destroy();
	}
	else {
		
		if (isset($_POST['addAttempt'])){
				$uname = mysql_escape_string($_POST['uname']);
				if (checkUserName($uname)){
					//THIS ALL MEANS THE USERNAME IS UNIQUE - CONTINUE

					$upass = mysql_escape_string($_POST['upass']);
					$first = mysql_escape_string($_POST['first']);
					$last = mysql_escape_string($_POST['last']);
					$dirs = mysql_escape_string($_POST['dirs']);
					
					$query = "INSERT into `user_table` (`add_date`,`uname`, `upass`, `firstname`,`lastname`,`folder_list`) VALUES (NOW(),'$uname','$upass','$first','$last','$dirs');";
					$result = mysql_query($query);
					
					//making the users home directory
					mkdir("images/userphotos/".$uname."_");
					
					//making the directories inside, for the pictures
					if ($dirs != ""){
						$folders = explode(",",$dirs);
						$len = count($folders);
						for ($i=0; $i < $len; $i++){
							mkdir("images/userphotos/".$uname."_/".$folders[$i]);	
						}
					}
		
		
						
					displayUserForm("");
					echo "<div id=\"AdminTable\">";
					displayUserAdmin("");
					echo "</div>";
					echo "</div>";
					echo "</body>";
					echo "</html>";
		
		
					mysql_close();
			} else{
					//THIS MEANS THE USERNAME WAS NOT UNIQUE.  TRY AGAIN						
					displayUserForm("Username \"".$uname."\" is not unique.  Try again.<BR>");
					echo "<div id=\"AdminTable\">";
					displayUserAdmin("");
					echo "</div>";
					echo "</div>";
					echo "</body>";
					echo "</html>";
			}
		} else {
				if (isset($_POST['editAttempt'])){
					include "includes/dbConnect_old2.php";
					$uname = mysql_escape_string($_POST['uname']);
					$upass = mysql_escape_string($_POST['upass']);
					$first = mysql_escape_string($_POST['first']);
					$last = mysql_escape_string($_POST['last']);
					$uid = mysql_escape_string($_POST['uid']);
					$olddirectories = mysql_escape_string($_POST['olddirs']);
					$directories = mysql_escape_string($_POST['newdirs']);
					$dirs = $olddirectories.",".$directories;

						
					$query = "UPDATE `user_table` SET `upass`='$upass',`firstname`='$first',`lastname`='$last',`folder_list`='$dirs' where `uid`=$uid;";
					$result2 = mysql_query($query);
							echo "UNAME is: ".$uname."<BR>";
					//making the directories inside, for the pictures
					if ($directories != ""){
						$folders = explode(",",$directories);
						$len = count($folders);
						for ($i=0; $i < $len; $i++){
							mkdir("images/userphotos/".$uname."_/".$folders[$i]);	
						}
					}

					
					mysql_close();
					displayUserForm("That picture has been updated.");
					echo "<div id=\"AdminTable\">";
					displayUserAdmin("");
					echo "</div>";
					echo "<script>";
					echo "showEdit(\"row".$row."edit\");";
					echo "</script>";
							
							
						
		echo "</div>";
		echo "</body>";
		echo "</html>";



					} else {
						displayUserForm("");
						echo "<div id=\"AdminTable\">";
							displayUserAdmin("aaa");
		echo "</div>";

						echo "</div>";
		echo "</body>";
		echo "</html>";
					}
		}
		?>
			
		<?php
	}
?>