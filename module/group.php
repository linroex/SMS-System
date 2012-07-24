<?php 
	include("../templ/init.php");
	include("sql.php");	
	
	
	if($_POST['CHECK']==$_SESSION['CHECK']){
		unset($_SESSION['CHECK']);
		if($_POST['del_group']=='true'){
			$group->remove(array('group_name'=>$_POST['group_name']));
			$_SESSION['edit_group_message']='移除成功';
		}else{
			if(!isset($_POST['group_member'])){
				$_POST['group_member']=array();
			}
			
			if(isset($_POST)){
				if(isset($_POST['group_name'])){
					$group->update(array('group_name'=>$_POST['group_name']),array('$set'=>array('group_name'=>$_POST['group_name'],'group_note'=>$_POST['group_note'],"pertain"=>$_SESSION["user-info"]['usernm'])),true);		//增加群組
					if(count($_POST['group_member'])>=$_SESSION['checked_count']){		//判斷是增加所屬群組還是減少所屬群組
						
						//如果增加群組，就直接把新的群組加到用戶資料上
						foreach($_POST['group_member'] as $temp){
							$temp_contact_info=$contact->findOne(array('name'=>$temp));
							$contact_group=(is_array($temp_contact_info['group'])?implode(',',$temp_contact_info['group']):$temp_contact_info['group']) . ',' . $_POST['group_name'];
							unset($temp_contact_info);	
							$contact->update(array('name'=>$temp),array('$set'=>array('group'=>explode(',',$contact_group),"pertain"=>$_SESSION["user-info"]['usernm'])));
							
							
						}
						$_SESSION['edit_group_message']='新增/編輯成功';
					}else{
						
						//如果是減少群組，則要檢查是哪個用戶要檢查群組，然後再去修改
						foreach($contact->find() as $temp){
							if(!in_array($temp['name'],$_POST['group_member'])){
								
								$new_contact_group=explode(',',str_replace($_POST['group_name'],'',is_array($temp['group'])?implode(',',$temp['group']):$temp['group']));
								
								//將$new_contact_group排序，並且移除空白的部份
								sort($new_contact_group);
								for($i=count($new_contact_group)-1;$i>=0;$i--){
									if($new_contact_group[$i]==''){
										unset($new_contact_group[$i]);
									}
								}
								$contact->update(array('name'=>$temp['name']),array('$set'=>array('group'=>$new_contact_group)));
							}
							$_SESSION['edit_group_message']='新增/編輯成功';
						}
					}
				}
			}
		}
	}else{
		$_SESSION['edit_group_message']='檢核碼錯誤，請勿嘗試攻擊本系統';
	}
	header("Location:../group.php");
?>