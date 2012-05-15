<?php 
	$_POST["sql_address"]=trim($_POST["sql_address"]==""?"localhost":$_POST["sql_address"]);
	if(trim($_POST["sql_username"])=="" or trim($_POST["sql_password"]=="")){
		$mongo=new Mongo($_POST["sql_address"]);
	}else{
		$mongo=new Mongo("mongodb://{$_POST["sql_username"]}:{$_POST["sql_password"]}@{$_POST["sql_address"]}");
	}
	if($mongo->connected){
		file_put_contents("sql_info.php",'<?php $_SQL["usernm"]="' . trim($_POST["sql_username"]) . "\";\n" . '$_SQL["passwd"]="' .  trim($_POST["sql_password"]) .  "\";\n" . '$_SQL["address"]="' .  $_POST["sql_address"] . '";?>');
		echo "SQL寫入成功";	
	}else{
		echo "SQL 連線有問題";
	}
	
	
	
?>