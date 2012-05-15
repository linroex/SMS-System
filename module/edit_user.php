<?php 
	include("sql.php");
	include("function.php");
	include("../templ/init.php");
	
	$_id=new MongoId($_POST["_id"]);
	if($_POST["del_user"]=="del_user"){
		$users->remove(array("_id"=>$_id));
		@$_SESSION['edit_user_status']='<script type="text/javascript">alert("移除完成！！");</script>';
		header("location: ../user.php");
	}else{
		if(trim($_POST["new_passwd"])==""){
			$_POST["new_passwd"]="########";
			$_POST["new_passwd_again"]="########";
		}
		if(trim($_POST["new_passwd"])==trim($_POST["new_passwd_again"])){
			if(is_array($info=process_user_info($_POST["usernm"],$_POST["new_passwd"],$_POST["new_nickname"],$_POST["new_email"],$_POST["new_total_limit"],$_POST["new_day_limit"],$_POST["new_level"]))){
				
				$old_passwd=$users->findOne(array("_id"=>$_id));
				$info[1]=$info[1]=="########"?$old_passwd["passwd"]:$info[1];
				
				if($users->update(array("_id"=>$_id),array('$set'=>array("usernm"=>$info[0],"passwd"=>md5($info[1]),"nickname"=>$info[2],"email"=>$info[3],"day_limit"=>$info[5],"total_limit"=>$info[4],"level"=>$info[6])))){
					@$_SESSION['edit_user_status']='<script type="text/javascript">alert("修改成功！！");</script>';
				}	
			}else{
				
				@$_SESSION['edit_user_status']='<script type="text/javascript">alert("' . $info .  ' ");</script>';
			}	
		}else{
			@$_SESSION['edit_user_status']='<script type="text/javascript">alert("兩次密碼輸入不相同");</script>';
			
		}
		
		header("location: ../edit_user.php?usernm={$_POST["usernm"]}");
	}
	
?>