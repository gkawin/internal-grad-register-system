<?php
$titleMsg = "EDUCATION STAFF MANAGEMENT || DASHBOARD";

if(mb_eregi('edu.cb.php',$_SERVER['PHP_SELF']))
{
	$currenttemplate= "error404.html";
}else{
	$currenttemplate = "edu.html";
	$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','edu')");
	if(!empty($segment[1])&&$segment[1]=="coursetype"){
		require_once(ROOT_DIR.'/modules/edu/coursetype/ct.h.php');
		require_once(ROOT_DIR.'/modules/edu/coursetype/ct.cb.php');	
	}
	else if(!empty($segment[1])&&$segment[1]=="course"){
		require_once(ROOT_DIR.'/modules/edu/course/course.h.php');
		require_once(ROOT_DIR.'/modules/edu/course/course.cb.php');
		
	}
	else if(!empty($segment[1])&&$segment[1]=="syllabus"){
		require_once(ROOT_DIR.'/modules/edu/syllabus/syllabus.h.php');
		require_once(ROOT_DIR.'/modules/edu/syllabus/syllabus.cb.php');
		
	}
	else if(!empty($segment[1])&&$segment[1]=="level"){
		require_once(ROOT_DIR.'/modules/edu/level/level.h.php');
		require_once(ROOT_DIR.'/modules/edu/level/level.cb.php');	
	}
	else if(!empty($segment[1])&&$segment[1]=="building"){
		require_once(ROOT_DIR.'/modules/edu/building/building.h.php');
		require_once(ROOT_DIR.'/modules/edu/building/building.cb.php');
		$aMenuTitle[''] = "";
	}
	else if(!empty($segment[1])&&$segment[1]=="building_room"){
		require_once(ROOT_DIR.'/modules/edu/building_room/room.h.php');
		require_once(ROOT_DIR.'/modules/edu/building_room/room.cb.php');
		$aMenuTitle[''] = "";
	}
	else if(!empty($segment[1])&&$segment[1]=="faculty"){
		require_once(ROOT_DIR.'/modules/edu/faculty/faculty.h.php');
		require_once(ROOT_DIR.'/modules/edu/faculty/faculty.cb.php');
		$aMenuTitle[''] = "";
	}else if(!empty($segment[1])&&$segment[1]=="major"){
		require_once(ROOT_DIR.'/modules/edu/major/major.h.php');
		require_once(ROOT_DIR.'/modules/edu/major/major.cb.php');
		$aMenuTitle[''] = "";
	}
	else if(!empty($segment[1])&&$segment[1]=="employee"){
		require_once(ROOT_DIR.'/modules/edu/employee/emp.h.php');
		require_once(ROOT_DIR.'/modules/edu/employee/emp.cb.php');
		$aMenuTitle[''] = "";
	}
	else if(!empty($segment[1])&&$segment[1]=="group"){
		require_once(ROOT_DIR.'/modules/edu/group/group.h.php');
		require_once(ROOT_DIR.'/modules/edu/group/group.cb.php');
		$aMenuTitle[''] = "";
	}
	else if(!empty($segment[1])&&$segment[1]=="result"){
		require_once(ROOT_DIR.'/modules/edu/result/result.h.php');
		require_once(ROOT_DIR.'/modules/edu/result/result.cb.php');

	}
	else if(!empty($segment[1])&&$segment[1]=="exam"){
		require_once(ROOT_DIR.'/modules/edu/exam/exam.h.php');
		require_once(ROOT_DIR.'/modules/edu/exam/exam.cb.php');
	}
	else if(!empty($segment[1])&&$segment[1]=="schedule"){
		require_once(ROOT_DIR.'/modules/edu/schedule/schedule.h.php');
		require_once(ROOT_DIR.'/modules/edu/schedule/schedule.cb.php');
	}
	else if(isset($segment[1])){
		$currentpage = "error404.html";
	}
}

?>