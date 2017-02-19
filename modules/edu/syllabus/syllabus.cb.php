<?php
$currenttemplate = 'syllabus.html';
$titleMsg = "การจัดการหลักสูตร";
$page['view'] = "list";
$page['user'] = $_SESSION;
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] = mysql_escape_string(json_encode(
	array(	"ip"=>$_SERVER['REMOTE_ADDR'],
			"modules"=>$segment[1]." >> ".$segment[2],
			"path"=>$_SERVER['REQUEST_URI'],
			"data"=>$_POST)));
$page['editor']['whoaction'] = $_SESSION['nameTH'];
$query['_syllabus'] = "SELECT
program.program_id,
program.program_name,
program.program_nameEN,
program.years_normal,
program.max_years,
program.minimum_gpa,
degree_level.degree_level_name,
degree_level.id AS degLvl_id,
major.major_name,
major.major_nameEN,
major.major_id,
program.`status`,
faculty.fac_name,
degree_level.qualification_init,
degree_level.type
FROM
program
INNER JOIN degree_level ON program.degree_level_id = degree_level.id
INNER JOIN major ON program.major_id = major.major_id
INNER JOIN faculty ON major.fac_id = faculty.fac_id";
$query['_plan'] = "SELECT
edu_plan.program_suite,
edu_plan.id AS edu_id,
edu_plan.all_credit,
edu_plan.status,
edu_plan.program_id,
IF(edu_plan.status=1,'เปิดใช้งาน',IF(edu_plan.status=2,'รอการอนุมัติ','ยกเลิกการใช้งาน')) AS statusTH,
program.program_name,
major.major_name,
faculty.fac_name,
degree_level.degree_level_name,
program.minimum_gpa,
program.years_normal,
program.program_nameEN,
program.program_id,
major.major_nameEN,
faculty.fac_nameEN
FROM
edu_plan
Inner Join program ON program.program_id = edu_plan.program_id
Inner Join major ON program.major_id = major.major_id
Inner Join faculty ON major.fac_id = faculty.fac_id
Inner Join degree_level ON program.degree_level_id = degree_level.id";
$query['_coursetype'] = "SELECT * FROM course_type";
$query['_degreeLvl'] = "SELECT * FROM degree_level";
$query['_major'] = "SELECT
major.major_id,
major.major_name,
major.major_nameEN,
faculty.fac_name
FROM
faculty
INNER JOIN major ON major.fac_id = faculty.fac_id
WHERE major.major_id <> 99";
if($segment[3]==="students"){
	$query['_gradList'] = "SELECT
	graduate_personal.Graduate_ID,
	concat(graduate_personal.Title_Name,
	graduate_personal.Graduate_Name,' ',
	graduate_personal.Graduate_Lastname) AS stdName,
	CONCAT(graduate_personal.Title_Name_English,'.',
	graduate_personal.Graduate_Name_English,' ',
	graduate_personal.Graduate_Lastname_English) AS stdNameEN,
	graduate_personal.image,
	graduate_personal.graduate_status,
	graduate_personal.School_Year,
	graduate_personal.edu_plan_id
	FROM
	graduate_personal";
	$query['_edu_plan'] = "SELECT
	program.program_name,
	edu_plan.program_suite,
	edu_plan.all_credit,
	degree_level.degree_level_name,
	major.major_name,
	program.program_id,
	edu_plan.id AS planID
	FROM
	edu_plan
	INNER JOIN program ON edu_plan.program_id = program.program_id
	INNER JOIN degree_level ON program.degree_level_id = degree_level.id
	INNER JOIN major ON program.major_id = major.major_id";
}
$key = array_keys($query);
if(!empty($_GET['id']))
	$query['_plan'] .= " WHERE edu_plan.id = ".$_GET['id']."";
if(!empty($_GET['programid'])&& $segment[2] ==="plan" && $segment[3]==="new")
	$query['_syllabus'] .= " WHERE program.program_id = '".$_GET['programid']."'";
for($i=0;$i<count($query);$i++){
	$rs[$i] = $db->Execute($query[$key[$i]]);
	while(!$rs[$i]->EOF){
		$page[$key[$i]][]=$rs[$i]->fields;
		$rs[$i]->MoveNext();
	}
}

//print_r($page['_syllabus']);
if($segment[2] ==="plan"){
	$page['_GETDAT'] = $_GET;
	switch ($segment[3]){
		case "view"://unfinish
			require_once(ROOT_DIR."/modules/edu/syllabus/docsexport.php");
		break;
		case "new" :
			$page['view'] = "newplan";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				$_POST['program_suite'] = $_POST['program_suite'][0]." แบบ ".$_POST['program_suite'][1];
				$rs['ins'] = $db->Execute($sql->add_db("edu_plan",
					array(
						"all_credit"=>$_POST['all_credit'],
						"program_suite"=>$_POST['program_suite'],
						"status"=>$_POST['status'],
						"program_id"=>$_GET['programid'])));
				$iInsid = $db->Insert_ID();
				// Insert into plan_structure table
				if($rs['ins']){
					$i=0;
					$aInsid = array();
					$aBin = array();
					foreach($_POST['course_Struc'] as $item){
						$rs['ins'] = $db->Execute($sql->add_db("plan_structure",
							array("course_type_id"=>$item,"course_type_credit"=>$_POST['course_type_credit'][$i],"edu_plan_id"=>$iInsid)));
							$aInsid[$i] = $db->Insert_ID();	
							$i++;
					}
					for($j=0;$j<count($_POST['course_list']);$j++){
						$aBin[$j] = explode(",",$_POST['course_list'][$j]);
						for($k=0;$k<count($aBin[$j]);$k++){
							$rs['ins'] = $db->Execute($sql->add_db("course_plan_structure",array("course_id"=>$aBin[$j][$k],"struc_id"=>$aInsid[$j])));				
						}
					}
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
		//ไม่เปิดใช้งาน
		case "edit" :
			$rs['sel'] = array();
			$page['view'] = "newplan";
			$query['_plan'] .= " AND program.program_id = '".$_GET['program_id']."'";
			$query['_struc'] = "SELECT
	plan_structure.course_type_credit,
	plan_structure.course_type_id,
	course.course_id,
	edu_plan.all_credit,
	edu_plan.program_suite,
	edu_plan.`status`,
	edu_plan.program_id,
	course_type.course_type_nameTH,
	edu_plan.id,
	course.course_name
	FROM
	course_plan_structure
	INNER JOIN course ON course_plan_structure.course_id = course.course_id
	INNER JOIN plan_structure ON course_plan_structure.struc_id = plan_structure.struc_id
	INNER JOIN edu_plan ON plan_structure.edu_plan_id = edu_plan.id
	INNER JOIN course_type ON plan_structure.course_type_id = course_type.id WHERE edu_plan.id = ".$_GET['id']." AND edu_plan.program_id = '".$_GET['program_id']."'";
			unset($query['_coursetype']);
			$key = array_keys($query);
			
			for($i=0;$i<count($query);$i++){
				$rs['sel'][$i] = $db->Execute($query[$key[$i]]);
				while(!$rs['sel'][$i]->EOF){
					$page[$key[$i]][]=$rs['sel'][$i]->fields;
					$rs['sel'][$i]->MoveNext();
				}
			}
			if(!empty($page['_struc'])){
				foreach($page['_struc'] as $item){
					$aBinModel[$item['course_type_id']] = array_unique($item);
					foreach($aBinModel as $key=>$value){
						if($key == $item['course_type_id']){
							$res['aModel'][$key][] = $item;
						}
					}
					$res['oStruJson'] = json_encode($res['aModel']);
				}
			}
			$res['oStruJson'] = json_encode($res['aModel']);
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				//print_r($_POST);
				//exit();
				$rs['ins'] = $db->Execute($sql->update_db("edu_plan",
					array(
						"all_credit"=>$_POST['all_credit'],
						"program_suite"=>$_POST['program_suite'],
						"status"=>$_POST['status'],
						"program_id"=>$_GET['program_id'])));
				$iInsid = $db->Insert_ID();
				//echo $iInsid;
				// Insert into plan_structure table
				if($rs['ins']){
					$i=0;
					$aInsid = array();
					$aBin = array();
					foreach($_POST['course_Struc'] as $item){
						$rs['ins'] = $db->Execute($sql->add_db("plan_structure",
							array("course_type_id"=>$item,"course_type_credit"=>$_POST['course_type_credit'][$i],"edu_plan_id"=>$iInsid)));
							$aInsid[$i] = $db->Insert_ID();	
							$i++;
					}
					for($j=0;$j<count($_POST['course_list']);$j++){
						$aBin[$j] = explode(",",$_POST['course_list'][$j]);
						for($k=0;$k<count($aBin[$j]);$k++){
							$rs['ins'] = $db->Execute($sql->add_db("course_plan_structure",array("course_id"=>$aBin[$j][$k],"struc_id"=>$aInsid[$j])));				
						}
					}
					$res['callback']['result'] = "ทำรายการสำเร็จ";
				}else{
					
					$res['callback']['result'] = "ล้มเหลว เพราะ ";
				}
			}			
		break;
		case "nocredit" :
			$page['view'] = "nonCreditStd";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST)){
				print_r($_POST);
				$aBinCourse = !empty($_POST['no_credit']) ? explode(",",$_POST['no_credit']) : null;
				
				if(!empty($aBinCourse)){
					foreach($aBinCourse as $noCrdItem){
						$query['_selNocrd'] = "SELECT * FROM no_credit_course WHERE Graduate_ID = '".$_POST['gid']."' AND course_id = '".$noCrdItem."'";
						$rs['sel'] = $db->Execute($query['_selNocrd']);
						if($rs['sel']->EOF){
							$rs['ins'] = $db->Execute($sql->add_db("no_credit_course",array(
								"course_id"=>$noCrdItem,
								"Graduate_ID"=>$_POST['gid'],
								"term_register_id"=>$_POST['course_take_term'],
								"result_grade"=>null)));
								echo $res['callback']['result'] = 1;
								$res['callback']['result'] = "ทำรายการสำเร็จ";
								$page['editor']['result'] = "OK";
						}
						$db->Execute($sql->add_db("system_log",$page['editor']));
					}
				}
				exit();
			}
			$eid =0;
			if($segment[4]!= "crd"){
				$query['_stdList'] = "SELECT
				graduate_personal.Graduate_ID,
				program.program_name,
				major.major_name,
				edu_plan.program_suite,
				program.program_id,
				edu_plan.id AS EDUID,
				CONCAT (graduate_personal.Title_Name,graduate_personal.Graduate_Name,' ',graduate_personal.Graduate_Lastname) AS stdName
				FROM
				graduate_personal
				Inner Join edu_plan ON graduate_personal.edu_plan_id = edu_plan.id
				Inner Join program ON edu_plan.program_id = program.program_id
				Inner Join major ON program.major_id = major.major_id";
				$key = array_keys($query);
				for($i=0;$i<count($query);$i++){
					$rs[$i] = $db->Execute($query[$key[$i]]);
					while(!$rs[$i]->EOF){
						$page[$key[$i]][]=$rs[$i]->fields;
						$rs[$i]->MoveNext();
					}
				}
				$row['eid'] = $_GET['id'];
			}else{
				
				$res['_getdata'] = $_GET;
				require_once(ROOT_DIR."/modules/edu/syllabus/no_creditfrm.php");
			}
			
		break;
		//ไม่เปิดการใช้งาน
		case "makeschedule":
		$page['view'] = "makeschedule";
			if($_POST['makeschedule']){
				//check inserted timetable in room
				if(isset($_POST['courseid'])){
					$query['_chkTable'] = "SELECT
					course_section.course_id,
					building.building_name,
					building_room.room_name
					FROM
					course_section
					INNER JOIN section_day_learn ON course_section.id = section_day_learn.course_section_id
					INNER JOIN building_room ON building_room.id = section_day_learn.building_room_id
					INNER JOIN building ON building_room.building_id = building.building_id
					WHERE course_section.course_id = '".$_POST['courseid']."'";
					$rs['sel'] = $db->Execute($query['_chkTable']);
					if($rs['sel']->EOF){
						$rs['upd'] = $db->Execute($sql->update_db("course_plan_structure",array($_POST['target']=>$_POST['data']),"id = ".$_POST['updateid']));
						$res['callback']['result'] = $rs['upd']->EOF; 
						
					}else{
						$res['callback']['result']=false;
						$res['callback']['reason'] = "ไม่สามารถเปลี่ยนแปลงได้ เนื่องจากมีการลงตารางเวลา \n";
						while(!$rs['sel']->EOF){	
							$res['callback']['reason'] .= "- ห้องเรียน ".$rs['sel']->fields['room_name']." อาคาร ".$rs['sel']->fields['building_name']."\n";
							$rs['sel']->MoveNext();
						}
						
					}
				}else{
					$rs['upd'] = $db->Execute($sql->update_db("course_plan_structure",array($_POST['target']=>$_POST['data']),"id = ".$_POST['updateid']));
					$res['callback']['result'] = $rs['upd']->EOF; 
				}
					echo json_encode($res['callback']);
					exit();
			}else{		
				
				$query['_tpSetting'] = "SELECT
				edu_plan.program_suite,
				plan_structure.course_type_credit,
				course_type.course_type_nameTH,
				edu_plan.all_credit,
				edu_plan.id as edu_id,
				course.course_id,
				course.course_name,
				course_plan_structure.semester_1,
				course_plan_structure.semester_2,
				course_plan_structure.semester_3,
				course_plan_structure.years_level,
				course_plan_structure.id as course_plan_structure_id,
				course_plan_structure.struc_id
				FROM
				edu_plan
				INNER JOIN plan_structure ON plan_structure.edu_plan_id = edu_plan.id
				INNER JOIN course_plan_structure ON course_plan_structure.struc_id = plan_structure.struc_id
				INNER JOIN course_type ON course_type.id = plan_structure.course_type_id
				INNER JOIN course ON course.course_id = course_plan_structure.course_id
				WHERE edu_plan.id = ".$_GET['id'];
				$rs['sel'] = $db->Execute($query['_tpSetting']);
				echo $db->ErrorMsg();
				while(!$rs['sel']->EOF){
					$row['_tpSetting'][$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields;
					$rs['sel']->MoveNext();
				}
				
			}
			//print_r($row['_tpSetting']);

			
		break;
		case "students":
		$page['view'] = "students";
		$page['editor']['action'] = "EDIT";
			if($_POST['operation']){
				$rs['upd'] = $db->Execute($sql->update("graduate_personal","edu_plan_id =".$_POST['eduID']."","Graduate_ID = '".$_POST['gradID']."'"));
				$res['callback']['result'] = $res['upd']->EOF;
				echo json_encode($res['callback']);
				$page['editor']['result'] = "OK";
				$db->Execute($sql->add_db("system_log",$page['editor']));
				exit();
			}
			
		break;
		default :
			$currenttemplate = "error404.html";	
		break;
	}
}elseif($segment[2]==="form"){
	$page['view'] = "form";
	switch ($segment[3]){
		case "new" :
			$titleMsg = "Degree Management | AddNew";
			$page['editor']['action'] = "ADD";
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				$rs['ins'] = $db->Execute($sql->add_db("program",$_POST)); 
				if($rs['ins']){
					$res['callback']['result'] = "<span>ทำรายการสำเร็จ</span>";
					$res['callback']['idBack'] = $_POST['program_id'];
					$page['editor']['result'] = "OK";
				}else{
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
		break;
		case "edit" :
			$titleMsg = "Degree Management | Editing";
			$page['editor']['action'] = "EDIT";
			if(!empty($_POST['operation'])){
				unset($_POST['operation']);
				$rs['upd'] = $db->Execute($sql->update_db("program",$_POST,"program.program_id = '".$_GET['programid']."'")); 
				if($rs['upd']){
					$res['callback']['result'] = "<span>ทำรายการสำเร็จ</span>";
					$res['callback']['idBack'] = $_POST['program_id'];
					$page['editor']['result'] = "OK";
				}else{
					$res['callback']['result'] = "ล้มเหลว";
					$page['editor']['result'] = "FAIL";
					$page['editor']['err_reason'] = $db->ErrorMsg();
				}
				$db->Execute($sql->add_db("system_log",$page['editor']));
			}
			$query['_syllabus'] .= " WHERE program.program_id = '".$_GET['programid']."'";
			$rs['edit'] = $db->Execute($query['_syllabus']);
			while(!$rs['edit']->EOF){
				$row['_editsyll'] = $rs['edit']->fields;
				$rs['edit']->MoveNext();
			}
		break;
		default :
			$currenttemplate = "error404.html";	
		break;
	}
}

//delete union
if(!empty($_POST['deltype'])){
	switch ($_POST['deltype']){
		case sha1(md5("chkpil")) :
			$query['_delchkplan'] = "SELECT
program.program_id,
edu_plan.program_suite,
edu_plan.all_credit
FROM
program
INNER JOIN edu_plan ON edu_plan.program_id = program.program_id
WHERE program.program_id = '".$_POST['programid']."'"; 
			$rs['del'] = $db->Execute($query['_delchkplan']);
			if(!$rs['del']->EOF){
				$res['callback']['result'] = 1;
			}else{
				$res['callback']['result'] = 0;
			}
			echo json_encode($res['callback']);
		break;
		case sha1(md5("confirmdel")) :
			$rs['del'] = $db->Execute($sql->del("program","program.program_id ='".$_POST['programid']."'"));
			if($rs['del']->EOF){
				$res['callback']['result'] = 1;
			}else{
				$res['callback']['result'] = 0;
			}
			echo json_encode($res['callback']);
		break;
		case sha1(md5("nocreditdel")) :
			$rs['del'] = $db->Execute($sql->del("no_credit_course","course_id ='".$_POST['course_id']."' AND Graduate_ID = '".$_POST['Graduate_ID']."'"));
			if($rs['del']->EOF){
				$res['callback']['result'] = 1;
			}else{
				$res['callback']['result'] = 0;
			}
			echo json_encode($res['callback']);
		break;
		case sha1(md5("plandel")) :
			$rs['del'] = $db->Execute($sql->del("edu_plan","id =".$_POST['edu_plan_id']));
			if($rs['del']->EOF){
				$res['callback']['result'] = 1;
			}else{
				$res['callback']['result'] = 0;
			}
			echo json_encode($res['callback']);
		break;
	}
	exit();
}
if(!empty($_POST['chktype'])){
	switch($_POST['chktype']){
		case "plan" :
		$_POST['chkdata'] = explode(',',$_POST['chkdata']);
			$query['_plan'] .= " WHERE edu_plan.program_suite = '".$_POST['chkdata'][0]."' AND program.program_id = '".$_POST['chkdata'][1]."'";
			$rs['chk'] = $db->Execute($query['_plan']);
				if($rs['chk']->EOF){
					echo "OK";
				}else{
					echo '<font color="red">ไม่สามารถใช้ชื่อ <STRONG>'.$_POST['chkdata'][0].'</STRONG> นี้ได้</font>';
				}
			exit();
		break;
		case "syllabus":
			$query['_syllabus'] .= " WHERE program.program_id = '".$_POST['chkdata']."'";
			$rs['chk'] = $db->Execute($query['_syllabus']);
				if($rs['chk']->EOF){
					echo "OK";
				}else{
					echo '<font color="red">ไม่สามารถใช้ชื่อ <STRONG>'.$_POST['chkdata'].'</STRONG> นี้ได้</font>';
				}

			exit();
		break;
	}
		
}
if(!empty($_POST['majorAppend'])){
	$query['_major'] .= " AND major.major_id = ".$_POST['major_id'];
	$res['callback']['result'] = $db->Execute($query['_major'])->fields;
	echo json_encode($res['callback']);
	exit();
}

?>