<?php
	if(isset($_SESSION["site-switch"]) or !@$_SESSION["site-switch"]){
		session_start();
		$_SESSION["site-title"]="簡訊發送系統";
		$_SESSION["site-switch"]=true;
	}
?>