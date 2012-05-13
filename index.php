<?php include("module/init.php");?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>簡訊發送系統</title>
	<?php include("templ/head.php");?>
	
</head>
<body>
	<div id="index-title">
		<?php echo isset($_SESSION["site-title"])?$_SESSION["site-title"]:"簡訊發送系統"; ?>
			
	</div>
	<div id="body" style="width:700px;">
		<div class="box"><p>會員管理</p></div>
		<div class="box"><p>系統管理</p></div>
		<div class="box"><p>簡訊系統</p></div>
		<div class="box"><p>通訊錄</p></div>
		
	</div>
	
</body>
</html>