<?php include("templ/init.php");$_SESSION["page-title"]="群組";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");include('module/sql.php');?>
	<?php 
		echo return_message('edit_group_message');
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
			<div class="title">群組檢視</div>
			
			<br />
			<center><a href="group_manager.php"><input type="button" value="新增群組" /></a></center>
			
			<br />
			<div id="view" style="width:70%;margin:10px auto;">
			<table >
				<tr>
					<td style="width:15%;"></td>
					<td style="width:20%;">名稱</td>
					<td style="width:55%;">備註</td>
				</tr>
				<?php 
					foreach($group->find(array('pertain'=>$_SESSION["user-info"]['usernm'])) as $temp){
						
						$temp['group_note']=isset($temp['group_note'])?$temp['group_note']:'';
						echo '<tr>
							<td><a href="group_manager.php?edit_group=true&oldname=' . $temp['group_name'] . '&oldnote=' . $temp['group_note'] . '">[編輯]</a></td>
							<td>' . $temp['group_name'] . '</td>
							<td>' . $temp['group_note'] . '</td>
						</tr>';
					}
				?>
			</table>
			</div>
		</div>
	</div>
	
</body>
</html>