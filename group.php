<?php include("templ/init.php");$_SESSION["page-title"]="群組";?>
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
			<a href="group_manager.php">新增群組請按我</a>
			<?php 
				if(isset($_SESSION['edit_group_message'])){
					echo '<script type="text/javascript">alert("' . $_SESSION['edit_group_message'] . '")</script>';
				}
			?>
		</div>
	</div>
	
</body>
</html>