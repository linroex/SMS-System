<?php include("templ/init.php");$_SESSION["page-title"]="會員管理";?>
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
			<div id="viewuser">
				<span class="title"><center>檢視會員</center></span>
				<table>
					
					<tr>
						<td></td>
						<td>暱稱</td>
						<td>帳號</td>
						<td>信箱</td>
						<td>每日限制</td>
						<td>剩餘點數</td>
						<td>等級</td>
					</tr>
				<?php 
					include("module/sql.php");
					$users=$mongo->sms_system->users;
					$result=$users->find();
					foreach($result as $temp){
						echo "<tr>
							<td><a href=\"\">[編輯]</a></td>
							<td>{$temp['nickname']}</td>
							<td>{$temp['usernm']}</td>
							<td>{$temp['email']}</td>
							<td>{$temp['day_limit']}</td>
							<td>{$temp['total_limit']}</td>
							<td>{$temp['level']}</td>
						</tr>";
					}
					
				?>
				</table>
			</div>
		</div>
	</div>
	
</body>
</html>