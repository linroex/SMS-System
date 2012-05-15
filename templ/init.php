<?php
	
	session_start();
	$_SESSION["site-title"]="簡訊發送系統";
	
	if(!strstr($_SERVER["PHP_SELF"],"index.php")){
		if(@$_SESSION["login-status"]!=1){
			if(!strstr($_SERVER["PHP_SELF"],"login.php")){
				header("location:login.php");
			}
		}else{
			if(strstr($_SERVER["PHP_SELF"],"/user.php") or strstr($_SERVER["PHP_SELF"],"/setting.php") or strstr($_SERVER["PHP_SELF"],"/adduser.php")){
				if($_SESSION["user-info"]["level"]!="admin"){
					$_SESSION['permissions']='<script type="text/javascript">alert("您的權限不夠瀏覽此頁面！故將您自動送回首頁");</script>';
					header("location:index.php");
				}
			}	
		}
	}
	
?>