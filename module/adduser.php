<?php 
	include("sql.php");
	include("../templ/init.php");
	include("function.php");
	
	if(is_array($info=process_user_info($_POST["username"],$_POST["passwd"],$_POST["nickname"],$_POST["email"],$_POST["sms_limit_total"],$_POST["sms_limit_day"],$_POST["level"]))){
		$check_same_user=$users->findOne(array("usernm"=>$info[0]));
		if($info[0]==$check_same_user["usernm"]){
			$_SESSION["adduser_result"]="資料庫已經有相同帳號出現，建議改一個帳號";
			
		}else{
			
			
				if($info[4]<=$_SESSION['setting']['total_credit']){
				$users->insert(array("nickname"=>$info[2],"usernm"=>$info[0],"passwd"=>$info[1],"email"=>$info[3],"day_limit"=>$info[5],"total_limit"=>$info[4],"level"=>$info[6]));
				$group->insert(array("group_name"=>"未分類","pertain"=>$info[0]));
				$_SESSION["adduser_result"]="帳號{$info[0]}新增成功";	
				$_db_setting->update(array('check'=>'999'),array('$set'=>array('total_credit'=>$_SESSION['setting']['total_credit']-$info[4])));
				$_SESSION['setting']['total_credit']-=$info[4];	
				
					
				}else{
					$_SESSION["adduser_result"]="系統剩餘點數不足";	
				}
				
			

		}
	}else{
		$_SESSION["adduser_result"]=$info;
	}

	header("location:../adduser.php");
	
?>