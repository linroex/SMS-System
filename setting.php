<?php include("templ/init.php");$_SESSION["page-title"]="系統管理";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["site-title"]," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");include("module/sql_info.php");?>
	
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
			<div class="title">系統設定</div>
			<div id="setting">
				<form action="module/setting.php" method="post">
					<p>一、資料庫設定<br />(本系統需搭配Mongodb)</p>
					<table>
						<tr>
							<td>資料庫帳號：</td>
							<td><input type="text" name="sql_username" value="<?=$_SQL["usernm"]; ?>"/></td>
						</tr>
						<tr>
							<td>資料庫密碼：</td>
							<td><input type="password" name="sql_password" value="<?=$_SQL["passwd"]; ?>"/></td>
						</tr>
						<tr>
							<td>資料庫位址：</td>
							<td><input type="text" name="sql_address" value="<?=$_SQL["address"]; ?>"/></td>
						</tr>
					</table>
					<hr />
					<p>二、簡訊設定<br />(本系統使用Every8D提供的API進行簡訊傳送服務)</p>
					<table>
						<tr>
							<td>簡訊帳號：</td>
							<td><input type="text" name="sms_username" required/></td>
						</tr>
						<tr>
							<td>簡訊密碼：</td>
							<td><input type="password" name="sms_password" required/></td>
						</tr>
						
					</table>
					<hr />
					<p>三、網站設定</p>
					<table>
						<tr>
							<td>網站名稱：</td>
							<td><input type="text" name="site_name" /></td>
						</tr>
						<tr>
							<td>錯誤上限：</td>
							<td><input type="number" name="login_error_limit" min="0"/></td>
						</tr>
						<tr>
							<td>是否顯示驗證碼：</td>
							<td><select name="captcha" id=""><option value="true">顯示</option>
							<option value="false">不顯示</option></select></td>
						</tr>
					</table>
					<input type="submit" value="儲存設定"/>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>