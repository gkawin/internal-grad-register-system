<?php

$currenttemplate = 'building.html';
$titleMsg = "Building Management";
$page['view'] = "list";
$page['user'] = $_SESSION;
$sub = (isset($segment[2])&& $segment[2]!="form")? " >> ".$segment[2] : null;
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
				'".date("Y-m-d")." ".date("H:i:s")."','building')");
$query['all'] = "SELECT *,IF(status=1,'เปิดใช้งาน',IF(status=2,'รอการอนุมัติ','ยกเลิกการใช้งาน')) AS status1 FROM building";
$rs['sel'] = $db->Execute($query['all']);
while(!$rs['sel']->EOF){
	$page['all'][]=$rs['sel']->fields;
	$rs['sel']->MoveNext();
}

if($segment[2] == "form"){
	$page['view'] = "form";
	switch($segment[3]){
		case "new":
			$titleMsg = "Building Management | AddNew";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				$rs['ins'] = $db->Execute($sql->add_db("building",$_POST));
				if($rs['ins']){
					$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
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
			$titleMsg = "Building Management | Editing";
			$page['editor']['action'] = "EDIT";
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				$rs['upd'] = $db->Execute($sql->update_db("building",$_POST,"building_id = ".$_GET['id']));
				if($rs['upd']){
					$res['callback']['result'] = "ทำรายการแก้ไขสำเร็จ";
					$page['editor']['result'] = "OK";
				}else{
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
			$query['all'] .= " WHERE building_id = '".$_GET['id']."'";
			$row = $db->Execute($query['all'])->fields;
		break;
		default : $currenttemplate = "error404.html";
	}
}
if(!empty($_POST['del'])){
	$page['editor']['action'] = "DELETE";
		$rs['del']=$db->Execute($sql->del("building","building_id = ". $_POST['del']));
		if($rs['del']->EOF){
			$res['callback']['result'] = 1;
			$page['editor']['result'] = "OK";
		}else{
			$res['callback']['result'] = 0;
			$page['editor']['result'] = "FAIL";
			$page['editor']['err_reason'] = $db->ErrorMsg();
		}
		$db->Execute($sql->add_db("system_log",$page['editor']));
		echo json_encode($res['callback']);
		exit();
}
if(!empty($_POST['chkAvaliable'])){
	$query['all'] .= " WHERE building_id = '".$_POST['chkAvaliable']."'";
	$rs['sel'] = $db->Execute($query['all']);
	if($rs['sel']->EOF){
		echo "OK";
	}else{
		echo '<font color="red">ไม่สามารถใช้ชื่อ <STRONG>'.$_POST['chkAvaliable'].'</STRONG> นี้ได้</font>';
	}
	exit();
}
?>