<?php
function process_user_info($usernm,$passwd,$nickname,$email,$total_limit="",$day_limit="",$level=normal){
		$user_info=array($usernm,$passwd,$nickname,$email,$total_limit,$day_limit,$level);
		for($i=0;$i<count($user_info);$i++){
			$user_info[$i]=trim($user_info[$i]);
		}
		$result="";
		if(strlen($user_info[0])<5 or strlen($user_info[1])<8){
			$result.="帳號或密碼不符合要求、";
		}
		if($user_info[2]=="" or $user_info[3]==""){
			$result.="暱稱及信箱不得為空";
		}
		if($user_info[6]=="admin"){
			$user_info[4]="";
			$user_info[5]="";
		}
		if($result==""){
			return $user_info;
		}else{
			return $result;
		}
		
	}
	
?>