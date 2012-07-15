<?php 
	include("../templ/init.php");
	include("sql.php");
	include("NexmoMessage.php");
	include("function.php");
	
	date_timezone_set('TW');
	
	$getmessage=isset($_POST['phone'])?trim($_POST['phone']):'';
	if(isset($_POST['group'])){
		foreach($contact->find(array('group'=>array('$in'=>$_POST['group']),'pertain'=>$_SESSION["user-info"]['usernm'])) as $temp){
			$getmessage.=',' . $temp['phone'];
		}
	}
	
	$sms=new NexmoMessage($_SESSION["setting"]['sms_username'],$_SESSION["setting"]['sms_password']);
	$user_point=$users->findOne(array('usernm'=>$_SESSION["user-info"]['usernm']),array('total_limit'=>true));
	$user_point=$user_point['total_limit'];
	if($user_point>0){
		$send_return=$sms->sendText(phonenum_treat($getmessage),$_SESSION["setting"]['sms_from'],$_POST['content'],true);
		if($send_return->cost!=0){
			$_SESSION['send_status']='寄送成功，花費點數' . (int)($send_return->cost/0.011);
			$users->update(array('usernm'=>$_SESSION["user-info"]['usernm']),array('$set'=>array('total_limit'=>$user_point-(int)($send_return->cost/0.011))));
			$time=getdate();
			$history->insert(array('time'=>"{$time['year']}/{$time['mon']}/{$time['mday']} {$time['hours']}:{$time['minutes']}",'content'=>$_POST['content'],'cost'=>(int)($send_return->cost/0.011),'to'=>$getmessage,'pertain'=>$_SESSION["user-info"]['usernm']));
		}elseif(trim($_POST['content'])==""){
			$_SESSION['send_status']="發送失敗，請填入簡訊內容，勿留空";
		}else{
			$_SESSION['send_status']="發送失敗，請聯絡管理員";
		}
	}else{
		$_SESSION['send_status']='發送失敗，可能是點數不足';
	}
	include('credit_count.php');
	header('Location:../sendsms.php');
	
?>