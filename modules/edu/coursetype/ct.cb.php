<?php
$currenttemplate = 'coursetype.html';
$titleMsg = "Course Type Management";
$page['view'] = "list";
$page['user'] = $_SESSION;
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] = mysql_real_escape_string(json_encode(
	array(	"ip"=>$_SERVER['REMOTE_ADDR'],
			"modules"=>"coursetype",
			"path"=>"/edu/coursetype",
			"data"=>$_POST)));
$page['editor']['whoaction'] = $_SESSION['nameTH'];
$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','coursetype')");
$query = "SELECT *,IF(status=1,'เปิดใช้งาน',IF(status=2,'รอการอนุมัติ','ยกเลิกการใช้งาน')) AS status1 FROM course_type";
$rs = $db->Execute($query);
while(!$rs->EOF){
	$page['all'][]=$rs->fields;
	$rs->MoveNext();
}
if($segment[2] == "form"){
	$page['view'] = "form";
	if(empty($_GET['editid'])){
		$titleMsg = "Course Type Management | AddNew";
		$page['editor']['action'] = "ADD";
		if(!empty($_POST['operation'])){
			unset($_POST['operation']);
			$query = $sql->add_db("course_type",$_POST);
			$rs = $db->Execute($query);
			if($rs){
				$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
				$page['editor']['result'] = "OK";
			}else{
				$res['callback']['result'] = "ล้มเหลว";
				$page['editor']['result'] = "FAIL";
				$page['editor']['err_reason'] = $db->ErrorMsg();
			}
			$db->Execute($sql->add_db("system_log",$page['editor']));
		}
	}
	else
	{
		$titleMsg = "Course Type Management | Editing";
		$page['editor']['action'] = "EDIT";
		if(!empty($_POST['operation'])){
			unset($_POST['operation']);
			$rs = $db->Execute($sql->update_db("course_type",$_POST,"id = ".$_GET['editid']));
			if($rs){
				$res['callback']['result'] = "ทำรายการแก้ไขสำเร็จ";
				$page['editor']['result'] = "OK";
			}else{
				$res['callback']['result'] = "ล้มเหลว";
				$page['editor']['result'] = "FAIl";
				$page['editor']['err_reason'] = $db->ErrorMsg();
			}
			$db->Execute($sql->add_db("system_log",$page['editor']));
		}
	
		$query .= " WHERE id = ".$_GET['editid'];
		$rs = $db->Execute($query);
		while(!$rs->EOF){
			$row=$rs->fields;
			$rs->MoveNext();
		}

	}
}
if(!empty($_POST['del_id'])){
	$page['editor']['action'] = "DELETE";
	$query = $sql->del("course_type","id =". $_POST['del_id']);
		$rs=$db->Execute($query);
		if($rs){
			$res['result'] = 1;
			$page['editor']['result'] = "OK";
		}else{
			$res['result'] = 0;
			$page['editor']['result'] = "FAIL";
			$page['editor']['err_reason'] = $db->ErrorMsg();
		}
		$db->Execute($sql->add_db("system_log",$page['editor']));
		echo json_encode($res);
		exit();
}
if(!empty($_POST['chkAvaliable'])){
	$query .= " WHERE course_type_nameTH = '".$_POST['chkAvaliable']."'";
	$rs = $db->Execute($query);
	if($rs->EOF){
		echo "OK";
	}else{
		echo '<font color="red">ไม่สามารถใช้ชื่อ <STRONG>'.$_POST['chkAvaliable'].'</STRONG> นี้ได้</font>';
	}
	exit();
}
?>