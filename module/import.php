<?php 
	
	include('sql.php');
	include("../templ/init.php");
	
	$content=trim(iconv("ucs-2","utf8",file_get_contents('/home/linroex/下載/google.csv')));
	$content=explode("\n",$content);
	unset($content[0]);
	foreach($content as $t){
		$t=explode(",",$t);
		$contact->insert(array('name'=>$t[0],'email'=>$t[28],'phone'=>str_replace("-",'',$t[35]),'notice'=>$t[25],'pertain'=>$_SESSION["user-info"]['usernm'],'nickname'=>'','group'=>''));
	}

?>