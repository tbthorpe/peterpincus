<?php

function showPageImages($id, $ct){
		
		
	//	$query = "select * from gallery_galleries where gid=$id;";
		//echo $query;
	//	$result = mysql_query($query);
		//$title=mysql_result($result,0,"title"); 
	//	echo "+++".$title."+++";
		$query="SELECT * FROM page_pics where p_id=$id";
		//echo $query;
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		//echo "...".$num."<BR>";
	//	mysql_close();
		$i=0;
		
		while ($i < $num) {
			$picdesc=mysql_result($result,$i,"description");
			$filename=mysql_result($result,$i,"filename");
			$ppid=mysql_result($result,$i,"ppid");
					echo "<a  title=\"".$picdesc."\" href=\"images/pagepics/".$filename."\" rel=\"lightbox[".$id."]\"><img src=\"images/pagepics_thumbs/tn_".$filename."\"></a><BR>";
					echo "&nbsp;<input type=\"button\" value=\"Delete\" onClick=\"removePic('page_pics', $id, $ppid, $ct);\"><br>";
			$i++;
		}
		//echo "</SELECT>";
		mysql_free_result($result);
}

function putPageImageEditDiv($pageID, $ct){
	include "includes/dbConnect_old2.php";

					$query="SELECT * FROM page_pics where p_id=$pageID";
			//echo $query."<BR>";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		//echo "...".$num."...<BR>";
//echo "<fieldset id=\"row".$ct."ImageEditDiv\">";
		//	echo "<fieldset id=\"row".$ct."imageList\" style=\"float: left;\">";
		showPageImages($pageID, $ct);
		//	echo "</fieldset>";
		

		//mysql_close();
		$rest = 3 - $num;
		//echo $rest."<BR>";
		
		
		//$title=mysql_result($result,$i,"title");
		//	$feature=mysql_result($result,$i,"feature");
		//	$galdesc=mysql_result($result,$i,"gal_desc");
	
	
	//echo "<fieldset id=\"row".$ct."ImageEditDiv\">";
	for ($i = 0; $i < $rest; $i++){
			//echo $i."<BR>";
			echo "<input name=\"images[]\" type=\"file\" id=\"userfile\" onKeyUp=\"doOnChange(this);\"><BR>";
			echo "<input type=\"text\" name=\"image".$i."text\"><BR><BR>";
	}
?>
			<input type="button" value="cancel image edit" onClick="hideEdit('row<?php echo $ct ?>imageFull');" >
		<input type="button" value="Edit this text!" onclick="document.forms.PTEdit<?php echo $ct ?>Form.submit();"><BR><BR>
	<?php
	//echo "</fieldset>";
		mysql_free_result($result);
}

?>
