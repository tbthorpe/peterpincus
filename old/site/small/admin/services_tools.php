<?php

	include "includes/dbConnect.php";



function displayServicesAdmin($msg){
		include "includes/dbConnect.php";
			?>
		<html>
		<head>
		<title>Home Page Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	
	<script src="includes/prototype.js" type="text/javascript"></script>
	<script src="includes/scriptaculous.js" type="text/javascript"></script>
	<script src="includes/lightbox.js" type="text/javascript"></script>


		<script language="JavaScript" type="text/JavaScript">
		<!--
		//-->
		</script>

		</head>
		
		<body>
		<div id="centeringDiv">
			<?php include "includes/topNav.php";
		echo "<div id=\"AdminTable\">";

		showServicesInside();
		echo "</div>";
		
}

function showServicesInside(){
	echo "<BR><span style='font-size:15pt'><b><center>Current Services Page</center></b></span><br><br>";
		//--------- Web Services --------------
		echo "<BR><BR>";
		displaySectionForm('Web');
		echo "<BR><HR><BR>";
		
		//--------- Promotional Services --------------
		
		displaySectionForm('Promotional');
		echo "<BR><HR><BR>";		
		
		//--------- Marketing Services --------------
		
		displaySectionForm('Marketing');
		echo "<BR><HR><BR>";
}
function displaySectionForm($section){
	echo "<BR><span style='font-size:13pt'><b><center>Current $section section</center></b></span>";
			switch ($section){
			case "Web":
				$which = 1;
				break;
			case "Promotional":
				$which = 2;
				break;
			case "Marketing":
				$which = 3;
				break;
			default:
				break;
		}
	?>
			<a href=# onClick="addNew('addNew<?php echo $section ?>')">+ Add new <?php echo $section ?> Services posting</a>
			<div id="addNew<?php echo $section ?>"  class="newPost">
				<form id="newsForm" action="admin_services.php" method="POST">
					<table border=0px width=100% align=center>
						<tr>
							<td align="center" width=25%>Title:</td>
							<td width=75%><input class="newPostInput" type="text" name="a"></td>
						</tr>
						<tr>
							<td align="center" width=25%>Text:</td>
							<td width=75%><textarea class="newPostInput" rows=15 cols=45 name="b"></textarea></td>
						</tr>
						
						<tr>
								<td colspan=2 align=center><input class="newPostInput" type="submit" value="Post this"></td>
						</tr>
					</table>
					<input type="hidden" name="addNews" value="true">
					<input type="hidden" name="which" value="<?php echo $which ?>">
				</form>
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew<?php echo $section ?>')";>
		</div>
		
<?php
echo "<BR><BR>";
displaySectionAdmin($section, $which);
}


function displaySectionAdmin($section, $which){
			include "includes/dbConnect.php";

		$query="SELECT * FROM services_page where `section` = $which ORDER BY spid DESC ";
		//echo $query;
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);

		
		$i=0;
		if ($num != ''){
			echo "<table width=100%>";
			echo "<tr style=\"background-color: #5A0300; color:#ffffff;\" cellspacing='5px'><td><b>Title</b></td><td><b>Text</b></td><td><b>Change</b></td></tr>";
			while ($i < $num) {
				$title=mysql_result($result,$i,"title");
				$id=mysql_result($result,$i,"spid");
				$text=mysql_result($result,$i,"text");

					if (($i%2) == 1){
						echo "<tr id=\"row".$i."\" style=\"background-color: #B4B4B4;\">";
					} else {
						echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
					}
					
							
				
					echo "<td width=35%>".$title."</td>";
					echo "<td width=58% title=\"".$text."\">".substr(stripslashes($text),0,100)."...</td>";
					echo "<td width=7%><img src=\"images/edit.png\" onClick=\"showEdit('".$which."row".$i."edit')\">&nbsp;<img src=\"images/delete.png\" onClick=\"removePost('services_page',$id);\"></td>";

					putSectionEditDiv($id, $i, $which);
					echo "</tr>";
					$i++;
				}
				echo "</table>";
		} else {
			echo "well you have no news yet!  Add one!<BR><BR>";
		}
}



function putSectionEditDiv($spid, $ct, $which){
	include "includes/dbConnect.php";
	
			echo "<tr id=\"".$which."row".$ct."edit\" style=\"background-color: #9C0400; display:none;\">";
			echo "<td id=\"gangster\" colspan=5 height=300px>";
			$query="SELECT * FROM services_page where spid=$spid and `section`=$which ORDER BY spid DESC";
			//echo $query."<BR>";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		mysql_close();
		$i=0;
		
		
			$title=mysql_result($result,$i,"title");
			$text=mysql_result($result,$i,"text");

	
	echo "<div id=\"row".$ct."editDiv\" class=\"editDiv\">";
	?>
				<form id="newsForm" action="admin_services.php" method="POST">
					Title: <input type="text" class="newPostInput" id="aedit" name="aedit" size=60 onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo $title ?>"><BR>
					Text: <textarea class="newPostInput" rows=15 cols=45 onKeyUp="doOnChange(this);" oVal="<?php echo $text ?>" id="bedit" name="bedit"><?php echo stripslashes($text) ?></textarea><BR>
					<input type="hidden" name="editNews" value="true"><br>
					<input type="hidden" name="rownumber" value=<?php echo $ct ?>>
					<input type="hidden" name="spid" value=<?php echo $spid ?>>
					<input type="hidden" name="which" value=<?php echo $which ?>>
					<input type="submit" class="newPostInput" value="Submit the edit" >
					<input type="button" class="newPostInput" value="close this window" onClick="hideEdit('<?php echo $which ?>row<?php echo $ct ?>edit');" >
				</form>
			
		 <!-- from the first line of this function -->
	<?php
		echo "</div></td></tr></tr></tr>";
		mysql_free_result($result);
		
}
?>

