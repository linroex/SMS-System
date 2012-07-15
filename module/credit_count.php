<?php 
	include_once("NexmoAccount.php");
	include("sql.php");
	session_start();
	$sms=new NexmoAccount($_SESSION["setting"]['sms_username'],$_SESSION["setting"]['sms_password']);
	$sms->balance();
	$temp_point=floor(($sms->cache['balance']/0.011));
	
	$x=$users->find(array(),array('total_limit'=>true));
	$total_decrease=0;
	foreach($x as $t){
		$total_decrease+=(int)$t['total_limit'];
	}
	
	$_db_setting->update(array('check'=>'999'),array('$set'=>array('total_credit'=>$temp_point-$total_decrease)));
	$_SESSION['setting']['total_credit']=$temp_point-$total_decrease;
	unset($sms);
?>