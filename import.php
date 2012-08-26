<?php include("templ/init.php");$_SESSION["page-title"]="匯入";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	
</head>
<body>
	
	<div id="body">
		<div id="title"><a href="index.php"><?php include("templ/title.php"); ?></a></div>
		<div id="menu">
			<?php include("templ/menu.php"); ?>
		</div>
		
		<div id="slider">
			<?php include("templ/slider.php"); ?>
		</div>
		<div id="main">
			<div class="title">匯入/匯出</div>
			<center>
				<p>此處接受Google CSV格式的聯絡人匯入</p>
			</center>
			<form action="module/import.php" method="post" enctype="multipart/form-data">
				<input type="file" name="import" />
				<input type="submit" value="上傳" />
			</form>
		</div>
	</div>
	
</body>
</html>