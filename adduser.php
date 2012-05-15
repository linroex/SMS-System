<?php include("templ/init.php");$_SESSION["page-title"]="新增用戶";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["site-title"]," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	<?php 
		if(isset($_SESSION["adduser_result"])){
			echo '<script type="text/javascript">alert("',$_SESSION["adduser_result"],'");</script>';
			unset($_SESSION["adduser_result"]);
		}
	?>
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
			<div id="adduser">
				<span class="title"><center>新增用戶</center></span>
				
					<ul>
						<li>帳號至少5個字，密碼至少8個字長</li>
						<li>使用者分為兩種等級：一種是普通用戶，只能使用簡訊系統、通訊錄，另一種是管理用戶，可以使用所有功能，包含新增用戶</li>
						<li>總額度上限可以讓你設定該用戶最多可以發送多少封簡訊,每發送一封簡訊則減少1點，不設定則留空</li>
						<li>每日傳送上限可以設定該用戶每日可以傳送多少封簡訊，不設定則留空</li>
						<li>管理用戶無需設定寄送上限</li>
					</ul>
					
				
				
				<form action="module/adduser.php" method="post">
					<table>
						<tr>
							<td>暱稱：</td>
							<td><input type="text" name="nickname" id="" /></td>
						</tr>
						<tr>
							<td>帳號:</td>
							<td><input type="text" name="username" id="" /></td>
						</tr>
						<tr>
							<td>密碼:</td>
							<td><input type="password" name="passwd" id="" /></td>
						</tr>
						<tr>
							<td>在輸入密碼:</td>
							<td><input type="password" name="sec_passwd" id="" /></td>
						</tr>
						<tr>
							<td>信箱：</td>
							<td><input type="text" name="email" id="" /></td>
						</tr>
						<tr>
							<td>每日傳送上限:</td>
							<td><input type="text" name="sms_limit_day" id="" /></td>
						</tr>
						<tr>
							<td>總額度上限:</td>
							<td><input type="text" name="sms_limit_total" id="" /></td>
						</tr>
						<tr>
							<td>等級</td>
							<td><select name="level" id=""><option value="normal">normal</option>
							<option value="admin">admin</option></select></td>
						</tr>
						<input type="submit" id="submit" value="送出"/>
						
					</table>					
				</form>
				
			</div>
		</div>
	</div>
	
</body>
</html>