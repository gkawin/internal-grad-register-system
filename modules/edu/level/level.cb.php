<?php
$currenttemplate = 'level.html';
$titleMsg = "การจัดการระดับปริญญา";
$page['view'] = "main";
$page['user'] = $_SESSION;
$sub = (isset($segment[2])|| $segment[2]!="form")? " >> ".$segment[2] : null;
$part = (isset($segment[2]))? "/".$segment[0]."/".$segment[1]."/".$segment[2] : "/".$segment[0]."/".$segment[1];
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] = mysql_escape_string(json_encode(
	array(	"ip"=>$_SERVER['REMOTE_ADDR'],
			"modules"=>$segment[1].$sub,
			"path"=>$part,
			"data"=>$_POST)));
$page['editor']['whoaction'] = $_SESSION['nameTH'];
$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','degree level')");
$query['_level'] = "SELECT * FROM degree_level";
$rs['sel'] = $db->Execute($query['_level']);
while(!$rs['sel']->EOF){
	$page['_level'][] = $rs['sel']->fields;
	$rs['sel']->MoveNext();
}

if(isset($segment[2])){
	$page['view'] = "form";
	switch ($segment[2]){
		case "new":
		$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				$aExplode = explode(" | ",$_POST['degree_level_type']);
				unset($_POST['operation']);
				unset($_POST['degree_level_type']);
				$_POST['type'] = $aExplode[0];
				$_POST['typeEN'] = $aExplode[1];
				$rs['ins'] = $db->Execute($sql->add_db("degree_level",$_POST));
				if($rs['ins']){
					$res['callback']['result'] = "ทำรายการสำเร็จ";
					$page['editor']['result'] = "OK";
				}else{
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
		break;
		case "edit":
		$page['editor']['action'] = "EDIT";
			if(!empty($_POST['operation'])){
				$aExplode = explode(" | ",$_POST['degree_level_type']);
				unset($_POST['operation']);
				unset($_POST['degree_level_type']);
				$_POST['type'] = $aExplode[0];
				$_POST['typeEN'] = $aExplode[1];
				$rs['upd'] = $db->Execute($sql->update_db("degree_level",$_POST," id = ".$_GET['id']));
				if($rs['upd']){
					$res['callback']['result'] = "ทำรายการสำเร็จ";
					$page['editor']['result'] = "OK";
				}else{
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
			$query['_level'] .= " WHERE id = ".$_GET['id'];
			$page['edit'] = $db->Execute($query['_level'])->fields;
		break;
		case "del":
			$page['editor']['action'] = "DELETE";
			$res['callback']['result'] = $db->Execute($sql->del("degree_level","id = ".$_POST['target']));
			echo json_encode($res['callback']);
			$db->Execute($sql->add_db("system_log",$page['editor']));
			exit();
		break;
		default: $currenttemplate = "error404.html";
	}
}

?>