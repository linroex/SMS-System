<?php 
	$_SQL["usernm"]="";
	$_SQL["passwd"]="";
	$_SQL["address"]="localhost";
	if(trim($_SQL["usernm"])=="" or trim($_SQL["passwd"])==""){
		$mongo=new Mongo($_SQL["address"]);
	}else{
		$mongo=new Mongo("mongodb://{$_SQL["usernm"]}:{$_SQL["passwd"]}@{$_SQL["address"]}");
	}
	
?>