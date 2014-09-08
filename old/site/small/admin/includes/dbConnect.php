<?php
$link = mysql_connect("db2653.perfora.net","dbo344252116","newyork");
if (!$link) {
    die('Not connected : ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('db344252116', $link);


?>