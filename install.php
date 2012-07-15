<?php 
	include("module/sql.php");
	$users=$mongo->sms_system->users;
	if($users->findOne()==NULL){
		$users->insert(array("nickname"=>"管理員","usernm"=>"admin","passwd"=>md5("00000000"),"email"=>"","total_limit"=>0,"level"=>"admin"));
		$_db_setting->insert(array('check'=>'999','total_credit'=>0,'site_name'=>'簡訊發送系統','sms_username'=>'','sms_password'=>'','login_error_limit'=>-1));
		$group->insert(array("group_name"=>"未分類","pertain"=>"admin"));
		include("module/credit_count.php");
		echo "Install Successful";
	}else{
		echo "Install Failed";
	}
?>