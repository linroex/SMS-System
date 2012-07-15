<?php include("templ/init.php");$_SESSION["page-title"]="新增聯絡人";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	<?php include("module/sql.php");?>
	<?php 
		if(isset($_GET['conid'])){
			
			$info_id=new MongoId(trim($_GET['conid']));
			$contact_info=$contact->findOne(array('_id'=>$info_id));	
			if($contact_info==NULL){
				echo '<script type="text/javascript">alert("查無此資料");</script>';
				
			}
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
			<div class="title">新增/管理聯絡人</div>
			<div id="addcontact">
				<form action="module/addcontact.php" method="post">
					<table>
						<tr>
							<td style="width:30%;">姓名：*</td>
							<td><input type="text" name="name" value="<?php echo @$contact_info==NULL?'':$contact_info['name']; ?>" required/></td>
						</tr>
						<tr>
							<td>暱稱：</td>
							<td><input type="text" name="nickname" value="<?php echo @$contact_info==NULL?'':$contact_info['nickname']; ?>" /></td>
						</tr>
						<tr>
							<td>信箱：</td>
							<td><input type="text" name="email" value="<?php echo @$contact_info==NULL?'':$contact_info['email']; ?>"/></td>
						</tr>
						<tr>
							<td>手機：*</td>
							<td><input type="text" name="phone" value="<?php echo @$contact_info==NULL?'':$contact_info['phone']; ?>" required/></td>
						</tr>
						<tr>
							<td>群組：</td>
							<td>
							<?php 
								if(@$contact_info==NULL){
									foreach($group->find(array('pertain'=>$_SESSION["user-info"]['usernm'])) as $temp){
										echo "<input type=\"checkbox\" name=\"group[]\" value=\"{$temp["group_name"]}\" />",$temp["group_name"],"&nbsp&nbsp&nbsp&nbsp";
									}	
								}else{
									echo '群組調整請到<a href="group.php">「群組」</a>頁面進行設定';
								}
							?>
							</td>
						</tr>
						<tr>
							<td>備註：</td>
							<td><textarea name="notice" cols="30" rows="6"><?php echo @$contact_info==NULL?'':$contact_info['notice']; ?></textarea></td>
						</tr>
						<tr>
							<td>移除聯絡人：</td>
							<td>[移除<input type="radio" name="del_contact" value="true"/>][不移除<input type="radio" name="del_contact" value="false" checked/>]</td>
						</tr>
						<input type="hidden" name="editorcreate" value="<?=@$contact_info==NULL?'false':'true'; ?>"/>
						<input type="hidden" name="_id" value="<?=isset($_GET['conid'])?$_GET['conid']:'';?>"/>
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