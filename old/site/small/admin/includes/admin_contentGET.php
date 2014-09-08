<?php
		include('database.php');
		$db2= new Database();
		$which = $_GET['which'];

switch ($which){
	case 'work':
		if (isset($_GET['remove']) && $_GET['remove']=='true'){
			 $db2->delete('work','id='.$_GET['id']);
			 echo "deleting: ".$_GET['id'];
			 echo json_encode($db2->getResult());
			break;
		}
		if (isset($_GET['sort']) && $_GET['sort']=='true'){
				$x = substr($_GET['order'],0,strlen($_GET['order'])-1);
				$order = explode(",", $x);
				foreach ($order as $key => $val){
					$db2->update('work',array('ordernum'=>$key),array('id'=>$val));
				}
		   echo json_encode($db2->getResult());
			break;
		}
		if (isset($_GET['update']) && $_GET['update']=='true'){
			 $db2->update('work',array('title'=>$_GET['title'],
			 											'details'=>$_GET['details'],
			 											'dimensions'=>$_GET['dimensions'],
			 											'make_date'=>$_GET['make_date']
			 										),
			 									array('id'=>$_GET['id']));
			 echo json_encode($db2->getResult());
				break;
		}
		if (isset($_GET['cat']) && isset($_GET['subcat'])){
			 $db2->select('work','w','*','cat='.$_GET["cat"].' AND subcat='.$_GET["subcat"],'ordernum ASC');
			 echo json_encode($db2->getResult());
			break;
		} else {
			$db2->select('work','w','*','','ordernum ASC');
			echo json_encode($db2->getResult());
			break;
		}
		
		
		
		case 'sc':
			if (isset($_GET['remove']) && $_GET['remove']=='true'){
				 $db2->delete('work_subcategories','id='.$_GET['id']);
			}
			if (isset($_GET['insert']) && $_GET['insert']=='true'){
				 $db2->insert('work_subcategories',array('null',$_GET['cat_id'],$_GET['name']));
			}
			if (isset($_GET['update']) && $_GET['update']=='true'){
				 $db2->update('work_subcategories',array('name'=>$_GET['name']),array('id'=>$_GET['id']));
			}
			$db2->select('work_categories','w');
			$res1=$db2->getResult();
			$db2->select('work_subcategories','sc');
			$res2=$db2->getResult();
			
			echo json_encode(array('c'=>$res1, 'sc'=>$res2));		
		
		break;
		
		case 'cat':
			if (isset($_GET['delete']) && $_GET['delete']=='true'){
				 $db2->delete('work_categories','id='.$_GET['id']);
			}
			if (isset($_GET['insert']) && $_GET['insert']=='true'){
				 $db2->insert('work_categories',array('null',$_GET['name']));
			}
			if (isset($_GET['update']) && $_GET['update']=='true'){
				 $db2->update('work_categories',array('name'=>$_GET['name']),array('id'=>$_GET['id']));
			}
			if (isset($_GET['sort']) && $_GET['sort']=='true'){
					$x = substr($_GET['order'],0,strlen($_GET['order'])-1);
					$order = explode(",", $x);
					foreach ($order as $key => $val){
						echo "key: ".$key.", val:".$val;
						$db2->update('work_categories',array('ordernum'=>$key),array('id'=>$val));
					}
			   echo json_encode($db2->getResult());
				break;
			}
			$db2->select('work_categories','w');
			$res1=$db2->getResult();
			$db2->select('work_subcategories','sc');
			$res2=$db2->getResult();
			
			echo json_encode(array('c'=>$res1, 'sc'=>$res2));		
		
		break;
		
	case 'blog':
		if (isset($_GET['delete']) && $_GET['delete']=='true'){
			 $db2->delete('blog','id='.$_GET['id']);
		}
		if (isset($_GET['update']) && $_GET['update']=='true'){
			$text=mysql_real_escape_string($_GET['text']);
			$title=mysql_real_escape_string($_GET['title']);
//			$tags=array('[bold]','[/bold]','[italics]','[/italics]','[red]','[/red]');
//			$real_tags=array('<b>','</b>','<i>','</i>','<span style="color:red;">','</span>');
			$text=str_replace($tags,$real_tags,$text);
			$title=str_replace($tags,$real_tags,$title);

			$now=date('Y-m-d H:i:s');
			 $db2->update('blog',array('title'=>$title,'text'=>$text,'modified'=>$now),array('id'=>$_GET['id']));
		}
		$db2->select('blog','b','*','','created DESC');
		$res = $db2->getResult();
		
		$res=stripslashes_deep($res);
		
		echo json_encode($res);
		break;
		
		case 'categories':
		if (isset($_GET['delete']) && $_GET['delete']=='true'){
			 $db2->delete('work','id='.$_GET['id']);
		}

			$db2->select('work_categories','w','*','','ordernum ASC');
			$res1=$db2->getResult();
			$db2->select('work_subcategories','sc');
			$res2=$db2->getResult();
			
			
			echo json_encode(array('c'=>$res1, 'sc'=>$res2));			
		
		break;
		
		case 'statement':
			if (isset($_GET['insert']) && $_GET['insert']=='true'){
				$now=date('Y-m-d H:i:s');
				$db2->insert('statement',array('null',$_GET['statement'],$now));
			}
			$db2->select('statement','b','*','','modified DESC','',1);
			$res = $db2->getResult();
			echo json_encode($res);
		break;	
	
	default:
	
		break;
}

function stripslashes_deep($value)
{
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);

    return $value;
}

?>