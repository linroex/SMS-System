<?php
	
	session_start();
	$_SESSION["site-title"]="簡訊發送系統";
	
	if(!strstr($_SERVER["PHP_SELF"],"index.php")){
		if(@$_SESSION["login-status"]!=1){
			
			if(!strstr($_SERVER["PHP_SELF"],"login.php")){
				
				header("location:login.php");
			}
		}else{
			if(strstr($_SERVER["PHP_SELF"],"user.php") or strstr($_SERVER["PHP_SELF"],"setting.php")){
				if($_SESSION["user-info"]["level"]!="admin"){
					header("location:index.php");
				}
					
			}	
		}
	}
	
?>