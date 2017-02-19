<?php
$currenttemplate = "chk_transcript.html";

$page['view'] = "list";
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
graduate_personal.Identification,
graduate_personal.School_Year,
graduate_personal.Semester,
graduate_personal.Minor,
graduate_personal.How_study,
graduate_personal.Educational,
graduate_personal.edu_plan_id,
graduate_personal.Adviser,
graduate_personal.admit_academic_date,
graduate_personal.Committee1,
graduate_personal.Committee2,
graduate_personal.Committee3,
graduate_personal.Committee4,
graduate_personal.Graduated,
graduate_personal.`Status`,
graduate_personal.Brithday,
graduate_personal.Province,
graduate_personal.Nationality,
graduate_personal.Religion,
graduate_personal.Blood,
graduate_personal.Relationship,
graduate_personal.Gender,
graduate_personal.Email,
graduate_personal.Address,
graduate_personal.Title_Father_Name_Thai,
graduate_personal.Father_Name_Thai,
graduate_personal.Father_Lastname_Thai,
graduate_personal.Title_Mother_Name_Thai,
graduate_personal.Mother_Name_Thai,
graduate_personal.Mother_Lastname_Thai,
graduate_personal.Phone,
graduate_personal.Moblie_Phone,
graduate_personal.Time_Add
FROM
graduate_personal
INNER JOIN edu_plan ON graduate_personal.edu_plan_id = edu_plan.id
INNER JOIN program ON edu_plan.program_id = program.program_id
INNER JOIN major ON program.major_id = major.major_id
INNER JOIN degree_level ON program.degree_level_id = degree_level.id
INNER JOIN faculty ON major.fac_id = faculty.fac_id";
$rs['sel'] = $db->Execute($query['gradInfo']);
while(!$rs['sel']->EOF){
	$row['all'][] = $rs['sel']->fields;
	$rs['sel']->MoveNext();
}

if($segment[2] ==="docsexport"){
	$query['gradInfo'].= " WHERE graduate_personal.Graduate_ID = '".$segment[4]."'";
	$rs['sel'] = $db->Execute($query['gradInfo']);
	while(!$rs['sel']->EOF){
		$gradInfo = $rs['sel']->fields;
		$gradInfo['Brithday'] = DateThai($rs['sel']->fields['Brithday']);
		$gradInfo['admit_academic_date'] = DateThai($rs['sel']->fields['admit_academic_date']);
		$rs['sel']->MoveNext();
	}
	
	/*GETTING ENROLL DATA*/
	/*QUERY DATA FOR LEFT TABLE (MAIN COURSE PART)*/
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
plan_structure.course_type_credit,
course.course_idEN,
course.course_nameEN
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
 WHERE graduate_personal.Graduate_ID ='".$segment[4]."'
 ";
 $multiply_grade = array();
 $rs['sel'] = $db->Execute($query['_reg']);
	while(!$rs['sel']->EOF){
		$row['_reg'][$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields;

		$row['_c_t_credit'][$rs['sel']->fields['course_type_nameTH']] = $rs['sel']->fields['course_type_credit'];
		switch($rs['sel']->fields['result_grade']){
			case "A":
			$multiply_grade[$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields['credit']*4;
			break;
			case "B+":
			$multiply_grade[$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields['credit']*3.5;
			break;
			case "B":
			$multiply_grade[$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields['credit']*3;
			break;
			case "C+":
			$multiply_grade[$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields['credit']*2.5;
			break;
			case "C":
			$multiply_grade[$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields['credit']*2;
			break;
			case "D+":
			$multiply_grade[$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields['credit']*1.5;
			break;
			case "D":
			$multiply_grade[$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields['credit']*1;
			break;
			case "F":
			$multiply_grade[$rs['sel']->fields['course_type_nameTH']][] = $rs['sel']->fields['credit']*0;
			break;
		}
		
		$rs['sel']->MoveNext();
	}

/*QUERY DATA FOR LEFT TABLE (EXAMINATION PART)*/
$query = array();
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
					 WHERE term_register.Graduate_ID ='".$segment[4]."'";	
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
					 WHERE term_register.Graduate_ID ='".$segment[4]."'";
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
					term_register.Graduate_ID,
					graduate_examination.exan_name,
					graduate_examination.`status`,
					graduate_examination.id  AS grad_exam_id,
					graduate_examination.term_register_id,
					examination_result_qe.qe_date
					FROM
					examination_result_qe
					INNER JOIN graduate_examination ON examination_result_qe.graduate_examination_id = graduate_examination.id
					INNER JOIN term_register ON graduate_examination.term_register_id = term_register.id
					 WHERE term_register.Graduate_ID ='".$segment[4]."'";
$key = array_keys($query);
for($i=0;$i<count($query);$i++){
	$rs[$i] = $db->Execute($query[$key[$i]]);
	while(!$rs[$i]->EOF){
		$row[$key[$i]][]=$rs[$i]->fields;
		$rs[$i]->MoveNext();
	}
}
/*GETTING ENROLL DATA*/
/*QUERY DATA FOR RIGHT TABLE (NO COURSE CREDIT PART)*/
$query['ncrd'] = "SELECT
graduate_personal.Graduate_ID,
course.course_id,
course.course_name,
no_credit_course.id AS no_credit_course_id,
no_credit_course.result_grade,
term_register.term,
term_register.years,
course.credit
FROM
no_credit_course
INNER JOIN graduate_personal ON no_credit_course.Graduate_ID = graduate_personal.Graduate_ID
INNER JOIN course ON no_credit_course.course_id = course.course_id
INNER JOIN term_register ON term_register.id = no_credit_course.term_register_id
 WHERE graduate_personal.Graduate_ID = '".$segment[4]."'";
	$rs['sel'] = $db->Execute($query['ncrd']);
	while(!$rs['sel']->EOF){
		$row['ncrd'][]=$rs['sel']->fields;
		$rs['sel']->MoveNext();
	}
	
//print_r($row['_reg']); 
	require_once(ROOT_DIR."/modules/chk/transcript/docsexport.php");
	exit();
}



?>