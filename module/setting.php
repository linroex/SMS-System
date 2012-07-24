<?php 
	include("../templ/init.php");
	include("sql.php");
	include_once("NexmoAccount.php");
	include("function.php");
	
	if($_POST['check']==$_SESSION['check']){
		unset($_SESSION['check']);
		$setting_info=setting_check_info($_POST['sms_username'],$_POST['sms_password'],$_POST['site_name'],$_POST['login_error_limit'],$_POST['captcha']);
		
			
		if($_db_setting->update(array('check'=>'999'),array('$set'=>array('sms_username'=>$setting_info[0],'sms_password'=>$setting_info[1],'site_name'=>$setting_info[2],'login_error_limit'=>$setting_info[3],'sms_from'=>trim($_POST['sms_from']),'sms_from_set'=>$_POST['sms_from_set'])))){
			include("credit_count.php");
			$_SESSION['setting_result']='設定修改成功';	
			$setting=$_db_setting->findOne();
			$_SESSION["setting"]=$setting;
			unset($setting);
			
		}else{
			$_SESSION['setting_result']='設定修改失敗';
		}
		$sms=new NexmoAccount($_SESSION["setting"]['sms_username'],$_SESSION["setting"]['sms_password']);
		
		if(!$sms->balance()){
			$_SESSION['setting_sms_error']='無法和簡訊服務提供者連線！！ ';
		}
	}else{
		$_SESSION['setting_result']='檢核碼錯誤，請勿嘗試攻擊本系統';
	}
	header('location: ../setting.php');
?>