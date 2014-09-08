<?php
	session_start();
	include "always.php";

	if (!isset ($_SESSION['bobloblaw'])){
			session_destroy();
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
	}
	else {
			include "includes/dbConnect.php";
			include "tour_tools.php";
			
			
			if (isset($_POST['add'])){
				include "includes/dbConnect.php";
				$month = mysql_escape_string($_POST['month']);
				$year = mysql_escape_string($_POST['year']);
				$day = mysql_escape_string($_POST['day']);
				$time = mysql_escape_string($_POST['time']);
				$venue = mysql_escape_string($_POST['venue']);
				$location = mysql_escape_string($_POST['location']);
				$features = mysql_escape_string($_POST['features']);
				
				//print_r($_POST);
				
				if (!get_magic_quotes_gpc()) {
					$query = sprintf("INSERT into talla_tour (`month`, `month_en`, `day`, `year`, `time`, `venue`, `location`, `features`) VALUES (%u, MONTHNAME('%u-%u-%u'), %u, %u, '%s', '%s', '%s', '%s')", 
							          mysql_real_escape_string($month),
						            mysql_real_escape_string($year),
						            mysql_real_escape_string($month),
						            mysql_real_escape_string($day),
						            mysql_real_escape_string($day),
						            mysql_real_escape_string($year),
						            mysql_real_escape_string($time),
						            mysql_real_escape_string($venue),
						            mysql_real_escape_string($location),
						            mysql_real_escape_string($features));
				} else {
					$query = sprintf("INSERT into talla_tour (`month`, `month_en`, `day`, `year`, `time`, `venue`, `location`, `features`) VALUES (%u, MONTHNAME('%u-%u-%u'), %u, %u, '%s', '%s', '%s', '%s')", 
		          $month,$year,$month,$day,$day,$year,$time,$venue,$location,$features);
				}
				//echo "<br><br>Query: ".$query."<BR>";
				$result = mysql_query($query);
				mysql_close();
			} elseif (isset($_POST['edit'])){
					include "includes/dbConnect.php";
	
					$month = mysql_escape_string($_POST['month']);
					$year = mysql_escape_string($_POST['year']);
					$day = mysql_escape_string($_POST['day']);
					$time = mysql_escape_string($_POST['time']);
					$venue = mysql_escape_string($_POST['venue']);
					$location = mysql_escape_string($_POST['location']);
					$features = mysql_escape_string($_POST['features']);
					$i = $_POST['sid'];
					
					$row = $_POST['rownumber'];

						if (!get_magic_quotes_gpc()) {
							$query = sprintf("UPDATE talla_tour SET month=%u, month_en=MONTHNAME('%u-%u-%u'), day=%u, year=%u, time='%s', venue='%s', location='%s', features='%s' where sid=$i", 
								        mysql_real_escape_string($month),
						            mysql_real_escape_string($year),
						            mysql_real_escape_string($month),
						            mysql_real_escape_string($day),
						            mysql_real_escape_string($day),
						            mysql_real_escape_string($year),
						            mysql_real_escape_string($time),
						            mysql_real_escape_string($venue),
						            mysql_real_escape_string($location),
						            mysql_real_escape_string($features));
					} else {
						$query = sprintf("UPDATE talla_tour SET month=%u, month_en=MONTHNAME('%u-%u-%u'), day=%u, year=%u, time='%s', venue='%s', location='%s', features='%s' where sid=$i", 
								          $month,$year,$month,$day,$day,$year,$time,$venue,$location,$features);
					}
					$result = mysql_query($query);
					mysql_close();
			} 
			displayTourAdmin("");
			closePage();
	}
	?>
			
