<?php
$link = mysql_connect("db323.perfora.net","dbo247372116","p5aqBqSW");
if (!$link) {
    die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('db247372116', $link);


?>