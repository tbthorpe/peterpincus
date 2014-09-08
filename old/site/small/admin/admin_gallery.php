<?php
session_start();
include "includes/dbConnect_old2.php";
include "always.php";
include "allTools.php";
include "gal_tools.php";
	session_start();
	if (!isset ($_SESSION['bobloblaw'])){
			displayLoginForm("You're not logged in yet.  Do this and go to the main admin page.");
			session_destroy();
	}
	else {
				
		if (isset($_POST['uploadAttempt'])){

			include "thumbs.php";
			$date = date("Y-m-d g:i a");
			$title = mysql_escape_string($_POST['title']);
			$text = mysql_escape_string($_POST['text']);
			
			$fileName = $_FILES['userfile']['name'];
			$tmpName  = $_FILES['userfile']['tmp_name'];
			$fileSize = $_FILES['userfile']['size'];
			$fileType = $_FILES['userfile']['type'];
			
			$query = "INSERT into `fj_photo_gallery` (`title`, `text`, `filename`,`category`,`create_date`) VALUES ('$title','$text','$fileName',1,NOW());";
		
			$result = mysql_query($query);
			
			//$dir = "images/gallery";
		//	$thumbdir = "images/gallery_thumbs";
		
		//	if ($fileName != ""){
		//		move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/gallery/". $_FILES["userfile"]["name"]);
		//		$t_file = "images/gallery/" .$_FILES['userfile']['name'];
    //  	$mysizes = getimagesize($t_file);
		//		createthumb("images/gallery/".$fileName,"images/gallery_thumbs/tn_".$fileName,150,150,1);
		//	}	
		
		
			$query = "SELECT * FROM fj_photo_gallery order by create_date DESC LIMIT 1";

			$result = mysql_query($query);
			$i=mysql_result($result,0,"pid");
			
			$dir = "images/gallery/".$i;
			$thumbdir = "images/gallery/".$i."_thumbs";
		
			mkdir($dir);
			mkdir($thumbdir);
		
			if ($fileName != ""){
				$lkk = move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/gallery/".$i."/". $_FILES["userfile"]["name"]);
		
				//$t_file = "images/gallery/".$i .$_FILES['userfile']['name'];
      	//$mysizes = getimagesize($t_file);
				createthumb("images/gallery/".$i."/".$fileName,"images/gallery/".$i."_thumbs/tn_".$fileName,200,200,1);
					$size = getimagesize("images/gallery/".$i."/".$fileName);	
					$height = $size[1];
					$width = $size[0];
					$query = "INSERT into fj_gallery_pics (add_date, gal_id, pic_desc, filename, order_num, height, width) VALUES (NOW(), $i, '$imageText', '$fileName', 1, $height, $width)" ;
					$result = mysql_query($query);
					$q2 = "update fj_photo_gallery SET thumb_pid = LAST_INSERT_ID() where pid=$i";
					$result = mysql_query($q2);
				}
				
				
			displayGalForm("");
			echo "<div id=\"AdminTable\">";
			displayGalAdmin("");
			echo "</div>";
			echo "</div>";
			echo "</body>";
			echo "</html>";


			
		} else {
				if (isset($_POST['editGalAttempt'])){
					include "includes/dbConnect_old2.php";
					include "thumbs.php";
	
				//UPDATES THE FIRST PANE OF STUFF - TEXT AND THUMBNAIL
					$title = mysql_escape_string($_POST['title']);
					$text = mysql_escape_string($_POST['text']);
					
					$pid = $_POST['pid'];
					$row = $_POST['rownumber'];
					$oPreExist = $_POST['ope'];
					$deleteThese = $_POST['PEDelete'];
					if (isset($_POST['rowthumb'])){
						$thumbadd = ",`thumb_pid` = ".$_POST['rowthumb'];
					} else { 
						$thumbadd = ""; 
					}
						
					$query = "UPDATE `fj_photo_gallery` SET `title`='$title', `text`='$text'".$thumbadd." where `pid`=$pid;";
					
					$result2 = mysql_query($query) or die('couldnt do itdsf');
							

					//HERE IS WHERE I WILL UPLOAD ANY CHANGES OR ADDITIONS TO THE IMAGES
					$query = "select * from fj_gallery_pics where gal_id=$pid;";
					$result = mysql_query($query);
					$rows = mysql_numrows($result);
					
					//	THE FOLLOWING IS UPDATES TO PRE EXISTING PICTURES
					for ($s = 0; $s < $rows; $s = $s+1){
						$o = "PEImage".$s."order";
						$d = "PE".$s."Delete";
						
						if (isset($_POST[$d])){
							$d = $_POST[$d];
							$query = "delete from `fj_gallery_pics` where `pid`=$d";
							
							$result = mysql_query($query) or die('couldnt do itsss');
						}
						$order = $_POST[$o];
						list($id, $neworder) = split('x', $order);
						if ($neworder >= $rows){
								$neworder = $neworder - ($oPreExist - $rows);
						}
						$query = "UPDATE fj_gallery_pics SET order_num=$neworder where pid=$id";
						$result = mysql_query($query) or die('couldnt do itaaa');
					} 
					
					$title=mysql_result($result,0,"title");
					//echo "<BR>".sizeof($_FILES["galimages"])."<BR>";
					//var_dump($_FILES);
							for ($count = 0; $count < count($_FILES['galimages']); $count = $count+1){
							
									$fileName = $_FILES["galimages"]["name"][$count];
									$tmpName  = $_FILES["galimages"]["tmp_name"][$count];
									$fileSize = $_FILES["galimages"]["size"][$count];
									$fileType = $_FILES["galimages"]["type"][$count];
									$t = "image".$count."text";
									$o = "image".$count."order";
								//	echo "<BR>".$t."<BR>".$o."<BR>";
									$imageText = mysql_escape_string($_POST[$t]);
									$order = $_POST[$o];
									
									if ($fileName != ""){
										// $aa = move_uploaded_file($_FILES["userfile"]["tmp_name"],"images/gallery/".$i."/". $_FILES["userfile"]["name"]);
										// echo $aa."<BR>";
										 //$t_file = "images/gallery/".$i."/".$_FILES["galimages"]['name'];
		      					$lkk = move_uploaded_file($_FILES["galimages"]["tmp_name"][$count],"images/gallery/".$pid."/". $_FILES["galimages"]["name"][$count]);

										createthumb("images/gallery/".$pid."/".$fileName,"images/gallery/".$pid."_thumbs/tn_".$fileName,200,200,1);
										$size = getimagesize("images/gallery/".$pid."/".$fileName);	
										$height = $size[1];
										$width = $size[0];
										$query = "INSERT into fj_gallery_pics (add_date, gal_id, pic_desc, filename, order_num, height, width) VALUES (NOW(), $pid, '$imageText', '$fileName', $order, $height, $width)" ;
									echo $query;
											//createthumb("images/gallery/".$pid."/".$fileName,"images/gallery/".$pid."_thumbs/tn_".$fileName,100,100,1);
											$result = mysql_query($query);
									} 
								}
					
					mysql_close();
					displayGalForm("That picture has been updated.");
					echo "<div id=\"AdminTable\">";
					displayGalAdmin("");
					echo "</div>";
					echo "<script>";
					echo "showEdit(\"row".$row."edit\");";
					echo "</script>";
							
							
						
		echo "</div>";
		echo "</body>";
		echo "</html>";



					} else {
						displayGalForm("");
						echo "<div id=\"AdminTable\">";
							displayGalAdmin("aaa");
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