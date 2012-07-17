<?php include("templ/init.php");$_SESSION["page-title"]="系統管理";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");include("module/sql.php");?>
	<?php 
		$setting=$_db_setting->findOne();
		echo $return_message('edit_user_status');
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
			<div class="title">系統設定</div>
			
			<div id="setting">
				
				<a target="_blank" href="module/credit_count.php"><input type="button" value="手動計算可用點數"/></a>
				<form action="module/setting.php" method="post">
					
					<p>一、簡訊設定<br />(本系統使用Nexmo提供的API進行簡訊傳送服務)</p>
					<p>發送者限制使用英文、數字</p>
					<table>
						<tr>
							<td>API Key：*</td>
							<td><input type="text" name="sms_username" value="<?=@$setting['sms_username']?>" required/></td>
						</tr>
						<tr>
							<td>API Secret：*</td>
							<td><input type="password" name="sms_password" value="<?=@$setting['sms_password']?>" required/></td>
						</tr>
						<tr>
							<td>發送者：*</td>
							<td><input type="text" name="sms_from" value="<?=@$setting['sms_from']?>" required/></td>
						</tr>
						<center class="warning"><?php 
							if(isset($_SESSION['setting_sms_error'])){
								echo $_SESSION['setting_sms_error'];
								unset($_SESSION['setting_sms_error']);
							}?>
						</center>
					</table>
					
					<p>二、網站設定</p>
					<table>
						<tr>
							<td>網站名稱：</td>
							<td><input type="text" name="site_name" value="<?=$setting['site_name']?>"/></td>
						</tr>
						<tr>
							<td>錯誤上限：</td>
							<td><input type="number" name="login_error_limit" min="-1" value="<?=$setting['login_error_limit']?>"/></td>
						</tr>
						
					</table>
					<input type="submit" value="儲存設定"/>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>