<?php
$currenttemplate = 'group.html';
$titleMsg = "Employee Group Management";
$page['user'] = $_SESSION;
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] = "{ 'url' :".$_SERVER[HTTP_HOST].$_SERVER['REQUEST_URI'].",".
							"'modules' : ".$segment[1].",".
							"'data' : ";
							while($element = each($_POST)){
								$page['editor']['detail'] .= $element["key"]."=>".$element["value"].",";
							}
							$page['editor']['detail'] .= "}";
$page['editor']['whoaction'] = $_SESSION['nameTH'];
$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','group')");
$query['all'] = "SELECT * FROM employee_group_name";
$rs['all'] = $db->Execute($query['all']);
while(!$rs['all']->EOF){
	$page['all'][] = $rs['all']->fields;
	$rs['all']->MoveNext();
}
if($_POST['changeData']){
	$rs['upd'] = $db->Execute($sql->update_db("employee_group_name",array($_POST['target']=>$_POST['data']),"group_id = ".$_POST['updateid']));
	$res['callback']['result'] = $rs['upd']->EOF; 
	echo json_encode($res['callback']);
	exit();

}
if($_POST['savegroup']){
	$_POST['teachable'] = isset($_POST['teachable']) ?  1 : 0;
	$_POST['advisor'] =isset($_POST['advisor']) ? 1 : 0;
	$_POST['graduate_officer'] = isset($_POST['graduate_officer']) ? 1 : 0;
	$aEmployeemember = explode(",",$_POST['employee_member']);
	unset($_POST['savegroup']);
	unset($_POST['employee_member']);
	$rs['ins'] = $db->Execute($sql->add_db("employee_group_name",$_POST));
	$iLastID = intval($db->Insert_ID());
	if($rs['ins']->EOF){
		foreach($aEmployeemember as $item){
			$rs['ins'] = $db->Execute($sql->add_db("employee_group_member",array(
			"employee_id"=>$item,
			"group_id"=>$iLastID)));
		}
		$res['callback']['result'] = $rs['ins']->EOF;
	}
	echo json_encode($res['callback']['result']); 
	exit();
}
if(!empty($_POST['del'])){
	$res['callback']['result'] = $db->Execute($sql->del("employee_group_name"," group_id =".$_POST['del']))->EOF;
	echo json_encode($res['callback']);
	exit();
}

?>