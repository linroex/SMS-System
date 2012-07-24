<?php 
	session_start();
	include("sql.php");
	include("function.php");
	
	if($_POST['check']==floor(time()/240)){
		$_id=new MongoId($_POST["_id"]);
		if($_POST["del_user"]=="del_user"){
			$users->remove(array("_id"=>$_id));
			$_SESSION['edit_user_status']='移除完成！！';
			
			include('credit_count.php');
			
			header('location: ../user.php');
		}else{
			
			if(trim($_POST["new_passwd"])==""){
				$_POST["new_passwd"]="########";
				$_POST["new_passwd_again"]="########";
			}
			if(trim($_POST["new_passwd"])==trim($_POST["new_passwd_again"])){
				if(is_array($info=process_user_info($_POST["usernm"],$_POST["new_passwd"],$_POST["new_nickname"],$_POST["new_email"],$_POST["new_total_limit"],$_POST["new_day_limit"],$_POST["new_level"]))){
					
					$old_userinfo=$users->findOne(array("_id"=>$_id));
					
					$info[1]=($info[1]==md5("########")?$old_userinfo["passwd"]:$info[1]);
					
					$balance=abs($old_userinfo['total_limit']-$info[4]);
					if($old_userinfo['total_limit']>$info[4] and $info[4]>=0){
						$_db_setting->update(array('check'=>'999'),array('$set'=>array('total_credit'=>$_SESSION['setting']['total_credit']+$balance)));
						$_SESSION['setting']['total_credit']+=$balance;
						$users->update(array("_id"=>$_id),array('$set'=>array("usernm"=>$info[0],"passwd"=>$info[1],"nickname"=>$info[2],"email"=>$info[3],"day_limit"=>$info[5],"total_limit"=>$info[4],"level"=>$info[6],'phone'=>trim($_POST['phone']))));
						@$_SESSION['edit_user_status']='修改成功！！';	
					}elseif($old_userinfo['total_limit']<$info[4] and $info[4]>=0 and $_SESSION['setting']['total_credit']>=$balance){
						$_db_setting->update(array('check'=>'999'),array('$set'=>array('total_credit'=>$_SESSION['setting']['total_credit']-$balance)));
						$_SESSION['setting']['total_credit']-=$balance;
						$users->update(array("_id"=>$_id),array('$set'=>array("usernm"=>$info[0],"passwd"=>$info[1],"nickname"=>$info[2],"email"=>$info[3],"total_limit"=>$info[4],"level"=>$info[6],'phone'=>trim($_POST['phone']))));
						@$_SESSION['edit_user_status']='修改成功！！';	
					}elseif($old_userinfo['total_limit']==$info[4]){
						
						$users->update(array("_id"=>$_id),array('$set'=>array("usernm"=>$info[0],"passwd"=>$info[1],"nickname"=>$info[2],"email"=>$info[3],"total_limit"=>$info[4],"level"=>$info[6],'phone'=>trim($_POST['phone']))));
						@$_SESSION['edit_user_status']='修改成功！！';	
						
					}else{@$_SESSION['edit_user_status']='系統剩餘點數不足！！';}
				
				}else{@$_SESSION['edit_user_status']=$info;}	
			}else{@$_SESSION['edit_user_status']='兩次密碼輸入不相同';}
			$_SESSION["user-info"]=$users->findOne(array("usernm"=>$_POST["usernm"]));
			
		}
	}else{
		$_SESSION['edit_user_status']='檢核碼不正確，可能是編輯時間過久';
	}
	header("location: ../user.php");
?>