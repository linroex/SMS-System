<?php 
	include("sql.php");
	include("../templ/init.php");
	$users=$mongo->sms_system->users;
	$i=-1;
	foreach($_POST as $temp){
		$_info[$i+=1]=trim($temp);
	}
	
	if(strlen($_info[1])>4 and strlen($_info[2])>7 and $_info[0]!=""){
		if($_info[2]==$_info[3]){
			$check_same_user=$users->findOne(array("usernm"=>$_info[1]));
			if($_info[1]==$check_same_user["usernm"]){
				$_SESSION["adduser_result"]="資料庫已經有相同帳號出現，建議改一個帳號";
			}else{
				if($users->insert(array("nickname"=>$_info[0],"usernm"=>$_info[1],"passwd"=>md5($_info[2]),"email"=>$_info[4],"day_limit"=>$_info[5],"total_limit"=>$_info[6],"level"=>$_info[7]))){
					$_SESSION["adduser_result"]="帳號{$_info[1]}新增成功";	
				}
			}
		}else{
			$_SESSION["adduser_result"]="檢查您的密碼是否兩次輸入不相同";
		}
	}else{
		$_SESSION["adduser_result"]="帳號或密碼不符合規則或是未輸入暱稱";
	}

	header("location:../adduser.php");
?>