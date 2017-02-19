<?php
$currenttemplate = "my.html";
$titleMsg = "My Profile Managment";

$query['_emp'] = "SELECT
employee.titlename,
employee.firstname,
employee.lastname,
employee.titlenameEN,
employee.firstnameEN,
employee.lastnameEN,
employee.gender,
employee.position,
employee.positionEN,
employee.hire_date,
employee.id,
major.major_name,
faculty.fac_name,
employee.pic_path,
employee.`status`,
employee.nation_id,
employee.admin_position,
employee.admin_positionEN,
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
employee.under_major_id,
employee.behavior_degree,
employee.master_degree,
employee.phd_degree,
employee.phd_degreeEN,
employee.master_degreeEN,
employee.behavior_degreeEN
FROM
employee
INNER JOIN major ON major.major_id = employee.under_major_id
INNER JOIN faculty ON major.fac_id = faculty.fac_id
WHERE employee.id = ".base64_decode($_SESSION['employee_id'])."";

$query['_group'] = "SELECT
employee_group_name.group_name,
employee.titlename,
employee.firstname,
employee.lastname,
employee.titlenameEN,
employee.firstnameEN,
employee.lastnameEN
FROM
employee
INNER JOIN employee_group_member ON employee_group_member.employee_id = employee.id
INNER JOIN employee_group_name ON employee_group_member.group_id = employee_group_name.group_id
WHERE employee.id = ".base64_decode($_SESSION['employee_id'])."";

$rs['sel'] = $db->Execute($query['_emp']);

while(!$rs['sel']->EOF){
	$page['emp_data'] = $rs['sel']->fields;
	$page['emp_data']['hire_date'] = DateThai($rs['sel']->fields['hire_date']);
	$rs['sel']->MoveNext();
}
$rs['sel'] = $db->Execute($query['_group']);
while(!$rs['sel']->EOF){
	$page['_group'][] = $rs['sel']->fields;
	$rs['sel']->MoveNext();
}

	$page['username'] = $_SESSION['username'];
if($segment[1] ==="changepassword"){
	switch($segment[1]){
		case "changepassword":
			if($segment[2]==="chk"){
				$query['_getpwd'] = "SELECT pwd FROM account WHERE employee_id = ".base64_decode($_SESSION['employee_id'])." AND username ='".$_SESSION['username']."' AND pwd = sha1('".$_POST['oldpwd']."')";
				$res['callback']['result'] = !$db->Execute($query['_getpwd'])->EOF;
				echo json_encode($res['callback']);
				exit();
			}elseif($segment[2]==="change"){
				$pwd = sha1($_POST['confimpwd']);
				$rs['upd'] = $db->Execute($sql->update_db("account",array("pwd"=>$pwd)," employee_id = ".base64_decode($_SESSION['employee_id']).""));
				$res['callback']['result'] = $rs['upd']->EOF;
					echo json_encode($res['callback']);
				exit();
			}
		break;
		default : $currenttemplate = "error404.html";
	}
	$page['view'] = "changepassword";
	
	
}/*elseif($segment[1]==="policy"){
	$page['view'] = "policy";
}*/

?>