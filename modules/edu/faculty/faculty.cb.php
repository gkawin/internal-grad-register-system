<?php
$currenttemplate = "faculty.html";
$titleMsg ="Faculty Management";
$page['view'] = "list";
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
				'".date("Y-m-d")." ".date("H:i:s")."','faculty and major')");
$page['_get'] = $_GET;
$query['all'] = "SELECT *,IF(faculty.status=1,'เปิดใช้งาน',IF(faculty.status=2,'รอการอนุมัติ','ยกเลิกการใช้งาน')) AS status1 FROM faculty ";
$sBinquery = ($segment[3]!="edit") ? "ORDER BY major.major_id ASC" : "";
$query['_major'] = sprintf("SELECT
IF(major.status=1,'เปิดใช้งาน',IF(major.status=2,'รอการอนุมัติ','ยกเลิกการใช้งาน')) AS status1,
major.major_id,
major.major_name,
major.major_nameEN,
major.website,
major.`status`,
major.fac_id,
prefix_course.prefix_name,
prefix_course.prefix_nameEN
FROM
major
INNER JOIN prefix_course ON prefix_course.major_id = major.major_id %s",$sBinquery);
$query['all'] .= !isset($_POST['chkAvaliable']) ? " WHERE fac_id <> 99" : null;

$key = array_keys($query);
for($i=0;$i<count($query);$i++){
	$rs[$i] = $db->Execute($query[$key[$i]]);
	while(!$rs[$i]->EOF){
		$page[$key[$i]][]=$rs[$i]->fields;
		$rs[$i]->MoveNext();
	}
}
if($segment[2] === "form"){
	$page['view'] = "form";
	switch ($segment[3]){
		case "new":
			$titleMsg = "Faculty  Management | AddNew";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				
				$rs['ins'] = $db->Execute($sql->add_db("faculty",$_POST));
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
			$titleMsg = "Faculty  Management | Editing";
			$page['editor']['action'] = "EDIT";
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				$rs['upd'] = $db->Execute($sql->update_db("faculty",$_POST,"fac_id = ".$_GET['id']));
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
			$query['all'] .= " WHERE faculty.fac_id = '".$_GET['id']."'";
			$rs['sel'] = $db->Execute($query['all']);
			$page['edit'] = $rs['sel']->fields;
		break;
		default : $currenttemplate = "error404.html";
	}
}elseif($segment[2] === "major"){
	$page['view'] = "major";
	switch ($segment[3]){
		case "new" :
			$titleMsg = "Major Management | AddNew";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				$_POST['major_id'] .= $_POST['major_id1']; 
				$aPostprefix['prefix_name'] = $_POST['prefix_name'];
				$aPostprefix['prefix_nameEN'] = $_POST['prefix_nameEN'];
				$aPostprefix['major_id'] = $_POST['major_id'];
				
				unset($_POST['major_id1']);
				unset($_POST['operation']);
				unset($_POST['prefix_name']);
				unset($_POST['prefix_nameEN']);
				$rs['ins'] = $db->Execute($sql->add_db("major",$_POST));
				if($rs['ins']){
					$rs['ins'] = $db->Execute($sql->add_db("prefix_course",$aPostprefix));
					if($rs['ins']){
						$res['callback']['result'] = "ทำรายการสำเร็จ";
						$page['editor']['result'] = "OK";
					}else{
						$res['callback']['result'] = "ทำรายการล้มเหลว";
						$page['editor']['result'] = "FAIL";
						$page['editor']['err_reason'] = $db->ErrorMsg();
					}
				}else{
					$res['callback']['result'] = "ทำรายการล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$_POST = array_merge($_POST,$aPostprefix);
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
		break;
		case "edit" :
			$titleMsg = "Major Management | Editing";
			$page['editor']['action'] = "EDIT";
			if(!empty($_POST['operation'])){
				$aPostprefix['prefix_name'] = $_POST['prefix_name'];
				$aPostprefix['prefix_nameEN'] = $_POST['prefix_nameEN'];
				$aPostprefix['major_id'] = $_POST['major_id'];
				unset($_POST['operation']);
				unset($_POST['prefix_name']);
				unset($_POST['prefix_nameEN']);
				$rs['upd'] = $db->Execute($sql->update_db("major",$_POST,"major_id = '".$_GET['id']."'"));
				if($rs['upd']){
					$rs['upd'] = $db->Execute($sql->update_db("prefix_course",$aPostprefix,"WHERE major_id ='".$_GET['id']."'"));
					if(!$rs['upd']){
						$res['callback']['result'] = "ทำรายการสำเร็จ";
						$page['editor']['result'] = "OK";
					}else{
						$res['callback']['result'] = "ทำรายการล้มเหลว";
						$page['editor']['result'] = "FAIL";
						$page['editor']['err_reason'] = $db->ErrorMsg();
					}
				}else{
					$res['callback']['result'] = "ทำรายการล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$_POST = array_merge($_POST,$aPostprefix);
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
			
			$query['_major'] .= " WHERE major.major_id = '".$_GET['id']."'";
			$row['edit'] = $db->Execute($query['_major'])->fields;
		break;
		case "chk":
			switch($_POST['chktype']){
				case "major_id":
					$query['sel'] = "SELECT major_id FROM major WHERE major_id = '".$_POST['data']."'";
				break;
				case "prefix_name":
					$query['sel'] = "SELECT prefix_name FROM prefix_course WHERE prefix_name = '".$_POST['data']."'";
				break;
				case "prefix_nameEN":
					$query['sel'] = "SELECT prefix_nameEN FROM prefix_course WHERE prefix_nameEN = '".$_POST['data']."'";
				break;
			}
				$rs['sel'] = $db->Execute($query['sel']);
				if($rs['sel']->EOF){
					$res['callback']['result'] = 1;
				}else{
					$res['callback']['result'] = 0;
				}
				echo json_encode($res['callback']);
			exit();
		break;
		case "del":
		$page['editor']['action'] = "DELETE";
			$res['callback']['result'] =$db->Execute($sql->del("major","major_id = '".$_POST['del']."'"))->EOF;
			if($res['callback']['result']){
				$page['editor']['result'] = "OK";
			}else{
				$page['editor']['result'] = "FAIL";
				$page['editor']['err_reason'] = $db->ErrorMsg();
			}
			$db->Execute($sql->add_db("system_log",$page['editor']));
			echo json_encode($res['callback']);
			exit();
		break;
		default:
			$currenttemplate = "error404.html";
		break;
	}
	
}
if(!empty($_POST['del'])){
	$page['editor']['action'] = "DELETE";
	$res['callback']['result'] = $db->Execute($sql->del("faculty","fac_id = ".$_POST['del']))->EOF;
	if($res['callback']['result']){
				$page['editor']['result'] = "OK";
			}else{
				$page['editor']['result'] = "FAIL";
				$page['editor']['err_reason'] = $db->ErrorMsg();
			}
			$db->Execute($sql->add_db("system_log",$page['editor']));
	echo json_encode($res['callback']);

	exit();
}

if(!empty($_POST['chkAvaliable'])){
	$query['all'] .= " WHERE fac_name = '".$_POST['chkAvaliable']."' ";
	$rs['sel'] = $db->Execute($query['all']);
	
	if($rs['sel']->EOF){
		echo "OK";
	}else{
		echo '<font color="red">ไม่สามารถใช้ชื่อ <STRONG>'.$_POST['chkAvaliable'].'</STRONG> นี้ได้</font>';
	}
	
	exit();
}
?>
