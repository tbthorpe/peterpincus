<?php

function showImages($id,$row, $before){
		include "includes/dbConnect.php";
		
		$query = "select * from `fj_photo_gallery` where `pid`=$id;";
		
		$result = mysql_query($query);
		$tpid=mysql_result($result,$i,"thumb_pid");
		
		$query="SELECT * FROM `fj_gallery_pics` where `gal_id`=$id ORDER BY `order_num` ASC";
	//	echo "asdf";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		mysql_close();
		$i=0;
		
		while ($i < $num) {
			$picdesc=mysql_result($result,$i,"pic_desc");
			$filename=mysql_result($result,$i,"filename");
			$ordernum=mysql_result($result,$i,"order_num");
			$pid=mysql_result($result,$i,"pid");
			
			//$pid=mysql_result($result,$i,"pid");
				echo "<fieldset class=\"galthumb\" id=\"tnail".$pid."\"><a  title=\"".$picdesc."\" href=\"images/gallery/".$id."/".$filename."\" rel=\"lightbox[".$id."]\"><img src=\"images/gallery/".$id."_thumbs/tn_".$filename."\"></a><br>";
					showOrderSelector($id, $i, $ordernum, $pid, "fj_gallery_pics", $before);
					if ($tpid == $pid){
						echo "<input type='radio' name='rowthumb' value=".$pid." checked>";
					} else {
						echo "<input type='radio' name='rowthumb' value=".$pid.">";
					}
					echo "&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"PE".$i."Delete\" VALUE=".$pid."> [x]?</fieldset>";
					//echo "&nbsp;<input type=\"checkbox\" value=\"Delete\" name=\"PEDelete\"></fieldset>";
					//echo "&nbsp;<input type=\"button\" value=\"Delete\" onClick=\"removeGalPic('gallery_pics', $id, $pid, $row, $ordernum);\"></fieldset>";
			$i++;
		}
		echo "<input type=\"hidden\" name=\"ope\" value=".$num.">";
		mysql_free_result($result);
		return $i;
}


function putGalImageEditDiv($gid, $ct, $before){
	
		include "includes/dbConnect.php";
	
	
		showImages($gid, $ct, $before);
	//echo "</div><BR>";
		
			$query="SELECT * FROM `fj_photo_gallery` where `pid`=$gid;";

		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		mysql_close();
		$i=0;
		
		
			$title=mysql_result($result,$i,"title");
			$galdesc=mysql_result($result,$i,"text");
	
//	if ($before != -1){
		//	echo "<span style=\"background: red; color: white; clear: both;\">An image has been deleted, and if there were images that had an order number greater than: ".$before.", they have been shifted down, but not saved in the database.  It would be wise to click on the 'Edit this Gallery' button in order to avoid confusion.</span>";
//	}
	echo "<fieldset class=\"borderless editDiv hidden\" style=\"clear: both;\" id=\"row".$ct."ImageEditDiv\" >";
	echo "<HR>";
	
					echo "<input class='newPostInput' name='galimages[]' type='file' id='userfile' onKeyUp='doOnChange(this);'><BR>";
					echo "<input class=\"newPostInput\" type=\"text\" name=\"image0text\">&nbsp;";
					showOrderSelector($gid, 0,0,-1,"fj_gallery_pics", $before);
					echo "<BR><BR>";
					echo "<input class=\"newPostInput\" name=\"galimages[]\" type=\"file\" id=\"userfile\" onKeyUp=\"doOnChange(this);\"><BR>";
					echo "<input class=\"newPostInput\" type=\"text\" name=\"image1text\">&nbsp;";
					showOrderSelector($gid, 1,0,-1,"fj_gallery_pics", $before);
					echo "<BR><BR>";
					echo "<input class=\"newPostInput\" name=\"galimages[]\" type=\"file\" id=\"userfile\" onKeyUp=\"doOnChange(this);\"><BR>";
					echo "<input class=\"newPostInput\" type=\"text\" name=\"image2text\">&nbsp;";
					showOrderSelector($gid, 2,0,-1,"fj_gallery_pics", $before);
					echo "<BR><BR>";
					echo "<input class=\"newPostInput\" name=\"galimages[]\" type=\"file\" id=\"userfile\" onKeyUp=\"doOnChange(this);\"><BR>";
					echo "<input class=\"newPostInput\" type=\"text\" name=\"image3text\">&nbsp;";
					showOrderSelector($gid, 3,0,-1,"fj_gallery_pics", $before);
					echo "<BR><BR>";
					echo "<input class=\"newPostInput\" name=\"galimages[]\" type=\"file\" id=\"userfile\" onKeyUp=\"doOnChange(this);\"><BR>";
					echo "<input class=\"newPostInput\" type=\"text\" name=\"image4text\">&nbsp;";
					showOrderSelector($gid, 4,0,-1,"fj_gallery_pics", $before);
					echo "<BR><BR>";
					echo "<input class=\"newPostInput\" name=\"galimages[]\" type=\"file\" id=\"userfile\" onKeyUp=\"doOnChange(this);\"><BR>";
					echo "<input class=\"newPostInput\" type=\"text\" name=\"image5text\">&nbsp;";
					showOrderSelector($gid, 5,0,-1,"fj_gallery_pics", $before);
					echo "<BR><BR>";
					echo "<input class=\"newPostInput\" type=\"button\" value=\"cancel\" onClick=\"hideEdit('row".$ct."edit');\" >";
					echo "<input class=\"newPostInput\" type=\"hidden\" name=\"editGalAttempt\" value=\"true\">";
			
					echo "<input class=\"newPostInput\" type=\"button\" onClick=\"document.forms.galEdit".$ct."Form.submit();\" value=\"Edit this Gallery\">";
					
			
		
	
	echo "</fieldset>";
		mysql_free_result($result);

			
}



?>