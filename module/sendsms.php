<?php 
	session_start();
	include("../templ/init.php");
	include("sql.php");
	include("NexmoMessage.php");
	include("function.php");
	
	date_default_timezone_set('Asia/Taipei');		//時區設定
	
	//將收件者、聯絡人、群組的手機號碼整合成字串
	$getmessage=isset($_POST['phone'])?trim($_POST['phone']):'';
	if(isset($_POST['group'])){
		foreach($contact->find(array('group'=>array('$in'=>$_POST['group']),'pertain'=>$_SESSION["user-info"]['usernm'])) as $temp){
			$getmessage.=',' . $temp['phone'];
		}
	}
	$getmessage.=',' . implode(',',$_POST['contact']);
	$getmessage=trim($getmessage);
	
	//將開頭多餘的逗號拿掉，避免估算耗費點數時有誤差
	if($getmessage[0]==','){
		$getmessage=substr($getmessage,1,strlen($getmessage));
	}
	
	$user_point=$users->findOne(array('usernm'=>$_SESSION["user-info"]['usernm']),array('total_limit'=>true));
	$user_point=$user_point['total_limit'];
	
	$phone_num=explode(',',$getmessage);
	$phone_num=count($phone_num);				//計算收件者數目
	$sms_per=mb_strlen($_POST['content'])/70;	//計算內容的長度會寄出幾封簡訊
	
	if($user_point>ceil($sms_per*$phone_num)){			//判斷寄出的簡訊所花的點數是否超過剩餘點數，避免點數出現負值
		
		$sms=new NexmoMessage($_SESSION["setting"]['sms_username'],$_SESSION["setting"]['sms_password']);
		
		
		$send_return=$sms->sendText(phonenum_treat($getmessage),$_SESSION["setting"]['sms_from'],$_POST['content'],true);		//發送簡訊
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
		
		include('credit_count.php');
	}else{
		$_SESSION['send_status']='發送失敗，可能是點數不足';
	}
	header('Location:../sendsms.php');
	
?>