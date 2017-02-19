<?php
$currenttemplate = "chk_track.html";
$titleMsg = "ติดตามผลการศึกษา";

//$page['gradID'] = $_GET['graduateid'];

$page['view'] = "main";
$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','tracking')");
$binGPAX=array();
$binSchool_Years =array();
$query['gradInfo'] = "SELECT
graduate_personal.Graduate_ID,
concat(graduate_personal.Title_Name,
graduate_personal.Graduate_Name,' ',
graduate_personal.Graduate_Lastname) AS stdName,
CONCAT(graduate_personal.Title_Name_English,'.',
graduate_personal.Graduate_Name_English,' ',
graduate_personal.Graduate_Lastname_English) AS stdNameEN,
graduate_personal.image,
CONCAT(program.program_id,':',program.program_name,' สาขา',major.major_name,' ',edu_plan.program_suite) AS edu_program,
CONCAT(degree_level.degree_level_name,' ',degree_level.type) AS degree_name,
graduate_personal.graduate_status,
edu_plan.program_suite,
program.program_id,
program.program_name,
major.major_name,
edu_plan.program_suite,
faculty.fac_name,
graduate_personal.School_Year,
degree_level.degree_level_name
FROM
graduate_personal
INNER JOIN edu_plan ON graduate_personal.edu_plan_id = edu_plan.id
INNER JOIN program ON edu_plan.program_id = program.program_id
INNER JOIN major ON program.major_id = major.major_id
INNER JOIN degree_level ON program.degree_level_id = degree_level.id
INNER JOIN faculty ON major.fac_id = faculty.fac_id";
$rs['sel'] = $db->Execute($query['gradInfo']);
$res['graduateID'] = $segment[3];
while(!$rs['sel']->EOF){
	$row['all'][] = $rs['sel']->fields;
	$binSchool_Years = $rs['sel']->fields['School_Year'];
	$rs['sel']->MoveNext();
}

if($segment[2]==="graduatecheck"){
	$page['view'] = "graduatecheck";
	/*สร้างข้อมูลของนักศึกษา*/
	$query['gradInfo'].= " WHERE graduate_personal.Graduate_ID ='".$segment[3]."'";
	$query['eduInfo'] = "SELECT
edu_plan.program_suite,
graduate_personal.Graduate_ID,
graduate_personal.School_Year,
program.program_name,
program.program_id,
program.years_normal,
program.max_years,
program.minimum_gpa,
edu_plan.all_credit
FROM
graduate_personal
INNER JOIN edu_plan ON graduate_personal.edu_plan_id = edu_plan.id
INNER JOIN program ON program.program_id = edu_plan.program_id  WHERE graduate_personal.Graduate_ID ='".$segment[3]."'";
	$query['_plan'] = "SELECT
graduate_personal.Graduate_ID,
edu_plan.program_suite,
edu_plan.all_credit,
course_type.course_type_nameTH,
course.course_id,
course.course_name,
course.credit,
plan_structure.course_type_credit,
course_type.required_type
FROM
graduate_personal
INNER JOIN edu_plan ON graduate_personal.edu_plan_id = edu_plan.id
INNER JOIN plan_structure ON edu_plan.id = plan_structure.edu_plan_id
INNER JOIN course_type ON plan_structure.course_type_id = course_type.id
INNER JOIN course_plan_structure ON plan_structure.struc_id = course_plan_structure.struc_id
INNER JOIN course ON course_plan_structure.course_id = course.course_id WHERE graduate_personal.Graduate_ID ='".$segment[3]."'";
	$query['_reg'] = "SELECT
graduate_personal.Graduate_ID,
edu_plan.program_suite,
edu_plan.all_credit,
course_type.course_type_nameTH,
course.course_id,
course.course_name,
term_register.term,
term_register.years,
course_section.section,
graduate_result.result_grade,
graduate_result.raw_point,
course.credit,
course_type.required_type
FROM
graduate_personal
INNER JOIN edu_plan ON graduate_personal.edu_plan_id = edu_plan.id
INNER JOIN plan_structure ON edu_plan.id = plan_structure.edu_plan_id
INNER JOIN course_type ON plan_structure.course_type_id = course_type.id
INNER JOIN course_plan_structure ON plan_structure.struc_id = course_plan_structure.struc_id
INNER JOIN course ON course_plan_structure.course_id = course.course_id
INNER JOIN term_register ON graduate_personal.Graduate_ID = term_register.Graduate_ID
INNER JOIN graduate_enroll ON term_register.id = graduate_enroll.term_register_id
INNER JOIN course_section ON graduate_enroll.course_section_id = course_section.id AND course_section.course_id = course.course_id
INNER JOIN graduate_result ON graduate_enroll.enroll_id = graduate_result.enroll_id
 WHERE graduate_personal.Graduate_ID ='".$segment[3]."'";
$query['_reg_nocredit'] = "SELECT
no_credit_course.result_grade,
course.course_id,
course.course_name,
term_register.term,
term_register.years,
graduate_personal.Graduate_ID,
course.credit
FROM
no_credit_course
INNER JOIN graduate_personal ON no_credit_course.Graduate_ID = graduate_personal.Graduate_ID
INNER JOIN course ON no_credit_course.course_id = course.course_id
INNER JOIN term_register ON term_register.id = no_credit_course.term_register_id
 WHERE graduate_personal.Graduate_ID ='".$segment[3]."'";
$query['_schoolyear'] = "SELECT
graduate_personal.Graduate_ID,
(term_register.years-graduate_personal.School_Year)+1 AS School_Year
FROM
graduate_personal
INNER JOIN term_register ON term_register.Graduate_ID = graduate_personal.Graduate_ID
 WHERE graduate_personal.Graduate_ID ='".$segment[3]."'";
$query['_exam_ce'] = "SELECT
					IF(graduate_examination.status=1,'สอบแล้ว',IF(graduate_examination.status=0,'ยังไม่สอบ','ไม่ชำระเงิน')) AS status1,
					term_register.term,
					term_register.years,
					term_register.Graduate_ID,
					graduate_examination.exan_name,
					examination_result_ce.ce_num,
					examination_result_ce.ce_date,
					examination_result_ce.ce_result,
					graduate_examination.`status`,
					graduate_examination.id AS grad_exam_id,
					graduate_examination.term_register_id,
					examination_result_ce.id  AS ce_id,
					examination_result_ce.ce_result_writing,
					examination_result_ce.ce_result_oral,
					examination_result_ce.ce_result_lab,
					examination_result_ce.graduate_examination_id
					FROM
					term_register
					INNER JOIN graduate_examination ON term_register.id = graduate_examination.term_register_id
					INNER JOIN examination_result_ce ON graduate_examination.id = examination_result_ce.graduate_examination_id 
					 WHERE term_register.Graduate_ID ='".$segment[3]."'";	
$query['_exam_fe'] = "SELECT
					IF(graduate_examination.status=1,'สอบแล้ว',IF(graduate_examination.status=0,'ยังไม่สอบ','ไม่ชำระเงิน')) AS status1,
					term_register.term,
					term_register.years,
					examination_result_fe.id  AS fe_id,
					examination_result_fe.fe_result,
					examination_result_fe.fe_raw_result,
					examination_result_fe.fe_num,
					examination_result_fe.fe_resulted_form,
					examination_result_fe.fe_date,
					examination_result_fe.graduate_examination_id,
					graduate_examination.exan_name,
					graduate_examination.`status`,
					graduate_examination.id  AS grad_exam_id,
					graduate_examination.term_register_id,
					term_register.Graduate_ID
					FROM
					term_register
					INNER JOIN graduate_examination ON term_register.id = graduate_examination.term_register_id
					INNER JOIN examination_result_fe ON graduate_examination.id = examination_result_fe.graduate_examination_id
					 WHERE term_register.Graduate_ID ='".$segment[3]."'";
$query['_exam_qe'] = "SELECT
		IF(graduate_examination.status=1,'สอบแล้ว',IF(graduate_examination.status=0,'ยังไม่สอบ','ไม่ชำระเงิน')) AS status1,
		examination_result_qe.id AS qe_id,
		examination_result_qe.graduate_examination_id,
		examination_result_qe.qe_result,
		examination_result_qe.qe_num,
		examination_result_qe.qe_committee_list,
		examination_result_qe.qe_result_writing,
		examination_result_qe.qe_result_oral,
		term_register.term,
		term_register.years,
		graduate_examination.exan_name,
		graduate_examination.`status`,
		graduate_examination.id AS grad_exam_id,
		graduate_examination.term_register_id,
		examination_result_qe.qe_date,
		term_register.Graduate_ID,
		degree_level.degree_level_name
		FROM
		examination_result_qe
		INNER JOIN graduate_examination ON examination_result_qe.graduate_examination_id = graduate_examination.id
		INNER JOIN term_register ON graduate_examination.term_register_id = term_register.id
		INNER JOIN graduate_personal ON term_register.Graduate_ID = graduate_personal.Graduate_ID
		INNER JOIN edu_plan ON edu_plan.id = graduate_personal.edu_plan_id
		INNER JOIN program ON edu_plan.program_id = program.program_id
		INNER JOIN degree_level ON program.degree_level_id = degree_level.id
		 WHERE term_register.Graduate_ID ='".$segment[3]."'";	
$res['_reg_nocredit']['result'] = true;
$res['_exam_fe']['result'] = true;
$res['_exam_ce']['result'] = true;
$res['_exam_qe']['result'] = true;
$z=0;
	$key = array_keys($query);
	for($i=0;$i<count($query);$i++){
		if($key[$i] == "_plan"){
			$rs['sel'] = $db->Execute($query['_plan']);
			while(!$rs['sel']->EOF){
				$row['_plan'][$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields;
				if($rs['sel']->fields['required_type'] ==1 || $rs['sel']->fields['required_type'] == 2){
				$row['_plandetails'][$rs['sel']->fields['course_type_nameTH']]['ct_credit'] += $rs['sel']->fields['credit'];
				}else{
				$row['_plandetails'][$rs['sel']->fields['course_type_nameTH']]['ct_credit'] = $rs['sel']->fields['course_type_credit'];
				}
				$rs['sel']->MoveNext();
			}
		}elseif($key[$i] == "_reg"){
			$rs['sel'] = $db->Execute($query['_reg']);
			while(!$rs['sel']->EOF){
				$row['_reg'][$rs['sel']->fields['course_id']] = $rs['sel']->fields;
				$row['_reg_new'][$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields;
				$row['_plandetails'][$rs['sel']->fields['course_type_nameTH']]['_reged'] += $rs['sel']->fields['credit'];
				
				if($rs['sel']->fields['result_grade'] !="F" && $rs['sel']->fields['result_grade']!="I" && $rs['sel']->fields['result_grade']!="OP"){
					$row['_pass_credit'] += $rs['sel']->fields['credit'];
					$row['_plandetails'][$rs['sel']->fields['course_type_nameTH']]['_pass'] += $rs['sel']->fields['credit'];				
				}else{
					$row['_plandetails'][$rs['sel']->fields['course_type_nameTH']]['_pass'] = 0;	
				}
				
				$rs['sel']->MoveNext();
			}
		}elseif($key[$i] == "_exam_ce"){
			$rs['sel'] = $db->Execute($query['_exam_ce']);
			$z=0;
			while(!$rs['sel']->EOF){
				$row['_exam_ce'][] = $rs['sel']->fields;
				$row['_exam_ce'][$z]['ce_date'] = DateThai_spl($rs['sel']->fields['ce_date']);
				if($rs['sel']->fields['ce_result'] === "U"){
					$res['_exam_qe']['result']  = false;
				}
				$rs['sel']->MoveNext();
				$z++;
			}
		}elseif($key[$i] == "_exam_fe"){
				$rs['sel'] = $db->Execute($query['_exam_fe']);
				$z=0;
			while(!$rs['sel']->EOF){
				$row['_exam_fe'][] = $rs['sel']->fields;
				$row['_exam_fe'][$z]['fe_date'] = DateThai_spl($rs['sel']->fields['fe_date']);
				if($rs['sel']->fields['fe_result'] === "U"){
					$res['_exam_fe']['result']  = false;
				}
				$rs['sel']->MoveNext();
				$z++;
			}
		}elseif($key[$i] == "_exam_qe"){
				$rs['sel'] = $db->Execute($query['_exam_qe']);
				$z=0;
			while(!$rs['sel']->EOF){
				$row['_exam_qe'][] = $rs['sel']->fields;
				$row['_exam_qe'][$z]['qe_date'] = DateThai_spl($rs['sel']->fields['qe_date']);
				if($rs['sel']->fields['qe_result'] === "U" && $rs['sel']->fields['degree_level_name'] === "ปริญญาเอก"){
					$res['_exam_qe']['result']  = false;
				}
				$rs['sel']->MoveNext();
				$z++;
			}
		}elseif($key[$i] == "_reg_nocredit"){
				$rs['sel'] = $db->Execute($query['_reg_nocredit']);
				$z=0;
			while(!$rs['sel']->EOF){
				$row['_reg_nocredit'][] = $rs['sel']->fields;
				
				if($rs['sel']->fields['result_grade'] === "U"){
					$res['_reg_nocredit']['result']  = false;
				}
	
				
				$rs['sel']->MoveNext();
			}
		}else{
			$rs[$i] = $db->Execute($query[$key[$i]]);
			while(!$rs[$i]->EOF){
				$page[$key[$i]]=$rs[$i]->fields;
				$rs[$i]->MoveNext();
			}
		}
	}
	//print_r($row);
	if(!empty($row['_reg'])){
		foreach($row['_reg'] as $key=>$item){
			if(($item['course_name'] != "วิทยานิพนธ์")&&($item['course_name'] != "ดุษฎีนิพนธ์")){
				$binGPAX[$item['term']."/".$item['years']]['credit'] += $item['credit'];
				switch($item['result_grade']){
					case "A":
					$binGPAX[$item['term']."/".$item['years']]['GP'] += $item['credit']*4;
					break;
					case "B+":
					$binGPAX[$item['term']."/".$item['years']]['GP'] += $item['credit']*3.5;
					break;
					case "B":
					$binGPAX[$item['term']."/".$item['years']]['GP'] += $item['credit']*3;
					break;
					case "C+":
					$binGPAX[$item['term']."/".$item['years']]['GP'] += $item['credit']*2.5;
					break;
					case "C":
					$binGPAX[$item['term']."/".$item['years']]['GP'] += $item['credit']*2;
					break;
					case "D+":
					$binGPAX[$item['term']."/".$item['years']]['GP'] += $item['credit']*1.5;
					break;
					case "D":
					$binGPAX[$item['term']."/".$item['years']]['GP'] +=$item['credit']*1;
					break;
					case "F":
					$binGPAX[$item['term']."/".$item['years']]['GP'] += $item['credit']*0;
					break;
					default :
					$binGPAX[$item['term']."/".$item['years']]['GP'] += 0;
					break;
				}
			}
		}
	}
	$row['_gpax'] = 0.00;
	foreach($binGPAX as $keyGPAX=>$itemGPAX){
		$term_count++;
		$temp += $itemGPAX['GP']/$itemGPAX['credit'];
		$row['_gpax'] = number_format($temp/$term_count,2);
		$binGPAX[$keyGPAX]['GPA'] = $row['_gpax'];
	}

	$findmax = array();
	$findmax['ce'] = (isset($row['_exam_ce'])) ? max($row['_exam_ce']) : null;
	$findmax['qe'] = (isset($row['_exam_qe'])) ? max($row['_exam_qe']) : null;
	$findmax['fe'] = (isset($row['_exam_fe'])) ? max($row['_exam_fe']) : null;

	if($page['gradInfo']['degree_level_name'] === "ปริญญาเอก"){
		if(isset($row['_exam_ce']) && $findmax['ce']['ce_result'] === "S"){
			if(isset($row['_exam_fe']) && $findmax['fe']['fe_result'] === "S"){
				if(isset($row['_exam_qe']) && $findmax['qe']['qe_result'] === "S"){
					$row['examresult'] = 1;
				}else{
					$row['examresult'] = 0;
				}
			}else{
				$row['examresult'] = 0;
			}
		}else{
			$row['examresult'] = 0;
		}
	}else{
		if(isset($row['_exam_ce'])){
			if(isset($row['_exam_fe'])){
				$row['examresult'] = 1;
			}else{
				$row['examresult'] = 0;
			}
		}else{
			$row['examresult'] = 0;
		}
	}
	if($segment[3]==="updatefront"){
		$db->Execute($sql->update("graduate_personal","graduate_status = ".$_POST['statusGrad'],"Graduate_ID = '".$_POST['graduateID']."'"));
	}
}

//print_r($row);
	
	
	
	
?>