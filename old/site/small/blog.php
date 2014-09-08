<?php
include('admin/includes/database.php');

function stripslashes_deep($value)
{
  $value = is_array($value) ?
              array_map('stripslashes_deep', $value) :
              stripslashes($value);

  return $value;
}

$db= new Database();

$db->select('blog','b','*',null,'id DESC',null,10);
$res = $db->getResult();


$res=stripslashes_deep($res);
$tags=array('[bold]','[/bold]','[italics]','[/italics]','[red]','[/red]');
		$real_tags=array('<b>','</b>','<i>','</i>','<span style="color:red;">','</span>');

foreach ($res as $post){
$text=$post['text'];
$title=$post['title'];
$text=str_replace($tags,$real_tags,$text);
$title=str_replace($tags,$real_tags,$title);
	
	
$whole= "<span class='post_title'>".$title."</span><span class='post_time'>&nbsp;&nbsp;(". date('l F dS, Y', strtotime($post['created'])).")</span><p class='post_text'>".$text."</p>";
	echo "<div class='post'>".$whole."</p></div>";
}



?>