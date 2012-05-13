<?php include("templ/init.php");$_SESSION["page-title"]="簡訊系統";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["site-title"]," | ",@$_SESSION["page-title"]; ?></title>
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
			<?php include("templ/index.php"); ?>
		</div>
	</div>
	
</body>
</html>