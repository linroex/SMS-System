<?php 
	include("sql.php");
	include("../templ/init.php");
	
	$users=$mongo->sms_system->users;
	$login=$users->findOne(array("usernm"=>$_POST["usernm"]));
	if(md5(trim($_POST["passwd"]))==$login["passwd"]){
		$_SESSION["user-info"]=$login;
		$_SESSION["login-status"]=1;
		header("location:../index.php");
	}else{
		$_SESSION["login-status"]="帳號或密碼錯誤";
		header("location:../login.php");
	}
	
	
?>