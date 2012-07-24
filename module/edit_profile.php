<?php 
	session_start();
	include('sql.php');
	
	if($_POST['check']==$_SESSION['check']){
		unset($_SESSION['check']);
		if(trim($_POST['passwd'])==''){
			$users->update(array('_id'=>new MongoId($_SESSION['user-info']['_id'])),array('$set'=>array('nickname'=>trim($_POST['nickname']),'email'=>trim($_POST['email']))));
			$_SESSION['edit_porfile_status']='修改成功';
		}elseif(trim($_POST['passwd'])==trim($_POST['passwd_again'])){
			$users->update(array('_id'=>new MongoId($_SESSION['user-info']['_id'])),array('$set'=>array('passwd'=>md5(trim($_POST['passwd'])),'nickname'=>trim($_POST['nickname']),'email'=>trim($_POST['email']))));
			$_SESSION['edit_porfile_status']='修改成功';
		}elseif(trim($_POST['passwd'])!=trim($_POST['passwd_again'])){
			$_SESSION['edit_porfile_status']='兩次密碼輸入不相同';
		}
	
	}else{
		$_SESSION['edit_porfile_status']='檢核碼錯誤，請勿嘗試攻擊本系統';
	}
	
	$temp=$_SESSION['user-info']['previous_login'];
	$_SESSION['user-info']=$users->findOne(array('_id'=>new MongoId($_SESSION['user-info']['_id'])),array('previous_login'=>0));
	$_SESSION['user-info']['previous_login']=$temp;
	unset($temp);
		
	header('Location: ../edit_profile.php?id=' . $_SESSION['user-info']['_id']);
?>