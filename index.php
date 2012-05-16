<?php include("templ/init.php");$_SESSION["page-title"]="首頁";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<?php
		include("module/sql.php"); 
		$setting=$_db_setting->findOne();
		$_SESSION["setting"]=$setting;
		
	?>
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>

</head>
<body>
	<div id="index-title"><a href="index.php"><?php echo $_SESSION["setting"]['site_name']; ?></a></div>
	<div id="body" style="width:700px;min-width:700px;">
		<a href="viewsms.php"><div class="box"><p>簡訊系統</p></div></a>
		<div class="box"><p>通訊錄</p></div>
		<a href="user.php"><div class="box"><p>會員管理</p></div></a>
		<a href="setting.php"><div class="box"><p>系統管理</p></div></a>
	</div>
	<?php echo @$_SESSION['permissions'];unset($_SESSION['permissions'])?>
</body>
</html>