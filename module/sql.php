<?php 
	include("sql_info.php");

	if(trim($_SQL["usernm"])=="" or trim($_SQL["passwd"])==""){
		$mongo=new Mongo($_SQL["address"]);
	}else{
		$mongo=new Mongo("mongodb://{$_SQL["usernm"]}:{$_SQL["passwd"]}@{$_SQL["address"]}");
	}
	$smsdb=$mongo->sms_system;
	$users=$smsdb->users;
	$group=$smsdb->contact_group;
	$contact=$smsdb->contact;
	$_db_setting=$smsdb->setting;
	$history=$smsdb->history;
	$setting=$_db_setting->findOne();
	$_SESSION["setting"]=$setting;

?>
