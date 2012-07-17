<?php include("templ/init.php");$_SESSION["page-title"]="編輯用戶";?>
<?php 
	if($_SESSION["user-info"]["level"]!="admin"){
		$_SESSION['permissions']='<script type="text/javascript">alert("您的權限不夠瀏覽此頁面！故將您自動送回首頁");</script>';
		header("location: index.php");
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	<?php 
		echo return_message('edit_user_status');
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
			<div class="title">用戶資料編輯</div>
			<div id="edit-user">
				<ul>
					<li>如果沒有要修改密碼，則「新密碼、再輸入一次」兩欄留空</li>
					<li>要刪除用戶的話請把「移除」打勾，否則請打勾「不移除」</li>
					
				</ul>
				
				<form action="module/edit_user.php" method="post">
					<table>
					<?php
						include("module/sql.php");
						
						if($users->findOne(array("usernm"=>$_GET["usernm"]))!=NULL){
							$userinfo=$users->findOne(array("usernm"=>$_GET["usernm"]));
							$another_level=$userinfo["level"]=="normal"?"admin":"normal";
							
							if(isset($_SESSION['edit_user_status'])){
								echo $_SESSION['edit_user_status'];
								unset($_SESSION['edit_user_status']);
							}
							echo "
							<input type=\"hidden\" name=\"_id\" value=\"{$userinfo["_id"]}\" />
							<tr>
								<td>帳號：</td>
								<td><input name=\"usernm\" type=\"text\" value=\"{$userinfo["usernm"]}\" required/></td>
							</tr>
							<tr>
								<td>新密碼：</td>
								<td><input type=\"password\" name=\"new_passwd\" /></td>
							</tr>
							<tr>
								<td>再輸入一次：</td>
								<td><input type=\"password\" name=\"new_passwd_again\" /></td>
							</tr>
							<tr>
								<td>暱稱：</td>
								<td><input type=\"text\" value=\"{$userinfo["nickname"]}\" name=\"new_nickname\" required/></td>
							</tr>
							<tr>
								<td>信箱：</td>
								<td><input type=\"email\" value=\"{$userinfo["email"]}\" name=\"new_email\" required/></td>
							</tr>
							<tr>
								<td>手機：</td>
								<td><input type=\"text\" name=\"phone\" value=\"{$userinfo["phone"]}\" /></td>
							</tr>
							<tr>
								<td>總額度限制：<br />(剩餘：{$_SESSION['setting']['total_credit']})</td>
								<td><input type=\"number\" value=\"{$userinfo["total_limit"]}\" name=\"new_total_limit\" min=\"0\" /></td>
							</tr>
							<tr>
								<td>等級：</td>
								<td>
									<select name=\"new_level\">
										<option value=\"{$userinfo["level"]}\">{$userinfo["level"]}</option>
										<option value=\"$another_level\">$another_level</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>刪除用戶：</td>
								<td><input type=\"radio\" name=\"del_user\" value=\"del_user\" />移除 &nbsp <input type=\"radio\" name=\"del_user\" value=\"no_del_user\" />不移除 </td>
							</tr>
							";
						}else{
							echo '<script type="text/javascript">alert("指定的帳號不存在，將自動轉回前頁");history.go(-1)</script>';

						}
						
					?>
					<tr><td colspan="2" align="center"><input id="submit" type="submit" value="送出" /></td><td></td></tr>
					</table>
				</form>
			</div>
			
		</div>
	</div>
	
</body>
</html>