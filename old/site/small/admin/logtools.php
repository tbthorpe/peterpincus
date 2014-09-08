<?php
function checkLogin(){
	
	
	if (isset ($_POST['nolita'])){
		$u = $_POST['user'];
		$p = $_POST['pwd'];
		//$query="SELECT * FROM user_table where uname='".md5("kcdjs".$u)."' AND upass='".md5("kcdjs".$p)."';";
		$query="SELECT * FROM `fj_user_table` where `uname`='$u' AND `upass`='$p';";
		//echo $query;
		$result=mysql_query($query);
		$num=mysql_numrows($result);

		
				
	
		//echo "<BR> NUM: ".$num;
		if ($num != 1){
			session_destroy();
			
		} else {
			
				$_SESSION['bobloblaw']=1;
				$_SESSION['uname'] = $u;
			
		}
	} 
}
?>