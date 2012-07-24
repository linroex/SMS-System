<?php include("templ/init.php");$_SESSION["page-title"]="發送簡訊";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");?>
	<?php include('module/sql.php')?>
	<script type="text/javascript">
	    function Calculation(str) {
	       
	        String.prototype.Blength = function() {
	            var arr = this.match(/[^\x00-\xff]/ig);
	            return arr == null ? this.length : this.length + arr.length;
	        }
	        var span = document.getElementById("txtCount");
	        span.innerHTML = str.value.length;
	        //字元數就是有幾個字，byte數就是洋文算1中文算2的總和
	    }
	</script> 
	<?php 
		echo return_message('send_status');
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
			<div class="title">發送簡訊</div>
			
			<form id="sendsms" action="module/sendsms.php" method="post">
				<table>
						<tr>
							<td>收件者：</td>
							<td><textarea name="phone" cols="30" rows="4"></textarea></td>
						</tr>
						<tr>
							<td>聯絡人：</td>
							<td>
								<div style="max-height:150px;overflow:auto;">
									<?php 
										foreach($contact->find(array('pertain'=>$_SESSION["user-info"]['usernm'])) as $temp){
											echo "<input type=\"checkbox\" name=\"contact[]\" value=\"{$temp["phone"]}\" />",$temp["name"],"&nbsp&nbsp&nbsp&nbsp";
										}	
									?>
								</div>
							</td>
						</tr>
						
						
						<tr>
							<td>內容：</td>
							<td><textarea name="content" cols="30" rows="10" onkeyup="Calculation(this);" required></textarea><br/>已輸入：<span id="txtCount">0</span>字(有誤差)</td>
						</tr>
						
												
						<tr>
							<td>群組：</td>
							<td>
								<div style="max-height:150px;overflow:auto;">
								<?php 
									foreach($group->find(array('pertain'=>$_SESSION["user-info"]['usernm'])) as $temp){
										echo "<input type=\"checkbox\" name=\"group[]\" value=\"{$temp["group_name"]}\" />",$temp["group_name"],"&nbsp&nbsp&nbsp&nbsp";
									}	
								?>
								</div>
							</td>
						</tr>
				</table>
				<input type="hidden" name="check" value="<?php srand(time());$_SESSION['check']=rand(10000000,99999999); echo $_SESSION['check'] ?>"/>
				<center><input type="submit" value="發送" id="submit"/></td></center>
			</form>
		</div>
	</div>
	
</body>
</html>