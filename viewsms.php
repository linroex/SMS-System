<?php include("templ/init.php");$_SESSION["page-title"]="簡訊系統";?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_SESSION["setting"]['site_name']," | ",@$_SESSION["page-title"]; ?></title>
	<?php include("templ/head.php");include('module/sql.php');?>
	<?php 
		if((!isset($_GET['limit']) or ($_GET['limit']==NULL))){
			$_GET['limit']=10;
		}
		if((!isset($_GET['page']) or ($_GET['page']==NULL))){
			$_GET['page']=1;
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
			<div class="title">歷史紀錄</div>
			<form action="" method="get">
				<center><p>筆數：<input type="text" name="limit" style="width:30px;" value="<?=isset($_GET['limit'])?$_GET['limit']:'10'; ?>"/>&nbsp&nbsp
				頁數：
				<select name="page" >
					<?php 
						
						for($i=1;$i<=ceil($history->count()/$_GET['limit']);$i++){
							if($i==$_GET['page']){
								echo "<option value=\"$i\" selected=\"selected\">$i</option>";
							}else{
								echo "<option value=\"$i\">$i</option>";
							}
						}
					?>
				</select>
				
				<input type="submit" value="送出" /></p></center>
				
			</form>
			<div id="viewsms">
				<table cellpadding=1>
					<tr>
						<td>時間</td>
						<td>內容</td>
						<td>發送到</td>
						<td>花費</td>
						<td>字數</td>
					</tr>
					
					<?php 
					
						$skip=$_GET['limit']*($_GET['page']-1);
						$info_history="";
						if($_SESSION["user-info"]['level']=='admin'){
							$info_history=$history->find()->skip($skip)->limit($_GET['limit'])->sort(array('_id'=>-1));							
						}else{
							$info_history=$history->find(array('pertain'=>$_SESSION["user-info"]['usernm']))->skip($skip)->limit($_GET['limit'])->sort(array('_id'=>-1));
						}
						foreach ($info_history as $temp){
							echo '<tr>';
							echo "<td>{$temp['time']}</td>
							<td><div style=\"width:350px;max-height:80px;overflow:auto;\">{$temp['content']}</div></td>
							<td><div style=\"width:100px;max-height:50px;overflow:auto;\">" . str_replace(',','<br />',$temp['to']) . "</div></td>
							<td>{$temp['cost']} point</td>
							<td>" . mb_strlen($temp['content'],'UTF8') . "字</td>";
							echo '</tr>';
						} 
						
					?>
				</table>
			</div>
		</div>
	</div>
	
</body>
</html>