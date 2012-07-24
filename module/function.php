<?php

	function process_user_info($usernm,$passwd,$nickname,$email,$total_limit="",$day_limit="",$level=normal){
		$user_info=array($usernm,$passwd,$nickname,$email,$total_limit,$day_limit,$level);
		for($i=0;$i<count($user_info);$i++){
			$user_info[$i]=trim($user_info[$i]);
		}
		$result="";
		if(strlen($user_info[0])<5 or strlen($user_info[1])<8){
			$result.="帳號或密碼不符合要求  ";
		}
		if($user_info[2]=="" or $user_info[3]==""){
			$result.="暱稱及信箱不得為空  ";
		}
		
		if($result==""){
			$user_info[4]=(int)$user_info[4];
			$user_info[5]=(int)$user_info[5];
			$user_info[1]=md5($user_info[1]);
			
			return $user_info;
		}else{
			return $result;
		}		
	}
	
	function setting_check_info($smsname,$smspasswd,$sitename,$errorlimit=-1,$captcha=false){
			
		$result=array();
		$i=0;
		
		foreach(array($smsname,$smspasswd,$sitename,$errorlimit,$captcha) as $temp){
			$result[$i]=trim($temp);
			$i++;
		}
		if($result[2]==''){
			$result[2]='簡訊發送系統';
		}
		if($result[0]=='' or $result[1]==''){
			return '簡訊服務帳號或密碼沒有設定';
		}elseif($result[3]<-1){
			return '錯誤次數限制不得小於0';
		}else{
			return $result;
		}
		
	}
	
	function contact_info_check($name,$nickname,$email,$phone,$group,$notice=""){
		$result=array();
		$i=0;
		$group=@implode(",",$group);
		foreach(array($name,$nickname,$email,$phone,$group,$notice) as $temp){
			$result[$i]=trim($temp);
			$i++;
		}
		
		if($result[4]==''){
			$result[4]='未分類';
		}
		if(mb_strstr($result[4],',')){
			$result[4]=@explode(',',$result[4]);	
		}
		
		if($result[0]=="" or $result[3]==""){
			return '姓名或手機號碼為空';
		}else if(!is_numeric($result[3])){
			return '手機號碼有誤';
		}else{
			return $result;
		}
	}
	
	function phonenum_treat($phone){	//將手機號碼加上國碼
		$result="";
		if(strlen(trim($phone))>10){
			$array_phone=explode(',',$phone);
			foreach($array_phone as $temp){
				$result.= ',886' .  substr( $temp,1,9);
			}
			return substr($result,1,strlen($result)-1);
		}else{
			return '886' . substr( $phone,1,9);
		}
	}
	
	function return_message($name){
		if(isset($_SESSION[$name])){
			$return=$_SESSION[$name];
			unset($_SESSION[$name]);
			return '<script type="text/javascript">alert("' . $return . '")</script>';
		}
	}
	
?>