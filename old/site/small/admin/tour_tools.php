<?php

	include "includes/dbConnect.php";



function displayTourAdmin($msg){
		include "includes/dbConnect.php";
			?>
		<html>
		<head>
		<title>Home Page Administration - News</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/admin.css" rel="stylesheet" type="text/css">
		<link href="includes/test.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/Javascript" src="includes/tools.js"></script>
	<link rel="stylesheet" href="includes/lightbox.css" type="text/css" media="screen" />
	
<script src="../scriptac/prototype.js" type="text/javascript"></script>
<script src="../scriptac/scriptaculous.js" type="text/javascript"></script>


		<script language="JavaScript" type="text/JavaScript">
	<!--
window.onload = siteInitialize; 
function siteInitialize() {
	Sortable.create('fulllist',{tag: 'div', constraint: false, onUpdate:updateList});
}
function removeItem(table, id){
	var answer = confirm("Really delete the entry?");
	if (answer){
		var url = "includes/delete.php"; // url to update_navigation.php
		var updateNavigation = new Ajax.Request(
			url,
			{
				method: 'get',
				parameters: "table="+table+"&id="+id,
				onComplete: updateAfterDeleting

			});
	return true;
	}	
}
function updateAfterDeleting(originalRequest) {
	//alert(originalRequest.responseText);
	$('AdminTable').innerHTML = originalRequest.responseText;
}
function updateList() {
	var url = "update_news.php"; // url to update_navigation.php
	var sorted = escape(Sortable.sequence('fulllist'));
	var updateNavigation = new Ajax.Request(
			url,
			{
				method: 'get',
				parameters: "order_num=" + sorted,
				onComplete: showUpdate

			});
	return true;
}

function showUpdate(originalRequest) {
	//alert(originalRequest.responseText);
}
-->
		</script>
<style>
	#fulllist {
  padding:0;
  margin:0;
  }
#fulllist li {
  list-style-type:none;
  }
	</style>
		</head>
		
		<body>
		<div id="centeringDiv">
			<?php include "includes/topNav.php";
		echo "<div id=\"AdminTable\">";
		

		putTourInside();
		echo "</div>";
		
}
function putTourInside(){
				//--------- ABOUT US --------------
		$query="SELECT * FROM talla_tour order by `year` ASC, `month` ASC, `day` ASC";
		$result2=mysql_query($query);
		$num=mysql_numrows($result2);
  
		echo "<BR><span style='font-size:15pt'><b><center>Current Tour</center></b></span><br><br>";
		displayTourForm();
		$i=0;
		echo "<table width=100% border=0 cellpadding=5px style='border: 2px solid #5A0300;'><tr><td>";
		echo "<div id=\"fulllist\">\n";
			
		while ($data = mysql_fetch_assoc($result2)) {
			echo "<div id=\"item_".$data['sid']."\" style=\"background-color: #E1E1E1;\">";
				echo "<table width=100%><tr><td width=20%>".nl2br(stripslashes($data['month_en']))." ".$data['day'].", ".$data['year']."</td>";
				echo "<td width=10%>".nl2br(stripslashes($data['time']))."</td>";
				echo "<td width=20%>".nl2br(stripslashes($data['location']))."</td>";
				echo "<td width=20%>".nl2br(stripslashes($data['venue']))."</td>";
				echo "<td width=20%>".nl2br(stripslashes($data['features']))."</td>";
				echo "<td width=10%><img src=\"images/edit.gif\" onClick=\"showEdit('row".$data['sid']."edit')\">&nbsp;&nbsp;&nbsp;<a onclick=\"removeItem('talla_news',".$data['sid'].")\">X</a></td></tr>";
			

			putTourEditDivAU($i, $data['sid'], $data['month'], $data['month_en'], $data['day'], $data['year'], $data['time'], $data['venue'], $data['location'], $data['features']);
			echo "</table></div>";
			$i++;
		}
 
		echo "</div></td></tr></table>"; 
	echo "<BR>";
		
		
}

function putTourEditDivAU($ct, $id, $month, $month_en, $day, $year, $time, $venue, $location, $features){
	echo "<tr id=\"row".$id."edit\" style=\"display:none;\">";
		//echo "magic quotes" . get_magic_quotes_gpc();  
			echo "<td colspan=4 height=300px>";
	echo "<div id=\"row".$id."editDiv\" class=\"editDiv\">";
	?>
					<form id="PTEditForm" action="admin_tour.php" method="POST" enctype="multipart/form-data">
														<select name=month value=''>Month</option>
									<option value='01' <?php echo ($month == 1)? 'SELECTED':'' ?>>January</option>
									<option value='02' <?php echo ($month == 2)? 'SELECTED':'' ?>>February</option>
									<option value='03' <?php echo ($month == 3)? 'SELECTED':'' ?>>March</option>
									<option value='04' <?php echo ($month == 4)? 'SELECTED':'' ?>>April</option>
									<option value='05' <?php echo ($month == 5)? 'SELECTED':'' ?>>May</option>
									<option value='06' <?php echo ($month == 6)? 'SELECTED':'' ?>>June</option>
									<option value='07' <?php echo ($month == 7)? 'SELECTED':'' ?>>July</option>
									<option value='08' <?php echo ($month == 8)? 'SELECTED':'' ?>>August</option>
									<option value='09' <?php echo ($month == 9)? 'SELECTED':'' ?>>September</option>
									<option value='10' <?php echo ($month == 10)? 'SELECTED':'' ?>>October</option>
									<option value='11' <?php echo ($month == 11)? 'SELECTED':'' ?>>November</option>
									<option value='12' <?php echo ($month == 12)? 'SELECTED':'' ?>>December</option>
								</select>
								
								<select name=day value=''>Day</option>
									<option value='01' <?php echo ($day == 1)? 'SELECTED':'' ?>>01</option>
									<option value='02' <?php echo ($day == 2)? 'SELECTED':'' ?>>02</option>
									<option value='03' <?php echo ($day == 3)? 'SELECTED':'' ?>>03</option>
									<option value='04' <?php echo ($day == 4)? 'SELECTED':'' ?>>04</option>
									<option value='05' <?php echo ($day == 5)? 'SELECTED':'' ?>>05</option>
									<option value='06' <?php echo ($day == 6)? 'SELECTED':'' ?>>06</option>
									<option value='07' <?php echo ($day == 7)? 'SELECTED':'' ?>>07</option>
									<option value='08' <?php echo ($day == 8)? 'SELECTED':'' ?>>08</option>
									<option value='09' <?php echo ($day == 9)? 'SELECTED':'' ?>>09</option>
									<option value='10' <?php echo ($day == 10)? 'SELECTED':'' ?>>10</option>
									<option value='11' <?php echo ($day == 11)? 'SELECTED':'' ?>>11</option>
									<option value='12' <?php echo ($day == 12)? 'SELECTED':'' ?>>12</option>
									<option value='13' <?php echo ($day == 13)? 'SELECTED':'' ?>>13</option>
									<option value='14' <?php echo ($day == 14)? 'SELECTED':'' ?>>14</option>
									<option value='15' <?php echo ($day == 15)? 'SELECTED':'' ?>>15</option>
									<option value='16' <?php echo ($day == 16)? 'SELECTED':'' ?>>16</option>
									<option value='17' <?php echo ($day == 17)? 'SELECTED':'' ?>>17</option>
									<option value='18' <?php echo ($day == 18)? 'SELECTED':'' ?>>18</option>
									<option value='19' <?php echo ($day == 19)? 'SELECTED':'' ?>>19</option>
									<option value='20' <?php echo ($day == 20)? 'SELECTED':'' ?>>20</option>
									<option value='21' <?php echo ($day == 21)? 'SELECTED':'' ?>>21</option>
									<option value='22' <?php echo ($day == 22)? 'SELECTED':'' ?>>22</option>
									<option value='23' <?php echo ($day == 23)? 'SELECTED':'' ?>>23</option>
									<option value='24' <?php echo ($day == 24)? 'SELECTED':'' ?>>24</option>
									<option value='25' <?php echo ($day == 25)? 'SELECTED':'' ?>>25</option>
									<option value='26' <?php echo ($day == 26)? 'SELECTED':'' ?>>26</option>
									<option value='27' <?php echo ($day == 27)? 'SELECTED':'' ?>>27</option>
									<option value='28' <?php echo ($day == 28)? 'SELECTED':'' ?>>28</option>
									<option value='29' <?php echo ($day == 29)? 'SELECTED':'' ?>>29</option>
									<option value='30' <?php echo ($day == 30)? 'SELECTED':'' ?>>30</option>
									<option value='31' <?php echo ($day == 31)? 'SELECTED':'' ?>>31</option>
								</select>
					<input type="text" name="year" onKeyUp="doOnChange(this);" oVal="<?php echo $year ?>" value="<?php echo stripslashes($year) ?>"><BR>
					<input type="text" name="time" onKeyUp="doOnChange(this);" oVal="<?php echo $time ?>" value="<?php echo stripslashes($time) ?>"><BR>
					<input type="text" name="location" onKeyUp="doOnChange(this);" oVal="<?php echo $location ?>" value="<?php echo stripslashes($location) ?>"><BR>
					<input type="text" name="venue" onKeyUp="doOnChange(this);" oVal="<?php echo $venue ?>" value="<?php echo stripslashes($venue) ?>"><BR>
					<textarea rows=15 cols=45 name="features" class="newPostInput" onKeyUp="doOnChange(this);" oVal="<?php echo $features ?>" ><?php echo stripslashes($features) ?></textarea><BR>
					<input type="hidden" name="sid" value="<?php echo $id ?>">
					<input type="hidden" name="edit" value="true">
					<input type="button" class="newPostInput" value="cancel edit" onClick="hideEdit('row<?php echo $id ?>edit');">
					<input type="submit" class="newPostInput">
	<?php
	echo "</form></td></tr>";	
}

function displayTourForm(){

		
	?>
			<a href=# onClick="addNew('addNew')">+ Add new tour date</a>
			<div id="addNew"  class="newPost">
				<form id="newsForm" action="admin_tour.php" method="POST" enctype="multipart/form-data">
					<table border=0px width=100% align=center>
						<tr>
							<td width=22% align="right">Date:&nbsp;&nbsp;</td>
							<td>
								<select name=month value=''>Month</option>
									<option value='01'>January</option>
									<option value='02'>February</option>
									<option value='03'>March</option>
									<option value='04'>April</option>
									<option value='05'>May</option>
									<option value='06'>June</option>
									<option value='07'>July</option>
									<option value='08'>August</option>
									<option value='09'>September</option>
									<option value='10'>October</option>
									<option value='11'>November</option>
									<option value='12'>December</option>
								</select>
								
								<select name=day value=''>Day</option>
									<option value='01'>01</option>
									<option value='02'>02</option>
									<option value='03'>03</option>
									<option value='04'>04</option>
									<option value='05'>05</option>
									<option value='06'>06</option>
									<option value='07'>07</option>
									<option value='08'>08</option>
									<option value='09'>09</option>
									<option value='10'>10</option>
									<option value='11'>11</option>
									<option value='12'>12</option>
									<option value='13'>13</option>
									<option value='14'>14</option>
									<option value='15'>15</option>
									<option value='16'>16</option>
									<option value='17'>17</option>
									<option value='18'>18</option>
									<option value='19'>19</option>
									<option value='20'>20</option>
									<option value='21'>21</option>
									<option value='22'>22</option>
									<option value='23'>23</option>
									<option value='24'>24</option>
									<option value='25'>25</option>
									<option value='26'>26</option>
									<option value='27'>27</option>
									<option value='28'>28</option>
									<option value='29'>29</option>
									<option value='30'>30</option>
									<option value='31'>31</option>
								</select>
							<input class="newPostInput" type="text" name="year">
							</td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Time:&nbsp;&nbsp;</td>
							<td width=78%><input class="newPostInput" type="text" name="time"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Location:&nbsp;&nbsp;</td>
							<td width=78%><input class="newPostInput" type="text" name="location"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Venue:&nbsp;&nbsp;</td>
							<td width=78%><input class="newPostInput" type="text" name="venue"></td>
						</tr>
						<tr>
							<td width=22% align="right" width=42%>Featuring:&nbsp;&nbsp;</td>
							<td width=78%><textarea rows=15 cols=45 name="features" class="newPostInput" ></textarea></td>
						</tr>
						<tr>
								<td colspan=2 align=center><input class="newPostInput" type="submit" value="Post this"></td>
						</tr>
					</table>
					<input type="hidden" name="add" value="true">
				</form>
			<input type="button" class="newPostInput" value="cancel" onClick="hideEdit('addNew')";>
		</div>
		
<?php
echo "<BR><br><br>";
//displayDisplayRules(1,$which);
//displayNewsAdmin($section, $which);

}



function displayNewsAdmin($section, $which){
			include "includes/dbConnect.php";

		$query="SELECT *, DATE_FORMAT(add_date, '%M %e, %Y') as d FROM news where `section` = $which ORDER BY nid DESC ";
		//echo $query;
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
	
		
	//	echo "<BR><b><center>Current ".$section." News</center></b><br>";
		$i=0;
		if ($num != ''){
			echo "<table width=100% cellpadding='5px'>";
			echo "<tr style=\"background-color: #5A0300; color: #ffffff;\"><td><b>Title</b></td><td><b>Link</b></td><td><b>Change</b></td></tr>";
			while ($i < $num) {
				$title=mysql_result($result,$i,"title");
				$id=mysql_result($result,$i,"nid");
				$link=mysql_result($result,$i,"link");
					$date=mysql_result($result,$i,"d");

					if (($i%2) == 1){
						echo "<tr id=\"row".$i."\" style=\"background-color: #B4B4B4;\">";
					} else {
						echo "<tr id=\"row".$i."\" style=\"background-color: #E1E1E1;\">";
					}
					
						
				
					echo "<td width=35%>".$title."</td>";
					echo "<td width=58% title=\"".$link."\">".$link."...</td>";
					echo "<td width=7%><img src=\"images/edit.png\" onClick=\"showEdit('".$which."row".$i."edit')\">&nbsp;<img src=\"images/delete.png\" onClick=\"removePost('news',$id);\"></td>";

					putNewsEditDiv($id, $i, $which);
					echo "</tr>";
					$i++;
				}
				echo "</table>";
		} else {
			echo "well you have no news yet!  Add one!<BR><BR>";
		}
}



function putNewsEditDiv($nid, $ct, $which){
	include "includes/dbConnect.php";
	
			echo "<tr id=\"".$which."row".$ct."edit\" style=\"background-color: #9C0400; display:none;\">";
			echo "<td id=\"gangster\" colspan=5 height=150px>";
			$query="SELECT * FROM news where nid=$nid and `section`=$which ORDER BY nid DESC";
			//echo $query."<BR>";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		
		mysql_close();
		$i=0;
		
		
			$title=mysql_result($result,$i,"title");
			$link=mysql_result($result,$i,"link");
			$linktext=mysql_result($result,$i,"linktext");
	
	echo "<div id=\"row".$ct."editDiv\" class=\"editDiv\">";
	?>
				<form id="newsForm" action="admin_homepage.php" method="POST">
					Title: <input type="text" class="newPostInput" id="aedit" name="aedit" size=60 onKeyUp="doOnChange(this);" oVal="<?php echo $title ?>" value="<?php echo $title ?>"><BR>
					<?php
						if ($link != ''){
							echo "Try this: <a href=\"".$link."\">".$link."</a><BR>";
						}
					?>
					Link text: <input class="newPostInput" size=60 type="text" name="linktext" value="<?php echo $linktext ?>" onKeyUp="doOnChange(this);" oVal="<?php echo $linktext ?>"<BR>
					Link: <input class="newPostInput" type="text" name="link" value="<?php echo $link ?>" onKeyUp="doOnChange(this);" oVal="<?php echo $link ?>"<BR>
					<?php echo "<input type=\"hidden\" class=\"newPostInput\" id=\"nidedit\" name=\"nid\" value=\"$nid\">"; ?>
					<input type="hidden" name="editNews" value="true"><br>
					<input type="hidden" name="rownumber" value=<?php echo $ct ?>>
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

