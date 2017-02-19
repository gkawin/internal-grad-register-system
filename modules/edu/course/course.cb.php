<?php
$currenttemplate = 'course.html';
$titleMsg = "Course Management";
$page['view'] = "list";
$page['user'] = $_SESSION;
$aCourselistSpit = array();
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
				'".date("Y-m-d")." ".date("H:i:s")."','course')");
$page['_get'] = $_GET;
$query['all'] = "SELECT
	course.course_id,
	course.course_idEN,
	course.course_name,
	course.course_nameEN,
	course.credit,
	course.lecture,
	course.practice,
	course.status,
	course.course_description,
	course.course_descriptionEN,
	major.major_name,
	faculty.fac_name,
	major.major_id,
	course.date_final,
course.date_midterm
	FROM
	course
	INNER JOIN major ON course.major_id = major.major_id
	INNER JOIN faculty ON major.fac_id = faculty.fac_id"; // แสดงรายวิชาทั้งหมด
$query['_section'] = "SELECT
IF(course_section.status=1,'เปิดใช้งาน',IF(course_section.status=2,'รอการอนุมัติ','ยกเลิกการใช้งาน')) AS status1,
IF(course.status=1,'เปิดใช้งาน',IF(course.status=2,'รอการอนุมัติ','ยกเลิกการใช้งาน')) AS status_course_text,
course.course_id,
course.course_idEN,
course.course_name,
course.course_nameEN,
course_section.id as secid,
course_section.section,
course_section.total_seat,
course_section.category,
course_section.study_lec,
course_section.study_practice,
course_section.`status`,
course.date_final,
course.date_midterm,
course.`status` AS status_course,
course.practice,
course.lecture,
course.credit,
major.major_name,
course_section.formajor,
CONCAT(degree_level.degree_level_name,' ',degree_level.type) AS degree_level_name,
degree_level.id AS deg_id
FROM
course
INNER JOIN course_section ON course_section.course_id = course.course_id
INNER JOIN major ON course.major_id = major.major_id
INNER JOIN degree_level ON degree_level.id = course_section.degree_level_id"; //แสดง SECTION
	if($segment[2]!=="section" && $segment[3]!=="edit"){
		$query['_section'] .= " ORDER BY course_section.id ASC";
		$query['_teacher'] = "SELECT
		CONCAT(employee.titlename,employee.firstname,' ',employee.lastname) AS `name`,
		employee.id AS emp_id,
		course.course_id,
		course_section.id AS sec_id,
		course_section.section
		FROM duty_course_section
			 INNER JOIN employee ON employee.id = duty_course_section.employee_id
			 INNER JOIN course_section ON course_section.id = duty_course_section.course_section_id
			 INNER JOIN course ON course_section.course_id = course.course_id";
	}
$query['_major'] = "SELECT
faculty.fac_name,
major.major_id,
major.major_name
FROM
major
INNER JOIN faculty ON major.fac_id = faculty.fac_id WHERE major_id <> 99";
$query['dlvl'] = "SELECT * FROM degree_level";
$query['room'] = "SELECT
building_room.id,
building_room.room_name,
building.building_name,
building_room.`status`,
building_room.room_type
FROM
building_room
INNER JOIN building ON building.building_id = building_room.building_id";
$query['_teacher'] = "SELECT employee.id FROM employee";
$key = array_keys($query);

for($i=0;$i<count($query);$i++){
	if($key[$i] ==="_section"){ //Execute แยก Section
		$rs[$i] = $db->Execute($query[$key[$i]]);
		while(!$rs[$i]->EOF){
			$page['_section'][$rs[$i]->fields['course_id']][$rs[$i]->fields['degree_level_name']][] = $rs[$i]->fields;
			$rs[$i]->MoveNext();
		}
	}else{
		$rs[$i] = $db->Execute($query[$key[$i]]);
		while(!$rs[$i]->EOF){
			$page[$key[$i]][]=$rs[$i]->fields;
			$rs[$i]->MoveNext();
		}
	}
}
//print_r($page['_section']);
//Part of course section management
if($segment[2]==="section"){
	$page['view'] = "section";
	switch($segment[3]){
		case "new":
		$page['editor']['action'] = "ADD";
			$query['all'] .= " WHERE course.course_id = '".$_GET['courseid']."'";
			$rs['sel'] = $db->Execute($query['all']);
			$page['c_name'] = $rs['sel']->fields['course_name'];
			$page['c_id'] = $rs['sel']->fields['course_id'];
			$page['chkLab'] = $rs['sel']->fields['practice'];
			$page['chkLec'] = $rs['sel']->fields['lecture'];
		
			if($_POST['findSection']){ //ส่งค่า section กลับ เพื่อสร้างค่า section ใหม่โดยอัตโนมัติ
				$query['_section'] .= " WHERE course.course_id = '".$_POST['courseid']."' AND course_section.degree_level_id = ".$_POST['degree_lvl'];
				$res['callback']['CountSec'] = $db->Execute($query['_section'])->RecordCount()+1;
				echo json_encode($res['callback']);
				exit();
			}
		if(!empty($_POST['operation'])){
			$sGetPost['employee_id'] = explode(",",$_POST['teacher']);
			unset($_POST['operation']);
			unset($_POST['hsec_id']);
			unset($_POST['teacher']);
			//insert section
			$rs['ins'] = $db->Execute($sql->add_db("course_section",$_POST));
			if($rs['ins']){
				foreach($sGetPost['employee_id'] as $item){
					//insert duty_course_section
					$rs['ins'] = $db->Execute($sql->add_db("duty_course_section",array("employee_id"=>$item,"course_section_id"=>$db->Insert_ID())));
				}
				$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
				$page['editor']['result'] = "OK";
			}else{
				$res['callback']['result'] = "ล้มเหลว";
				$page['editor']['result'] = "FAIL";
			}
			$_POST = array_merge($_POST,$sGetPost['employee_id']);
			$db->Execute($sql->add_db("system_log",$page['editor']));
		}
		
		break;
		case "edit" :
			$page['editor']['action'] = "EDIT";
			if(!empty($_POST['operation'])){
				$_POST['study_lec'] = (isset($_POST['study_lec']))? 1 : 0;
				$_POST['study_practice'] = (isset($_POST['study_practice']))? 1 : 0;				
				$sGetPost['hsec_id'] = $_POST['hsec_id'];
				$sGetPost['section'] = $_POST['section'];
				$sGetPost['employee_id'] = explode(",",$_POST['teacher']);	
				unset($_POST['operation']);
				unset($_POST['hsec_id']);
				unset($_POST['section']);
				unset($_POST['teacher']);
				$rs['upd'] = $db->Execute($sql->update_db("course_section",$_POST,"course_section.id = ".$sGetPost['hsec_id']." AND course_section.section = ".$sGetPost['section']));
				if($rs['upd']->EOF){
					foreach($sGetPost['employee_id'] as $item){
						$q = "SELECT * FROM duty_course_section WHERE course_section_id = ".$sGetPost['hsec_id']." AND employee_id = ".$item; // check already data row
						$rs['sel'] = $db->Execute($q);
						if($rs['sel']->EOF){
							//insert duty_course_section
							$rs['ins'] = $db->Execute($sql->add_db("duty_course_section",array("employee_id"=>$item,"course_section_id"=>$sGetPost['hsec_id'])));
						}else{
							//update duty_course_section
							$rs['upd'] = $db->Execute($sql->update_db("duty_course_section",array("employee_id"=>$item),"course_section_id = '".$sGetPost['hsec_id']."'"));
						}
					}
					$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
					$page['editor']['result'] = "OK";
				}else{
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$_POST = array_merge($_POST,$sGetPost);
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
			$query['_section'] .= " WHERE course.course_id = '".$_GET['courseid']."' AND course_section.id =".$_GET['sectionid']." ";
			$query['_teacher'] = "SELECT CONCAT(employee.titlename,employee.firstname,' ',employee.lastname) AS name,
		employee.id AS id FROM duty_course_section
	 INNER JOIN employee ON employee.id = duty_course_section.employee_id
	 INNER JOIN course_section ON course_section.id = duty_course_section.course_section_id
	 INNER JOIN course ON course_section.course_id = course.course_id WHERE course.course_id = '".$_GET['courseid']."' AND course_section.section =".$_GET['section'];
	 	$page['_teacher'] = array();
			$rs['sel'] = $db->Execute($query['_teacher']);
			while(!$rs['sel']->EOF){
				$page['_teacher'][] = $rs['sel']->fields;
				$rs['sel']->MoveNext();
			}
			$page['_teacher']= json_encode($page['_teacher']);
			
			$rs['EditSec'] = $db->Execute($query['_section']);
			
			while(!$rs['EditSec']->EOF){
				$page['EditSec'] = $rs['EditSec']->fields;
				$page['aMajor'][] = array("name"=>$rs['EditSec']->fields['major_name'],"id"=>$rs['EditSec']->fields['major_id']);
				$rs['EditSec']->MoveNext();
			}
			$page['aMajor'] = json_encode($page['aMajor']);
		break;
		case "schedule":
			$page['view'] = "schedule";
			switch($segment[4]){
				case "chkroom":
				//print_r($page['room']);
					$query['schedule'] = sprintf("SELECT
section_day_learn.learn_days,
course_section.section,
building.building_name,
building_room.room_name,
section_day_learn.time_start,
section_day_learn.`interval`,
section_day_learn.learn_type,
CONCAT(degree_level.degree_level_name,' ',degree_level.type) AS deg_type,
building.building_id,
course.course_id,
course.course_name
FROM
course_section
INNER JOIN section_day_learn ON course_section.id = section_day_learn.course_section_id
INNER JOIN building_room ON section_day_learn.building_room_id = building_room.id
INNER JOIN building ON building.building_id = building_room.building_id
INNER JOIN degree_level ON degree_level.id = course_section.degree_level_id
INNER JOIN course ON course.course_id = course_section.course_id
WHERE building_room.id = %d",$_POST['roomid']);
					
					$rs['sel'] = $db->Execute($query['schedule']);
					while(!$rs['sel']->EOF){
						$classes[$rs['sel']->fields['learn_days']][$rs['sel']->fields['time_start']]=$rs['sel']->fields;
						$classes[$rs['sel']->fields['learn_days']][$rs['sel']->fields['time_start']]['html'] = $rs['sel']->fields['course_id']." (".$rs['sel']->fields['learn_type'].")"."<br/>กลุ่ม ".$rs['sel']->fields['section'].", ".$rs['sel']->fields['room_name']."<br>".$rs['sel']->fields['building_name']."(".$rs['sel']->fields['building_id'].")<br>".$rs['sel']->fields['deg_type'];
						$classes[$rs['sel']->fields['learn_days']][$rs['sel']->fields['time_start']]['style'] = "background-color: #66CCCC";
						$rs['sel']->MoveNext();
					}
					require_once(ROOT_DIR."/modules/edu/course/schedulePattern.php");
					
					exit();
				break;
				case "saveroom":
					print_r($_POST);
					$aInsTable['interval'] = count($_POST['range'])*intval($_POST['row_interval']);
					$aInsTable['time_start'] = $_POST['range'];
					exit();
				break;
			}
		break;		
		default :
			$currenttemplate = "error404.html";	
		break;
	}
}
// Part of Course Mnagement
if($segment[2] == "form"){
	$page['view'] = "form";
	switch($segment[3]){
		case "new" :
			$titleMsg = "Course Management | AddNew";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				$sTempCourseBefore = $_POST['course_before'];
				$_POST['course_idEN'] = $_POST['course_id_prefixEN'].$_POST['course_id_postfixEN'];
				$_POST['course_id'] = $_POST['course_id_prefix'].$_POST['course_id_postfix'];
				unset($_POST['course_before']);
				unset($_POST['operation']);
				unset($_POST['course_id_prefixEN']);
				unset($_POST['course_id_postfixEN']);
				unset($_POST['course_id_prefix']);
				unset($_POST['course_id_postfix']);
				$rs['ins'] = $db->Execute($sql->add_db("course",$_POST));
				if($rs['ins']){
					if(!empty($sTempCourseBefore)){
						$aCourselistSpit = explode(",",$sTempCourseBefore);	
						foreach($aCourselistSpit as $item){
							$queryList =  $sql->add_db("course_has_course",array("course_id"=>$_POST['course_id'],"course_before"=>$item));
							$rs['addNew_courseBefore'] = $db->Execute($queryList);
						}
					}
					$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
					$page['editor']['result'] = "OK";
					$res['addid'] = $_POST['course_id'];
				}else{
					$page['editor']['result'] = "FAIL";
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				
				$_POST = array_merge($_POST,$aCourselistSpit);
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
		break;
		case "edit":
			$titleMsg = "Course Management | Editing";
			$page['editor']['action'] = "EDIT";
			
			if(!empty($_POST['operation'])){
				$sTempCourseBefore = $_POST['course_before'];
				$_POST['course_idEN'] = $_POST['course_id_prefixEN'].$_POST['course_id_postfixEN'];
				$_POST['course_id'] = $_POST['course_id_prefix'].$_POST['course_id_postfix']; 
				unset($_POST['course_before']);
				unset($_POST['operation']);
				unset($_POST['course_id_prefixEN']);
				unset($_POST['course_id_postfixEN']);
				unset($_POST['course_id_postfix']);
				unset($_POST['course_id_prefix']);
				
				$rs['upd'] = $db->Execute($sql->update_db("course",$_POST,"course_id = '".$_POST['course_id']."'"));
				if($rs['upd']){
					if(!empty($sTempCourseBefore)){
						$aCourselistSpit = explode(",",$sTempCourseBefore);	
						foreach($aCourselistSpit as $item){
						$q = "SELECT * FROM course_has_course WHERE course_id = '".$_POST['course_id']."' AND course_before = '".$item."'"; // check already data row
						$rs['sel'] = $db->Execute($q);
							if($rs['sel']->EOF){
								//insert duty_course_section
								$rs['ins'] = $db->Execute($sql->add_db("course_has_course",array("course_id"=>$_POST['course_id'],"course_before"=>$item)));
							}else{
								//update duty_course_section
								$rs['upd'] = $db->Execute($sql->update_db("course_has_course",array("course_before"=>$item),"course_id = '".$_POST['course_id']."'"));
							}
						}
					}
					$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
					$page['editor']['result'] = "OK";
				}else{
					$page['editor']['result'] = "FAIL";
					$res['callback']['result'] = $db->ErrorMsg();
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$_POST = array_merge($_POST,$aCourselistSpit);
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
			
			$query['editAll'] = $query['all']." WHERE course_id = '".$_GET['courseid']."'"; // query course edit
			$query['courseBefore'] = "SELECT course_id AS name,course_before AS id FROM course_has_course WHERE course_id = '".$_GET['courseid']."'"; // query course before
			$key = array_keys($query);
			for($i=0;$i<count($query);$i++){
				$rs[$i] = $db->Execute($query[$key[$i]]);
				while(!$rs[$i]->EOF){
					$page[$key[$i]][]=$rs[$i]->fields;
					$rs[$i]->MoveNext();
				}
			}
			$page['courseBefore'] = json_encode($page['courseBefore']);
			$page['editAll'][0]['course_id_prepostfix'] = str_split ( $page['editAll'][0]['course_id'], 6);
			$page['editAll'][0]['course_id_prepostfixEN'] = str_split ( $page['editAll'][0]['course_idEN'], 2);
		break;
		default :
			$currenttemplate = "error404.html";	
		break;
	}
}

//delete union
if(!empty($_POST['deltype'])){
	$page['editor']['action'] = "DELETE";
	switch ($_POST['deltype']){
		//ตรวจสอบการค้างของกลุ่มวิชา
		case sha1(md5("chkpil")) :
			$query['_delchkcourse'] = "SELECT
course.course_id,
course_section.section
FROM
course_section
INNER JOIN course ON course_section.course_id = course.course_id
WHERE course.course_id = '".$_POST['courseid']."'"; 

			$rs['sel'] = $db->Execute($query['_delchkcourse']);
			if(!$rs['sel']->EOF){
				$res['callback']['result'] = 1;
			}else{
				$res['callback']['result'] = 0;
			}
			echo json_encode($res['callback']);
		break;
		//ยืนยันการลบวิชา
		case sha1(md5("confirmdel")) :
			$rs['del'] = $db->Execute($sql->del("course","course.course_id ='".$_POST['courseid']."'"));
			if($rs['del']->EOF){
				$res['callback']['result'] = 1;
				$page['editor']['result'] = "OK";
			}else{
				$page['editor']['result'] = "FAIL";
				$res['callback']['result'] = 0;
			}
			echo json_encode($res['callback']);
			$db->Execute($sql->add_db("system_log",$page['editor']));
		break;
		
		case sha1(md5("teachDel")) :
			$query['del'] =  $sql->del("duty_course_section","course_section_id = ".$_POST['sec_id']." AND employee_id = ".$_POST['emp_id']);
			$rs['del'] = $db->Execute($query['del']);
			if($rs['del']->EOF){
				$res['callback']['result']  = 1;
				$page['editor']['result'] = "OK";
			}else{
				$res['callback']['result'] = 0;
				$page['editor']['result'] = "FAIL";
			}
			echo json_encode($res['callback']);
			$db->Execute($sql->add_db("system_log",$page['editor']));
			break;
		case sha1(md5("secdel")) :
			$rs['del'] = $db->Execute($sql->del("course_section","id =".$_POST['section_id']));
			if($rs['del']->EOF){
				$res['callback']['result'] = 1;
				$page['editor']['result'] = "OK";
			}else{
				$page['editor']['result'] = "FAIL";
				$res['callback']['result'] = 0;
			}
			echo json_encode($res['callback']);
			$db->Execute($sql->add_db("system_log",$page['editor']));
		break;
	}
	exit();
}
// ตรวจสอบรายวิชาว่าซ้ำหรือไม่
if(!empty($_POST['chkAvaliable'])){
	$query['all'] .= " WHERE course_id = '".$_POST['chkAvaliable']."'";
	$rs['_chkAva'] = $db->Execute($query['all']);
	if($rs['_chkAva']->EOF){
		echo "OK";
	}else{
		echo '<font color="red">ไม่สามารถใช้ชื่อ <STRONG>'.$_POST['chkAvaliable'].'</STRONG> นี้ได้</font>';
	}
	exit();
}
if($_POST['callprefix']){
	$query['_callprefix'] = "SELECT * FROM prefix_course WHERE major_id = '".$_POST['data']."'";
	
	$rs['sel'] = $db->Execute($query['_callprefix']);
	while(!$rs['sel']->EOF){
		$res['callback']['prefix'] = $rs['sel']->fields;
		$rs['sel']->MoveNext();
	}
	echo json_encode($res['callback']['prefix']);
	exit();
}
?>
