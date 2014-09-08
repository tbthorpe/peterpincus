<?php
	include "dbConnect.php";
	include "../homepage_tools.php";
	include "../photo_tools.php";
	include "../link_tools.php";
	include "../album_tools.php";
	include "../video_tools.php";
	
	include "../always.php";
	$tab = $_GET['table'];
	$id = $_GET['id'];
	switch ($tab) {
		case "mcdc_news":
				$query="delete from $tab where nid=$id";
				$result=mysql_query($query);
				putHomepageInside();
		    break;
		case "mcdc_photos":
				$query="delete from $tab where pid=$id";
				$result=mysql_query($query);
				putPGInside();
		    break;
		case "mcdc_tour":
				$query="delete from $tab where sid=$id";
				$result=mysql_query($query);
				putTourInside();
		    break;
		case "talla_discog":
				$query="delete from $tab where aid=$id";
				$result=mysql_query($query);
				putAlbumInside();
		    break;
		case "talla_vids":
				$query="delete from $tab where vid=$id";
				$result=mysql_query($query);
				putVideoInside();
		    break;
		default:
	//nothing
	}
?>