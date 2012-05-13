<?php 
	$title=isset($_SESSION["site-title"])?$_SESSION["site-title"]:"簡訊發送系統";
	for($i=0;$i<strlen($title);$i++){
		@$new_title.=mb_substr($title,$i,1,"utf8") . "<br/>";
		
	}
	echo "<p>$new_title</p>";
	
?>