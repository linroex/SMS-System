<?php 
	
	include('sql.php');
	include("../templ/init.php");
	var_dump($_FILES);
	if(strstr($_FILES['import']['name'],'.csv')){
		$content=trim(iconv("ucs-2","utf8",file_get_contents($_FILES['import']['tmp_name'])));
		$content=explode("\n",$content);
		unset($content[0]);
		foreach($content as $t){
			$t=explode(",",$t);
			$contact->insert(array('name'=>$t[0],'email'=>$t[28],'phone'=>str_replace("-",'',$t[35]),'notice'=>$t[25],'pertain'=>$_SESSION["user-info"]['usernm'],'nickname'=>'','group'=>''));
		}
		unlink($_FILES['upload']['tmp_name']);
		$_SESSION['import_status']='匯入成功';
	}else{
		$_SESSION['import_status']='匯入功能限定上傳Google CSV格式';
	}
	header('Location: ../view_contact.php');

?>