<?php 
	include("module/sql.php");
	$users=$mongo->sms_system->users;
	if($users->findOne()==NULL){
		$users->insert(array("nickname"=>"管理員","usernm"=>"admin","passwd"=>md5("00000000"),"email"=>"","day_limit"=>"","total_limit"=>"","level"=>"admin"));
		echo "Install Successful";
	}else{
		echo "Install Failed";
	}
	
	
?>