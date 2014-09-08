<?php

	include "includes/dbConnect_old2.php";

function displayUserForm($msg){
	?>
		<html>
		<head>
		<title>User Administration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	
	<script src="includes/prototype3.js" type="text/javascript"></script>
	<script src="includes/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
	<script src="includes/lightbox.js" type="text/javascript"></script>


		<script language="JavaScript" type="text/JavaScript">
		<!--
		//-->
		</script>

		</head>
		
		<body>
		<div id="centeringDiv">
			<?php include "includes/topNav.php"; ?>
		<?php echo $msg."<BR>"; ?>
		<a href=# onClick="addNew('addNew')">+ Add new user</a>
		<div id="addNew"  class="newPost">
				<form id="galForm" action="admin_users.php" method="POST">
					<table border=0px width=100% align=center>
						<tr>
							<td align="center" width=25%>First name:</td>
							<td width=75%><input class="newPostInput" type="text" id="first" name="first"></td>
						</tr>
						<tr>
							<td align="center" width=25%>Last name:</td>
							<td width=75%><input class="newPostInput" type="text" id="last" name="last"></td>
						</tr>
						<tr>
						<tr>
							<td align="center" width=25%>Username:</td>
							<td width=75%><input class="newPostInput" type="text" id="uname" name="uname"></td>
						</tr>
						<tr>
							<td align="center" width=25%>Password:</td>
							<td width=75%><input class="newPostInput" type="text" id="upass" name="upass"></td>
						</tr>
						<tr>
							<td align="center" width=25%>Folders:</td>
							<td width=75%><input class="newPostInput" type="text" id="dirs" name="dirs"></td>
						</tr>
						<tr>
							<td align="center" colspan=2><input class="newPostInput" type="submit" value="Add user"></td>
						</tr>
					</table>
			<input type="hidden" name="addAttempt" value="true">
			</form>
			
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew')";>
		</div>
<?php
}




function displayUserAdmin($msg){
		include "includes/dbConnect_old2.php";

	$query="SELECT * FROM `user_table` order by uid DESC";
 //$query = "SELECT *, (SELECT count(*) from gallery_pics where gal_id=gid) as ct FROM gallery_galleries left join gallery_pics on thumb_pid = pid ORDER BY gid DESC;";
		$result=mysql_query($query);
		$num=mysql_numrows($result);

		echo "<b><center>Current User List</center></b><br><br>";
		$i=0;
		$x = 0;

		echo "<table width=100%>";
		echo "<tr style=\"background-color: #FFFFFF;\"><td><b>Last Name</b></td><td><b>Username</b></td><td><b>Edit</b></td></tr>";
		while ($i < $num) {
		
			$first=mysql_result($result,$i,"firstname");
			$id=mysql_result($result,$i,"uid");
			$last=mysql_result($result,$i,"lastname");
			$uname=mysql_result($result,$i,"uname");
			$upass=mysql_result($result,$i,"upass");
			$dirs=mysql_result($result,$i,"folder_list");

			if (($i%2) == 1){
				echo "<tr id=\"row".$i."\" style=\"background-color: #B4B4B4;\">";
			} else {
				echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
			}
			
			//echo "<td width=120px><a href=\"images/gallery/".$id."/".$filename."\" rel=\"lightbox\"><img src=\"images/gallery/".$id."_thumbs/tn_".$filename."\"></a></td>";
			echo "<td width=45%>".$last."</td>";
			echo "<td width=45%>".$uname."</td>";

			echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$i."edit')\">&nbsp;";
			echo "<img src=\"images/delete.gif\" onClick=\"removePost('user_table',$id);\"></td></tr>";
			echo "<tr id=\"row".$i."edit\" style=\" display:none;\">";
			echo "<td id=\"gangster\" colspan=5 height=300px>";
			//THIS IS WHERE THE EDIT DIV GOES -- Gotta be $i+1 because of the damn things.
			putUserEditDiv($id, $i);

			echo "</form>";
			echo "</td></tr>";
			//echo "</tr>";
			
			$i++;
		}
 
		echo "</table>";
		//mysql_free_result($result);
		//mysql_close();
}



function putUserEditDiv($uid, $ct){
	include "includes/dbConnect_old2.php";
	$query="SELECT * FROM `user_table` where `uid`=$uid";
	$result=mysql_query($query);
	$num=mysql_numrows($result);

	$i=0;
		
	$first=mysql_result($result,$i,"firstname");
	$uid=mysql_result($result,$i,"uid");
	$last=mysql_result($result,$i,"lastname");
	$uname=mysql_result($result,$i,"uname");
	$upass=mysql_result($result,$i,"upass");
	$dirs=mysql_result($result,$i,"folder_list");
	
	?>
					<form id="galEdit<?php echo $ct ?>Form" action="admin_users.php" method="POST">
						<?php
						echo "<fieldset style=\"border: 0px;\" class=\"editDiv\" id=\"row".$pid."editDiv\">";
						?>
					<table border=0px width=100% align=center>
						<tr><td align="center" width=25%>First name:&nbsp;</td><td width=75%><input type="text" class="newPostInput" id="first" name="first" onKeyUp="doOnChange(this);" oVal="<?php echo $first ?>" value="<?php echo $first ?>"></td></tr>
						<tr><td align="center" width=25%>Last name:&nbsp;</td><td width=75%><input type="text" class="newPostInput" id="last" name="last" onKeyUp="doOnChange(this);" oVal="<?php echo $last ?>" value="<?php echo $last ?>"></td></tr>
						<tr><td align="center" width=25%>Username:&nbsp;</td><td width=75%>&nbsp;<?php echo $uname."<BR>";?></td></tr>
						<tr><td align="center" width=25%>Password:&nbsp;</td><td width=75%><input type="text" class="newPostInput" id="upass" name="upass" onKeyUp="doOnChange(this);" oVal="<?php echo $upass ?>" value="<?php echo $upass ?>"></td></tr>
						<tr><td align="center" width=25%>Current folders:&nbsp;</td><td width=75%>&nbsp;<?php echo $dirs."<BR>";?></td></tr>
						<tr><td align="center" width=25%>Add Folders:&nbsp;</td><td width=75%><input type="text" class="newPostInput" id="dirs" name="newdirs" onKeyUp="doOnChange(this);" oVal="" value=""></td></tr>
					</table>
					<input type="hidden" name="uid" value=<?php echo $uid ?>>
					<input type="hidden" name="olddirs" value=<?php echo $dirs ?>>
					<input type="hidden" name="uname" value=<?php echo $uname ?>>
					<input type="hidden" name="editAttempt" value="true">
					<input type="hidden" name="rownumber" value=<?php echo $ct ?>>
					<input type="button" class="newPostInput" value="close this window" onClick="hideEdit('row<?php echo $ct ?>edit');" >
					<input type="submit" class="newPostInput" value="Edit this user">
			
		 <!-- from the first line of this function -->
	<?php
		//echo "</div></td></tr></tr></tr>";
		echo "</fieldset>";
		mysql_free_result($result);
	mysql_close();	
}

function checkUserName($u){
	$query="SELECT * FROM `user_table` where `uname`='$u';";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	if ($num == 0){
		return true;
	} else {
		return false;
	}
}
?>
