<?php
include('admin/includes/database.php');
$db= new Database();

$db->select('statement','b','*',null,'modified DESC',null,1);
$st = $db->getResult();

$tags=array('[bold]','[/bold]','[italics]','[/italics]','[red]','[/red]');
		$real_tags=array('<b>','</b>','<i>','</i>','<span style="color:red;">','</span>');


$text=$st['statement'];

$text=str_replace($tags,$real_tags,$text);
	echo "<div class='statement'>".$text."</div>";




?>