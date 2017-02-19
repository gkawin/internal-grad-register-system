<?php

$currenttemplate = "building_room.html";
$titleMsg ="Building Room Management";
$page['view'] = "list";
$sub = (isset($segment[2])&& $segment[2]!="form")? " >> ".$segment[2] : null;
$part = (isset($segment[2]))? "/".$segment[0]."/".$segment[1]."/".$segment[2] : "/".$segment[0]."/".$segment[1];
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] =mysql_escape_string(json_encode(
	array(	'ip'=>$_SERVER['REMOTE_ADDR'],
			'modules'=>$segment[1].$sub,
			'path'=>$part,
			'data'=>$_POST)));
			
$page['editor']['whoaction'] = $_SESSION['nameTH'];
$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','room')");
$page['_get'] = $_GET;
$query['all'] = "SELECT building.building_id,
building.building_name,
building.building_nameEN,
building.campus,
building_room.id,
building_room.room_name,
building_room.building_id,
building_room.remark,
building_room.`floor`,
building_room.room_type,
building_room.capacity,
building_room.area,
building_room.remark_text,
building_room.status,IF(building_room.status=1,'เปิดใช้งาน',IF(building_room.status=2,'รอการอนุมัติ','ยกเลิกการใช้งาน')) AS status1 FROM building ";
$query['all'] .= " Inner Join building_room ON building.building_id = building_room.building_id";
$query['_building'] = "SELECT * FROM building WHERE status = 1 OR status = 2";
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
	switch($segment[3]){
		case "new":
			$titleMsg = "Building Room  Management | AddNew";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				if(empty($_POST['remark'])){
					$_POST['remark'] = "-";
				}else{
					$_POST['remark'] = json_encode($_POST['remark']);
				}
				
				if(isset($_POST['remark_text_lec'])){
					
					$_POST['remark_text'] = mysql_escape_string(json_encode(array("lec"=>$_POST['remark_text_lec'])));
					unset($_POST['remark_text_lec']);
				}else{
					$_POST['remark_text'] = mysql_escape_string(json_encode(array("lab"=>$_POST['remark_text_lab'])));
					unset($_POST['remark_text_lab']);
				}
				unset($_POST['operation']);
				$rs['ins'] = $db->Execute($sql->add_db_single_qoute("building_room",$_POST));
				if($rs['ins']){
					$res['callback']['result'] = "เพิ่มรายการสำเร็จ";
					$page['editor']['result'] = "OK";
				}else{ 
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = str_replace("'","",$db->ErrorMsg());
				}
				$db->Execute($sql->add_db_single_qoute("system_log",$page['editor']));
			}
		break;
		case "edit":
		$titleMsg = "Building Room  Management | Editing";
		$page['editor']['action'] = "EDIT";
		
		
			
			
			
		if(!empty($_POST['operation'])){
			if(isset($_POST['remark_text_lec'])){
					
					$_POST['remark_text'] = mysql_escape_string(json_encode(array("lec"=>$_POST['remark_text_lec'])));
					unset($_POST['remark_text_lec']);
				}else{
					$_POST['remark_text'] = mysql_escape_string(json_encode(array("lab"=>$_POST['remark_text_lab'])));
					unset($_POST['remark_text_lab']);
				}
				$editid = $_GET['id'];
				unset($_POST['operation']);
				$rs['upd'] = $db->Execute($sql->update_db("building_room",$_POST," building_room.id = ".$editid));
				if($rs['upd'])
					$res['callback']['result'] = "ทำรายการสำเร็จ";
				else 
					$res['callback']['result'] = $sql->update_db("building_room",$_POST," building_room.id = ".$editid);
					//$db->ErrorMsg();
			}
			$query['all'] .= " WHERE building_room.id = '".$_GET['id']."'";
			$rs['sel']  = $db->Execute($query['all']);
			while(!$rs['sel']->EOF){
				$page['edit'] = $rs['sel']->fields;
				$page['edit']['remark'] = json_decode($rs['sel']->fields['remark'],TRUE);
				$page['edit']['remark_text'] = json_decode($rs['sel']->fields['remark_text'],TRUE);
				$rs['sel']->MoveNext();
			}
		break;
		case "chk":
			$query['all'] .= " WHERE building_room.room_name = '".$_POST['chkAvaliable']."'";
			echo $db->Execute($query['all'])->EOF;
			exit();
		break;
		default: $currenttemplate = "error404.html";
	}
}elseif($segment[2]==="time"){
	$page['view'] = "time";
	switch ($segment[3]){
		// เลือกภาคการศึกษา เพื่อแสดงวิชา
		case "getcourse":
		switch ($_POST['value']){
			case "1":
				$makequery = "WHERE course_plan_structure.semester_1 = 1";
			break;
			case "2":
				$makequery = "WHERE course_plan_structure.semester_2 = 1";
			break;
			case "3":
				$makequery = "WHERE course_plan_structure.semester_3 = 1";
			break;
		}
			$query['_chk'] = sprintf("SELECT
course.course_id,
course.course_name
FROM
course
INNER JOIN course_plan_structure ON course.course_id = course_plan_structure.course_id %s",$makequery);
			$rs['sel'] = $db->Execute($query['_chk']);
			while(!$rs['sel']->EOF){
				$row['_getcourse'][] = $rs['sel']->fields;
				$rs['sel']->MoveNext();
			}
			echo json_encode($row['_getcourse']);
			exit();
		break;
		//เลือกวิชา เพื่อแสดงประเภทปริญญาในแต่ละวิชา
		case "getdeg":
			
			$query['_getdeg'] = "SELECT
CONCAT(degree_level.degree_level_name,' ',degree_level.type) as deg,
course_section.section,
course_section.id as sectionid,
course_section.course_id,
degree_level.id as deg_id
FROM
course_section
INNER JOIN degree_level ON degree_level.id = course_section.degree_level_id
 WHERE course_section.course_id ='".$_POST['courseid']."'";
			$rs['sel'] = $db->Execute($query['_getdeg']);
				while(!$rs['sel']->EOF){
					$row['_getdeg'][] = $rs['sel']->fields;
					$rs['sel']->MoveNext();
				}
				echo json_encode($row['_getdeg']);
				exit();
		
		break;
		//เลือกประเภทปริญญา เพื่อแสดงกลุ่มเรียน
		case "getsection":
			$query['_getsection'] = "SELECT
course.course_id,
course_section.section,
course_section.id as course_section_id,
course_section.degree_level_id
FROM
course
INNER JOIN course_section ON course.course_id = course_section.course_id
 WHERE course_section.degree_level_id =".$_POST['deg']." AND course.course_id ='".$_POST['courseid']."'";
 
			$rs['sel'] = $db->Execute($query['_getsection']);
				while(!$rs['sel']->EOF){
					$row['getsection'][] = $rs['sel']->fields;
					$rs['sel']->MoveNext();
				}
				echo json_encode($row['getsection']);
				exit();
		break;
		// เลือกกลุ่มเรียน เพื่อแสดงประเภทการเรียน
		case "getlearn":
			$query['_getlearn'] = "SELECT
			course_section.study_practice,
			course_section.study_lec
			FROM
			course_section WHERE course_section.id = ".$_POST['sectionid'];

			$rs['sel'] = $db->Execute($query['_getlearn']);
			$i=0;
				while(!$rs['sel']->EOF){
					$row['_getlearn'][] = $rs['sel']->fields;
					if($row['_getlearn'][$i]['study_practice']==1 && $row['_getlearn'][$i]['study_lec']==1){
						$row['_getlearn1'] = array("lec","lab");
					}elseif($row['_getlearn'][$i]['study_practice']==1 && $row['_getlearn'][$i]['study_lec']==0){
						$row['_getlearn1'] = array("lab");
					}elseif($row['_getlearn'][$i]['study_practice']==0 && $row['_getlearn'][$i]['study_lec']==1){
						$row['_getlearn1'] = array("lec");
					}
					$rs['sel']->MoveNext();
					$i++;
				}
				echo json_encode($row['_getlearn1']);
				exit();
		break;
		// เลือกชนิดเรียน เพื่อแสดงตาราง
		case "calltable":
		$query['_calltable_chkins'] = "SELECT
		course_section.section,
		course_section.course_id,
		section_day_learn.learn_days,
		section_day_learn.learn_type,
		section_day_learn.time_start,
		section_day_learn.`interval`,
		section_day_learn.semester,
		section_day_learn.building_room_id,
		section_day_learn.course_section_id
		FROM
		section_day_learn
		INNER JOIN course_section ON course_section.id = section_day_learn.course_section_id
		WHERE section_day_learn.learn_type = '".$_POST['learn_type']."' AND section_day_learn.course_section_id = ".$_POST['sectionid']." AND section_day_learn.semester = ".$_POST['semester'];
 		$rs['sel'] = $db->Execute($query['_calltable_chkins']);
		if(!$rs['sel']->EOF){
			$bInserted =true;
		}
			$query['_calltable'] = "SELECT
			course_section.section,
			course_section.course_id,
			section_day_learn.learn_days,
			section_day_learn.learn_type,
			section_day_learn.time_start,
			section_day_learn.`interval`,
			section_day_learn.building_room_id,
			section_day_learn.semester,
			section_day_learn.id as section_day_learn_id
			FROM
			section_day_learn
			INNER JOIN course_section ON course_section.id = section_day_learn.course_section_id
			WHERE section_day_learn.building_room_id = ".$_POST['roomid']." AND section_day_learn.semester = ".$_POST['semester']."";
 
 			
 			$rs['sel'] = $db->Execute($query['_calltable']);
			while(!$rs['sel']->EOF){
				if($rs['sel']->fields['course_id'])
				$classes_arr[$rs['sel']->fields['learn_days']][$rs['sel']->fields['time_start']]['html'] = $rs['sel']->fields['course_id']."<br>".$rs['sel']->fields['learn_type'];
				$classes_arr[$rs['sel']->fields['learn_days']][$rs['sel']->fields['time_start']]['interval'] = $rs['sel']->fields['interval'];
				$classes_arr[$rs['sel']->fields['learn_days']][$rs['sel']->fields['time_start']]['sec_day_id'] = $rs['sel']->fields['section_day_learn_id'];
				$rs['sel']->MoveNext();
			}
			require_once(ROOT_DIR."/modules/edu/building_room/schedule_room.php");
	//}
			exit();
		
		break;
		case "inserttime":
			if(isset($_POST)){
				$res['callback']['result'] = $db->Execute($sql->add_db("section_day_learn",$_POST))->EOF;
				echo json_encode($res['callback']);
			}
		exit();
		break;
		case "deltime":
		if(isset($_POST)){
			$res['callback']['result'] = $db->Execute($sql->del("section_day_learn","id = ".$_POST['id']))->EOF;
			echo json_encode($res['callback']);
		}
			exit();
		break;
		
	}
}

if(!empty($_POST['del'])){
	$query = $sql->del("building_room","id = '".$_POST['del'])."'";
		$rs=$db->Execute($query);
		if(!$rs===false){
			$res['callback']['result'] = 1;
		}else{
			$res['callback']['result'] = 0;
			$res['callback']['reason'] = $db->ErrorMsg();
		}
		echo json_encode($res['callback']);
		exit();
}

?>
