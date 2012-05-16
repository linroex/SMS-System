<?php 
	include("sql.php");
	include("../templ/init.php");
	include("function.php");
	
	if(is_array($info=process_user_info($_POST["username"],$_POST["passwd"],$_POST["nickname"],$_POST["email"],$_POST["sms_limit_total"],$_POST["sms_limit_day"],$_POST["level"]))){
		$check_same_user=$users->findOne(array("usernm"=>$info[0]));
		if($info[0]==$check_same_user["usernm"]){
			$_SESSION["adduser_result"]="資料庫已經有相同帳號出現，建議改一個帳號";
			
		}else{
			
			if($users->insert(array("nickname"=>$info[2],"usernm"=>$info[0],"passwd"=>md5($info[1]),"email"=>$info[3],"day_limit"=>(int)$info[5],"total_limit"=>(int)$info[4],"level"=>$info[6]))){
				$_SESSION["adduser_result"]="帳號{$info[0]}新增成功";	
			}

		}
	}else{
		$_SESSION["adduser_result"]=$info;
	}

	header("location:../adduser.php");
	
?>