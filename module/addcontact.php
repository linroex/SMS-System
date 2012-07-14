<?php 
	include("sql.php");
	include("../templ/init.php");
	include("function.php");
	if(!isset($_POST['group'])){
		$_POST['group']='';
	}
	$info=contact_info_check($_POST['name'],$_POST['nickname'],$_POST['email'],$_POST['phone'],$_POST['group'],$_POST['notice']);
	if($_POST['editorcreate']=='false'){
		
		if($contact->findOne(array('name'=>$info[0]))==NULL){
			if($contact->insert(array('name'=>$info[0],'nickname'=>$info[1],'email'=>$info[2],'phone'=>$info[3],'group'=>$info[4],'notice'=>$info[5],'pertain'=>$_SESSION["user-info"]['usernm']))){
				$_SESSION['add_contact_message']='新增聯絡人成功';
			}else{
				$_SESSION['add_contact_message']='失敗：'.$info;
			}
		}else{
			$_SESSION['add_contact_message']='已有同名稱聯絡人';
		}
		
	}else{
		$conid=new 	MongoId($_POST['_id']);
		if($_POST['del_contact']=='true'){
			$contact->remove(array('_id'=>$conid));
			$_SESSION['add_contact_message']='成功移除';
		}elseif($_POST['del_contact']=='false'){
			if($x=$contact->update(array('_id'=>$conid),array('name'=>$info[0],'nickname'=>$info[1],'email'=>$info[2],'phone'=>$info[3],'group'=>$info[4],'notice'=>$info[5],'pertain'=>$_SESSION["user-info"]['usernm']))){
				$_SESSION['add_contact_message']='修改聯絡人資料成功';
			}else{
				$_SESSION['add_contact_message']='失敗：'.$info;
			}
		}
		
	}
	header("Location:../view_contact.php");
	
?>