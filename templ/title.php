<?php 
	$title=isset($_SESSION["setting"]['site_name'])?$_SESSION["setting"]['site_name']:"簡訊發送系統";
	for($i=0;$i<strlen($title);$i++){
		@$new_title.=mb_substr($title,$i,1,"utf8") . "<br/>";
		
	}
	echo "<p>$new_title</p>";
	
?>