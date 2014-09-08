<?php
include('admin/includes/database.php');
$db= new Database();
//'work','w','*','','ordernum ASC'
//$db->select('work','w','*',null,'date_created DESC',null,1);

$db->select('work','w','*','','ordernum ASC');
$res = $db->getResult();
$loc = $_SERVER['SERVER_NAME'];
	switch ($loc){
		case 'tim.peter.com':
			$create_src_folder = $_SERVER['DOCUMENT_ROOT'].'/site/small/images/work/';
			$src_folder = '/site/small/images/work/';
			$thumb_folder = $_SERVER['DOCUMENT_ROOT'].'/site/small/images/work/thumbs/'; 
			break;	
		case 'peterpincus.com':
			$create_src_folder = $_SERVER['DOCUMENT_ROOT'].'/site/small/images/work/';
			$src_folder = '/site/small/images/work/';
			$thumb_folder = $_SERVER['DOCUMENT_ROOT'].'/site/small/images/work/thumbs/'; 
			break;	
	}
foreach ($res as $piece){
$text= $piece['title']."<br/>".$piece['details']."&nbsp;&nbsp;:&nbsp;&nbsp;".$piece['dimensions']."&nbsp;&nbsp;:&nbsp;&nbsp;".$piece['make_date'];
	echo "<div class='piece c_".$piece['cat']." sc_".$piece['subcat']."' style='background:#f5f5f5;position:relative;padding:10px;margin:10px 10px 10px 0;float:left;'>";
	echo "<a title='".$text."' class='bozo' href='".$src_folder.$piece['img_name']."'>";
	echo "<img border=0 src='".$src_folder."thumbs/thumbnail.".$piece['img_name']."'></a></div>";

//echo $text.'</div>';
}



?>

