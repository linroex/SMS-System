<?php include("templ/init.php");$_SESSION["page-title"]="系統管理";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");include("module/sql.php");?>
	
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
			<?php 
				$setting=$_db_setting->findOne();
				if(isset($_SESSION['setting_result'])){
					echo $_SESSION['setting_result'];
					unset($_SESSION['setting_result']);
				}
			?>
			<div id="setting">
				<form action="module/setting.php" method="post">
					<p>一、簡訊設定<br />(本系統使用Every8D提供的API進行簡訊傳送服務)</p>
					<table>
						<tr>
							<td>簡訊帳號：</td>
							<td><input type="text" name="sms_username" value="<?=$setting['sms_username']?>" required/></td>
						</tr>
						<tr>
							<td>簡訊密碼：</td>
							<td><input type="password" name="sms_password" value="<?=$setting['sms_password']?>" required/></td>
						</tr>
						<center class="warning"><?php 
							if(isset($_SESSION['setting_sms_error'])){
								echo $_SESSION['setting_sms_error'];
								unset($_SESSION['setting_sms_error']);
							}?></center>
					</table>
					
					<p>二、網站設定</p>
					<table>
						<tr>
							<td>網站名稱：</td>
							<td><input type="text" name="site_name" value="<?=$setting['site_name']?>"/></td>
						</tr>
						<tr>
							<td>錯誤上限：</td>
							<td><input type="number" name="login_error_limit" min="0" value="<?=$setting['login_error_limit']?>"/></td>
						</tr>
						<tr>
							<td>是否顯示驗證碼：</td>
							<td><select name="captcha"><option value="true">顯示</option>
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