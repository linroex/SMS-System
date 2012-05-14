<?php include("templ/init.php");$_SESSION["page-title"]="";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["site-title"]," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	
</head>
<body>
	
	<div id="body">
		<div id="index-title"><a href="index.php"><?php echo $_SESSION["site-title"]; ?></a></div>
		<div id="login">
			<?php 
				if(isset($_SESSION["login-status"])){
					echo '<script type="text/javascript">alert("',$_SESSION["login-status"],'");</script>';
					unset($_SESSION["login-status"]);
				}
			?>
			<form action="module/login.php" method="post">
				<p>帳號：<input type="text" name="usernm" id="" size="10"/><br />
				密碼：<input type="password" name="passwd" id="" size="10"/></p>
				<input type="submit" value="登入" id="submit" align="right"/>
			</form>
		</div>
	</div>
	
</body>
</html>