<?php include("templ/init.php");$_SESSION["page-title"]="檢視通訊錄";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	<?php 
		echo return_message('add_contact_message');
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
			<div class="title">檢視通訊錄</div>
			<div id="view">
				<center><a href="addcontact.php"><input type="button" value="新增聯絡人" /></a><a href="module/del_all_contact.php"><input type="button" value="刪除所有聯絡人" /></a></center>
				<table>
					
					<tr>
						<td></td>
						<td>姓名</td>
						<td>暱稱</td>
						<td>信箱</td>
						<td>手機</td>
						<td>群組</td>
						<td>備註</td>
					</tr>
				<?php 
					include("module/sql.php");
					
					$result=$contact->find(array('pertain'=>$_SESSION["user-info"]['usernm']));
					foreach($result as $temp){
						echo "<tr>
							<td><a href=\"addcontact.php?conid={$temp['_id']}\">[編輯]</a></td>
							<td>{$temp['name']}</td>
							<td>{$temp['nickname']}</td>
							<td>{$temp['email']}</td>
							<td>{$temp['phone']}</td>
							<td>{$temp['group']}</td>
							<td>{$temp['notice']}</td>
						</tr>";
					}
					//var_dump($result);
				?>
				</table>
			</div>
		</div>
	</div>
	
</body>
</html>