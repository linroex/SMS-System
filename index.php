<?php include("templ/init.php");$_SESSION["page-title"]="首頁";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["site-title"]," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	
</head>
<body>
	<div id="index-title"><a href="index.php"><?php echo $_SESSION["site-title"]; ?></a></div>
	<div id="body" style="width:700px;">
		<a href="user.php"><div class="box"><p>會員管理</p></div></a>
		<a href="setting.php"><div class="box"><p>系統管理</p></div></a>
		<a href="viewsms.php"><div class="box"><p>簡訊系統</p></div></a>
		<div class="box"><p>通訊錄</p></div>
		
	</div>
	
</body>
</html>