<?php

$sub = (isset($segment[2])|| $segment[2]!="form")? " >> ".$segment[2] : null;
$part = (isset($segment[2]))? "/".$segment[0]."/".$segment[1]."/".$segment[2] : "/".$segment[0]."/".$segment[1];
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] = mysql_escape_string(json_encode(
	array(	"ip"=>$_SERVER['REMOTE_ADDR'],
			"modules"=>$segment[1].$sub,
			"path"=>$part,
			"data"=>$_POST)));
$page['editor']['whoaction'] = empty($_SESSION['nameTH'])? "ADMIN NOT ACTIVE" : $_SESSION['nameTH'];
if(isset($segment[2])){
	$query['_emp'] = "SELECT
	CONCAT(employee.titlename,employee.firstname,' ',employee.lastname) AS EMP_NAME,
	employee.id,
	employee_group_name.graduate_officer
	FROM
	employee
	INNER JOIN employee_group_member ON employee.id = employee_group_member.employee_id
	INNER JOIN employee_group_name ON employee_group_member.group_id = employee_group_name.group_id
	 WHERE employee_group_name.graduate_officer = 1";
	$query['_acc'] = "SELECT 
	CONCAT(employee.titlename,employee.firstname,' ',employee.lastname) AS EMP_NAME,
	account.id,
	account.username,
	account.`status`,
	IF(account.sec_work=1,'เจ้าหน้าที่ฝ่ายภาระการศึกษา',IF(account.sec_work=2,'เจ้าหน้าที่ฝ่ายตรวจสอบ','ผู้ดูแลระบบ')) AS sec_work	 FROM
	account
	INNER JOIN employee ON account.employee_id = employee.id";
	$key = array_keys($query);
	for($i=0;$i<count($query);$i++){
		$rs[$i] = $db->Execute($query[$key[$i]]);
		while(!$rs[$i]->EOF){
			$row[$key[$i]][]=$rs[$i]->fields;
			$rs[$i]->MoveNext();
		}
	}
	switch($segment[2]){
		case "add":
			$page['view'] = "userAdd";
			if(!empty($_POST['opration'])){
				parse_str($_POST['opration'], $asPOST);
				$asPOST['pwd'] = sha1($asPOST['pwd']);
				$rs['ins']= $db->Execute($sql->add_db("account",$asPOST));
				if($rs['ins']){
					$res['callback']['result'] = true;
				}else{
					$res['callback']['result'] = false;
					$res['callback']['reason'] = $db->ErrorMsg();
				}
				echo json_encode($res['callback']);
				exit();
			}
		break;
		case "view":
			$page['view'] = "viewUser";
			if(!empty($_POST['operation'])){
				$rs['upd'] = $db->Execute($sql->update("account","status = ".$_POST['value'],"id = ".$_POST['acc_id']));
				if($rs['upd']->EOF){
					$res['callback']['result'] = true;
				}else{
					$res['callback']['result'] = false;
				}
				echo json_encode($res['callback']);
				exit();
			}
		break;
		case "emp":
			$insertAcc = array();
			$page['view'] = "emp";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				
				$insertAcc['username'] = $_POST['username'];
				$insertAcc['pwd'] = sha1($_POST['pwd']);
				$insertAcc['sec_work'] = $_POST['sec_work'];
				$insertAcc['status'] = 1;
				unset($_POST['username'],$_POST['pwd'],$_POST['sec_work'],$_POST['operation']);
				
				$aBin = explode("|",$_POST['religion']);
				$_POST['religion'] = $aBin[0];
				$_POST['religionEN'] = $aBin[1];
				$_POST['under_major_id'] = 99;
				if(move_uploaded_file($_FILES['uploadPic']['tmp_name'],ROOT_DIR."/common/images/employee_pics/".$_FILES['uploadPic']['name'])){
					$res['piccallback']['result'] = "สำเร็จ";
					$_POST['pic_path'] = $_FILES['uploadPic']['name'];
				};
				$rs['ins'] = $db->Execute($sql->add_db("employee",$_POST));
				$insertAcc['employee_id'] = $db->Insert_ID();
				if($rs['ins']){
					$rs['ins'] = $db->Execute($sql->add_db("account",$insertAcc));
					if($rs['ins']){
						$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
						$page['editor']['result'] = "OK";
						$row['statuspermis'] = true;
					}else{
						$res['callback']['result'] = "ล้มเหลวการเพิ่มบัญชีผู้ใช้งาน";
						$page['editor']['result'] = "FAIL";
						return false;
					}
				}else{
					$res['callback']['result'] = $sql->add_db("employee",$_POST);
					$page['editor']['result'] = "FAIL";
					return false;
				}
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
		break;
		case "del":
			$res['callback']['result'] = $db->Execute($sql->del("account","id = ".$_POST['accid']))->EOF;
			echo json_encode($res['callback']);
			exit();
		break;
		case "chk":
			if($_POST['accChk']){
				$query['_chk'] = "SELECT username FROM account WHERE username ='".$_POST['data']."' LIMIT 0,1";
			}
			$res['callback']['result'] = $db->Execute($query['_chk'])->EOF;
			echo json_encode($res['callback']);
			exit();
		break;
		default: $currenttemplate = "error404.html";
	}
	
}
?>