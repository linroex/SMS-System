<?php 
	include_once("SMSHttp.php");
	include("sql.php");
	session_start();
	$sms=new SMSHttp;
	@$sms->getCredit($_SESSION["setting"]['sms_username'],$_SESSION["setting"]['sms_password']);
	$x=$users->find(array(),array('total_limit'=>true));
	$total_decrease=0;
	foreach($x as $t){
		$total_decrease+=(int)$t['total_limit'];
	}
	
	$_db_setting->update(array('check'=>'999'),array('$set'=>array('total_credit'=>$sms->credit-$total_decrease)));
	$_SESSION['setting']['total_credit']=$sms->credit-$total_decrease;
	unset($sms);
?>