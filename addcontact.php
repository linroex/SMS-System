<?php include("templ/init.php");$_SESSION["page-title"]="新增聯絡人";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	<?php include("module/sql.php");?>
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
			<div class="title">新增聯絡人</div>
			<div id="addcontact">
				<form action="module/addcontact.php" method="post">
					<table>
						<tr>
							<td style="width:30%;">姓名：*</td>
							<td><input type="text" name="name" required/></td>
						</tr>
						<tr>
							<td>暱稱：</td>
							<td><input type="text" name="nickname"/></td>
						</tr>
						<tr>
							<td>信箱：</td>
							<td><input type="text" name="email" /></td>
						</tr>
						<tr>
							<td>手機：*</td>
							<td><input type="text" name="phone" required/></td>
						</tr>
						<tr>
							<td>群組：</td>
							<td>
							<?php 
								foreach($group->find(array()) as $temp){
									echo "<input type=\"checkbox\" name=\"group[]\" value=\"{$temp["group_name"]}\" />",$temp["group_name"],"<br />";
								}	
							?>
							</td>
						</tr>
						<tr>
							<td>備註：</td>
							<td><textarea name="notice" cols="30" rows="6"></textarea></td>
						</tr>
					</table>
					<center><input type="submit" value="送出" id="submit" /></center>
					<?php 
						if(isset($_SESSION['add_contact_message'])){
							echo '<script type="text/javascript">alert("'. $_SESSION['add_contact_message'] .'")</script>';
							unset($_SESSION['add_contact_message']);
						}
					?>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>