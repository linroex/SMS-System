<?php include("templ/init.php");$_SESSION["page-title"]="群組管理";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");include("module/sql.php")?>
	
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
			<div class="title">群組管理</div>
			<form action="module/group.php" method="post">
				<table id="group_manager">
					<tr>
						<td>群組名稱：</td>
						<td><input type="text" name="group_name" value="<?php (isset($_GET['oldname']) and isset($_GET['edit_group']) and $_GET['edit_group']=='true')?$_GET['oldname']:'';?>" required/></td>
					</tr>
					<tr>
						<td>群組成員</td>
						<td>
							<?php 
								foreach($contact->find() as $temp){
									if(@in_array($_GET['oldname'],$temp['group'])){
										echo '<input type="checkbox" name="group_member[]" value="'. $temp['name'] .'" checked/>' . $temp['name'] . '&nbsp&nbsp&nbsp';
									}else{
										echo '<input type="checkbox" name="group_member[]" value="'. $temp['name'] .'"/>' . $temp['name'] . '&nbsp&nbsp&nbsp';
									}
								}
							?>
						</td>
					</tr>
					<tr>
						<td>群組介紹：</td>
						<td><textarea name="group_note"cols="20" rows="5"><?php (isset($_GET['edit_group']) and $_GET['edit_group']=='true' and isset($_GET['oldnote']))?$_GET['oldnote']:'';?></textarea></td>
					</tr>
					<input type="hidden" name="check" value="<?php echo (isset($_GET['edit_group']) and $_GET['edit_group']=='true')?'true':"false";?>" />
					<tr><td colspan=2><center><input type="submit" id="submit" value="送出"/></center></td><td></td></tr>
				</table>
				
			</form>
		</div>
	</div>
	
</body>
</html>