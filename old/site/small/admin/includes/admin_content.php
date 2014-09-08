<?php
		include('database.php');
		$db2= new Database();
		$which = $_POST['which'];

switch ($which){
	case 'work':
		$db2->select('work');
		$res = $db2->getResult();
		break;
	
	default:
	
		break;
}

echo json_encode($res);


?>