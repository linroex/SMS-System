<?php include("templ/init.php");$_SESSION["page-title"]="發送簡訊";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	<?php include('module/sql.php')?>
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
			<div class="title">發送簡訊</div>
			<form id="sendsms" action="module/sendsms.php" method="post">
				<table>
						<tr>
							<td>收件者：</td>
							<td><textarea name="phone" cols="35" rows="4"></textarea></td>
						</tr>
						<tr>
							<td>群組發送：</td>
							<td>
								<?php 
									foreach($group->find(array('pertain'=>array('$in'=>array('all',$_SESSION["user-info"]['usernm'])))) as $temp){
										echo "<input type=\"checkbox\" name=\"group[]\" value=\"{$temp["group_name"]}\" />",$temp["group_name"],"&nbsp&nbsp&nbsp&nbsp";
									}	
								?>
							</td>
						</tr>
						
						<tr>
							<td>內容：</td>
							<td><textarea name="content" cols="35" rows="10" required></textarea></td>
						</tr>
				</table>
				<center><input type="submit" value="發送" id="submit"/></td></center>
			</form>
		</div>
	</div>
	<?php 
		if(isset($_SESSION['send_status'])){
			echo '<script type="text/javascript">alert("'. $_SESSION['send_status'] .'")</script>';
			unset($_SESSION['send_status']);
		}
	?>	
</body>
</html>