<?php
function checkLogin(){
	
	
	if (isset ($_POST['nolita'])){
		$u = $_POST['user'];
		$p = $_POST['pwd'];
		$query="SELECT * FROM users where uname='".md5("kcdjs".$u)."' AND upass='".md5("kcdjs".$p)."';";
		//echo $query;
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		mysql_close();
		//echo "<BR> NUM: ".$num;
		if ($num != 1){
			session_destroy();
			
		} else {
			// store session data
			$_SESSION['log']=1;
			$_SESSION['uname'] = $u;
		}
	} 
}
?>