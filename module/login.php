<?php 
	include("sql.php");
	include("../templ/init.php");
	
	date_default_timezone_set('Asia/Taipei');		//時區設定
	$login=$users->findOne(array("usernm"=>$_POST["usernm"]));
	
	if(md5(trim($_POST["passwd"]))==$login["passwd"]){
		
		$_SESSION["user-info"]=$login;
		$_SESSION["login-status"]=1;
		$users->update(array("_id"=>new MongoId($_SESSION["user-info"]['_id'])),array('$set'=>array('previous_login'=>date("Y/m/d H:i"))));
		header("location:../index.php");

	}else{
		if($_SESSION["setting"]["login_error_limit"]!=-1){
			if($_SESSION["setting"]["login_error_limit"]>0){
				$_SESSION["setting"]['login_error_limit']-=1;
				$_SESSION["login-status"]="帳號或密碼錯誤，你還有{$_SESSION["setting"]["login_error_limit"]}次機會";
				
			}else{
				$_SESSION["login-status"]="登入錯誤超過限制次數，20分鐘內不能再次登入";
			}
		}elseif(isset($_POST["passwd"])){
			$_SESSION["login-status"]="帳號或密碼錯誤";
		}
		
		header("location:../login.php");
		
	}

	
?>