<?php include("templ/init.php");$_SESSION["page-title"]="登入";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION['setting']['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	
</head>
<body>
	
	<div id="body">
		<div id="index-title"><a href="index.php"><?php echo $_SESSION["setting"]['site_name']; ?></a></div>
		<div id="login">
			<?php 
				echo return_message('login-status');
			?>
			<form action="module/login.php" method="post">
				<p>帳號：<input type="text" name="usernm" size="10" required/><br />
				密碼：<input type="password" name="passwd" size="10" required/></p>
				<input type="submit" value="登入" id="submit" align="right"/>
			</form>
		</div>
	</div>
	
</body>
</html>