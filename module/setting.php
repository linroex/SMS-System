<?php 
	include("../templ/init.php");
	include("sql.php");
	include("SMSHttp.php");
	include("function.php");
	
	$setting_info=setting_check_info($_POST['sms_username'],$_POST['sms_password'],$_POST['site_name'],$_POST['login_error_limit'],$_POST['captcha']);
	
		
	if($_db_setting->update(array('check'=>'999'),array('$set'=>array('sms_username'=>$setting_info[0],'sms_password'=>$setting_info[1],'site_name'=>$setting_info[2],'login_error_limit'=>$setting_info[3],'captcha'=>$setting_info[4])))){
		include("credit_count.php");
		$_SESSION['setting_result']='<script type="text/javascript">alert("設定修改成功");</script>';	
		$setting=$_db_setting->findOne();
		$_SESSION["setting"]=$setting;
		unset($setting);
		
	}else{
		$_SESSION['setting_result']='<script type="text/javascript">alert("設定修改失敗");</script>';
	}
	$sms=new SMSHttp;
	if(!$sms->getCredit($setting_info[0],$setting_info[1])){
		$_SESSION['setting_sms_error']='無法和簡訊服務提供者連線！！ ';
	}
	header('location: ../setting.php');
?>