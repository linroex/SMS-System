<?php include("templ/init.php");$_SESSION["page-title"]="編輯個人資料";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION['setting']['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	<?php echo return_message('edit_porfile_status');?>
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
			<div class="title">編輯個人資料</div>
			<div id="edit-user">
				<ul>
					<li>如果沒有要修改密碼，則「新密碼、再輸入一次」兩欄留空</li>
					<li>要刪除用戶的話請把「移除」打勾，否則請打勾「不移除」</li>
				</ul>
				
				<form action="module/edit_profile.php" method="post">
					<table>
					<tr>
						<td>帳號：</td>
						<td><input type="text" value="<?=$_SESSION['user-info']['usernm'] ?>" disabled/></td>
					</tr>
					<tr>
						<td>暱稱：</td>
						<td><input type="text" name="nickname" value="<?=$_SESSION['user-info']['nickname'] ?>" required/></td>
					</tr>
					<tr>
						<td>新密碼：</td>
						<td><input type="password" name="passwd" /></td>
					</tr>
					<tr>
						<td>再輸入一次:</td>
						<td><input type="password" name="passwd_again"/></td>
					</tr>
					<tr>
						<td>信箱:</td>
						<td><input type="text" name="email" value="<?=$_SESSION['user-info']['email'] ?>" required/></td>
					</tr>
					<input type="hidden" name="check" value="<?php srand(time());$_SESSION['check']=rand(10000000,99999999); echo $_SESSION['check'] ?>"/>
					<tr><td colspan="2" align="center"><input id="submit" type="submit" value="送出" /></td><td></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>