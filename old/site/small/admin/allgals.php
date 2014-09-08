<?php
	include "includes/dbConnect_old2.php";

			//$query="SELECT * FROM pho LEFT JOIN gallery_pics on thumb_pid=pid join gallery_categories on cid = gal_cid where isFree=$free and gal_cid=$category and showit=1 ORDER BY gid DESC";
		$query = "select fj_photo_gallery.pid as galpid, fj_photo_gallery.filename as galfilename, fj_photo_gallery.title as galtitle, fj_photo_gallery.text as galtext, fj_gallery_pics.pid as ppid, fj_gallery_pics.filename as pfilename from fj_photo_gallery,fj_gallery_pics where fj_photo_gallery.thumb_pid = fj_gallery_pics.pid;";
		$result=mysql_query($query) or die ('could not execute<BR>');
		$num=mysql_numrows($result);
		$cat=mysql_result($result,$i,"name");
		$outcome = "";
		
			$outcome .= "<div id='gallerybox'>";			
		//echo "<span style='font-family:arial; font-size:12px;'>There are ".$num." galleries in this category</span><BR><BR>";
		if ($num == ''){
			$outcome .= "<span style='font-family:arial;'>No Galleries</span><BR>";
		} else {
			$i=0;
				$outcome .= "<table  style='border: 0px solid white; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;'><tr align=center valign=top>";
			while ($i < $num){
			  if ($i % 3 == 0){
					$outcome .= "</tr><tr align=center valign=top>";
				}
				$pid=mysql_result($result,$i,"galpid");
				$title=mysql_result($result,$i,"galtitle");
				$filename=mysql_result($result,$i,"pfilename");
				$outcome .= "<td width=33%>";
				//echo "<div style=\"font-size: 8pt; float: left; text-align: center; padding:5px; margin: 3px; border:1px solid black;\">";
				if ($filename != ''){
						$outcome .= "<table cellspacing=0 cellpadding=3 border=0 width='75%'><tbody><tr><td height='200' align='center' valign='middle' colspan='1'><img border=0 src=\"test2/images/gallery/".$pid."_thumbs/tn_".$filename."\" onClick=\"showGal(".$pid.");\"></td></tr>";
						$outcome .= "<tr><td height='50' align='center' valign='top' colspan='2'><span style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px;'>".stripslashes($title)."</span></td></tr></tbody></table>";
						//echo "<div style='margin:3px; float: left; height: 205px; width:205px; vertical-align: middle;'><img border=0 src=\"test2/images/gallery/".$pid."_thumbs/tn_".$filename."\" onClick=\"showGal(".$pid.");\">";
					//echo stripslashes($title)."</div>";
					//echo "<a href=\"viewgallery.php?g=".$pid."\"><img border=0 src=\"../admin/images/gallery/".$pid."_thumbs/tn_".$filename."\"></a><BR>";
				} else {
						$outcome .= "<a href=\"viewgallery.php?g=".$pid."\"><img src=\"nothumb.png\"></a><BR>";
				}
				
				$outcome .= "</td>";
				//echo "</div>";
				
				$i++;
			}
			$outcome .= "</tr></table></div>";
		}
		echo $outcome;
?>