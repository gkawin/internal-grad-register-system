<?php
$currenttemplate = "employee.html";
$titleMsg ="Employee Management";
$page['view'] = "list";
$sub = (isset($segment[2])|| $segment[2]!="form")? " >> ".$segment[2] : null;
$part = (isset($segment[2]))? "/".$segment[0]."/".$segment[1]."/".$segment[2] : "/".$segment[0]."/".$segment[1];
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] = mysql_escape_string(json_encode(
	array(	"ip"=>$_SERVER['REMOTE_ADDR'],
			"modules"=>$segment[1].$sub,
			"path"=>$part,
			"data"=>$_POST)));
$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','employee')");
$query['all'] = "SELECT
faculty.fac_name,
major.major_name,
major.major_nameEN,
faculty.fac_nameEN,
employee.id,
employee.titlename,
employee.firstname,
employee.lastname,
employee.titlenameEN,
employee.firstnameEN,
employee.lastnameEN,
employee.nation_id,
employee.admin_position,
employee.admin_positionEN,
employee.gender,
employee.`position`,
employee.positionEN,
employee.hire_date,
employee.birthday,
employee.religion,
employee.religionEN,
employee.blood_group,
employee.address,
employee.addressEN,
employee.amphur,
employee.amphurEN,
employee.province,
employee.provinceEN,
employee.mobile,
employee.behavior_degree,
employee.master_degree,
employee.phd_degree,
employee.pic_path,
employee.status,
employee.under_major_id,
major.major_id,
employee.behavior_degreeEN,
employee.master_degreeEN,
employee.phd_degreeEN,
IF(employee.status=1,
	'รับราชการ',
IF(employee.status=2,
	'ลาศึกษาต่อ',
IF(employee.status=3,
	'ลาออก','ถูกไล่ออก'))) AS status1
FROM
employee
Inner Join major ON employee.under_major_id = major.major_id
Inner Join faculty ON faculty.fac_id = major.fac_id
";
$query['_major'] = "SELECT
major.major_id,
major.major_name,
faculty.fac_name
FROM
faculty
INNER JOIN major ON major.fac_id = faculty.fac_id
WHERE major.major_id <> 999 AND major.status <> 0";
$query['group'] = "SELECT * FROM employee_group_name WHERE status <> 0";
$query['_empGroup'] = "SELECT
employee_group_member.employee_id,
employee_group_member.group_id,
employee_group_name.group_name
FROM
employee
Inner Join employee_group_member ON employee.id = employee_group_member.employee_id
Inner Join employee_group_name ON employee_group_member.group_id = employee_group_name.group_id
";

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
			$titleMsg = "Employee Management | AddNew";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				$aBin = explode("|",$_POST['religion']);
				$_POST['religion'] = $aBin[0];
				$_POST['religionEN'] = $aBin[1];
				if(move_uploaded_file($_FILES['uploadPic']['tmp_name'],ROOT_DIR."/common/images/employee_pics/".$_FILES['uploadPic']['name'])){
					$res['piccallback']['result'] = "สำเร็จ";
					$_POST['pic_path'] = $_FILES['uploadPic']['name'];
				};
				$rs['ins'] = $db->Execute($sql->add_db("employee",$_POST));
				$res['insID'] = $db->Insert_ID();
				if($rs['ins']){
					$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
					$page['editor']['result'] = "OK";
					$row['statuspermis'] = true;
				}else{
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
		break;
		case "edit":
			$titleMsg = "Employee Management | Editing";
			
			if(!empty($_POST['operation'])){
				$aBin = explode("|",$_POST['religion']);
				$_POST['religion'] = $aBin[0];
				$_POST['religionEN'] = $aBin[1];
				if(move_uploaded_file($_FILES['uploadPic']['tmp_name'],ROOT_DIR."/common/images/employee_pics/".$_FILES['uploadPic']['name'])){
					$res['piccallback']['result'] = "สำเร็จ";
					$_POST['pic_path'] = $_FILES['uploadPic']['name'];
				};
				unset($_POST['operation']);				
				$rs['upd'] = $db->Execute($sql->update_db("employee",$_POST,"id = ".$_GET['id']));
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
			$page['editor']['action'] = "EDIT";
			$page['getid'] = $_GET['empid'];
			$query['all'].= " WHERE id = ".$_GET['id'];
			$rs['sel'] = $db->Execute($query['all']);
			$page['edit'] = $rs['sel']->fields;
		break;
		default : $currenttemplate = "error404.html";
	}
}elseif($segment[2] === "permission"){
	$page['view'] = "permission";
	$query['all'].= " WHERE id = ".$_GET['empid'];
	$rs['sel'] = $db->Execute($query['all']);
	$page['empdat'] = $rs['sel']->fields;
	
	switch ($segment[3]){
		case "new":
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				$rs['ins'] = $db->Execute($sql->add_db("employee_group_member",$_POST));
				if($rs['ins'])
					$res['callback']['result'] = "ทำรายการสำเร็จ";
				else
					$res['callback']['result'] = "ล้มเหลว";
			}
		break;
	}
}

if(!empty($_POST['del'])){
	$page['editor']['action'] = "DELETE";
	$query = $sql->del("employee","id =". $_POST['del']);
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


?>
