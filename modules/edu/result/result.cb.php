<?php
$currenttemplate = "result.html";
$titleMsg = "Result Management";


$page['user'] = $_SESSION;
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] = "url :".$_SERVER[HTTP_HOST].$_SERVER['REQUEST_URI']."<br>".
							"modules : ".$segment[1]."<br>".
							"data : ";
							while($element = each($_POST)){
								$page['editor']['detail'] .= $element["key"]."=>".$element["value"].",";
							}
$page['editor']['whoaction'] = $_SESSION['nameTH'];
$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','result and examination')");
//SQL STORE
$page['view'] = "main";
// SELECT SEMESTER
$rs['sel'] = $db->Execute("SELECT DISTINCT
term_register.term,
term_register.years,
term_register.calc_resulted
FROM
term_register ORDER BY term_register.years DESC");
while(!$rs['sel']->EOF){
	$row['_semester'][]= $rs['sel']->fields;
	$rs['sel']->MoveNext();
}
//แยก term กับปีออก
$row['splitterm'] = explode("/",$_POST['term_semester']);
$row['splitterm'][0] = trim($row['splitterm'][0]);
$row['splitterm'][1]-= 543; 

if(!empty($row['splitterm'][0])){
$_SESSION['termyears'] = $row['splitterm'];
}
$row['_storeGrade'] = array("A","B+","B","C+","C","D+","D","F","I","W","OP","S","U");
$row['_storeGrade_ncrd'] = array("S","U","OP","I");
if(!empty($segment[2])){
	switch ($segment[2]){
		case "study":
			$page['view'] = "study";
			$query['_termStd'] .= "SELECT
			CONCAT (graduate_personal.Title_Name,
					graduate_personal.Graduate_Name,' ',
					graduate_personal.Graduate_Lastname) AS stdName,
			graduate_personal.Graduate_ID,
			CONCAT (graduate_personal.Title_Name_English,'.',
					graduate_personal.Graduate_Name_English,' ',
					graduate_personal.Graduate_Lastname_English) AS stdNameEN,
			term_register.id,
			term_register.years,
			term_register.term,
			edu_plan.program_suite,
			program.program_name,
			degree_level.degree_level_name
			FROM
			term_register
			INNER JOIN graduate_personal ON term_register.Graduate_ID = graduate_personal.Graduate_ID
			INNER JOIN edu_plan ON edu_plan.id = graduate_personal.edu_plan_id
			INNER JOIN program ON edu_plan.program_id = program.program_id
			INNER JOIN degree_level ON program.degree_level_id = degree_level.id
			WHERE term_register.term = ".$_SESSION['termyears'][0]." AND term_register.years ='".$_SESSION['termyears'][1]."'";
			$query['_no_credit'] = "SELECT
			no_credit_course.id,
			no_credit_course.course_id,
			no_credit_course.Graduate_ID,
			no_credit_course.result_grade,
			no_credit_course.term_register_id,
			term_register.term,
			term_register.years,
			term_register.calc_resulted,
			course.course_name,
			course.course_nameEN,
			course.course_idEN,
			course_section.section,
			course.credit
			FROM
			no_credit_course
			INNER JOIN term_register ON term_register.id = no_credit_course.term_register_id
			INNER JOIN course ON course.course_id = no_credit_course.course_id
			INNER JOIN course_section ON course.course_id = course_section.course_id
			 WHERE term_register.term = ".$_SESSION['termyears'][0]." AND term_register.years ='".$_SESSION['termyears'][1]."'";
			$query['_enroll'] = "SELECT
			term_register.term,
			term_register.years,
			course_section.section,
			course.course_id,
			course.course_name,
			graduate_personal.Graduate_ID,
			graduate_enroll.enroll_id,
			course.credit,
			edu_plan.program_suite,
			plan_structure.course_type_id,
			course_type.course_type_nameTH,
			plan_structure.course_type_credit,
			course_plan_structure.semester_1,
			course_plan_structure.semester_2,
			course_plan_structure.semester_3,
			course_plan_structure.years_level,
			edu_plan.all_credit
			FROM
			term_register
			INNER JOIN graduate_enroll ON graduate_enroll.term_register_id = term_register.id
			INNER JOIN course_section ON graduate_enroll.course_section_id = course_section.id
			INNER JOIN course ON course.course_id = course_section.course_id
			INNER JOIN graduate_personal ON term_register.Graduate_ID = graduate_personal.Graduate_ID
			INNER JOIN edu_plan ON graduate_personal.edu_plan_id = edu_plan.id
			INNER JOIN plan_structure ON edu_plan.id = plan_structure.edu_plan_id
			INNER JOIN course_type ON plan_structure.course_type_id = course_type.id
			INNER JOIN course_plan_structure ON plan_structure.struc_id = course_plan_structure.struc_id AND course_plan_structure.course_id = course.course_id
			WHERE term_register.term = ".$_SESSION['termyears'][0]." AND term_register.years ='".$_SESSION['termyears'][1]."'";
			$query['_chkresult'] = "SELECT
			graduate_result.result_grade,
			graduate_enroll.enroll_id,
			term_register.Graduate_ID
			FROM
			term_register
			INNER JOIN graduate_enroll ON graduate_enroll.term_register_id = term_register.id
			INNER JOIN graduate_result ON graduate_enroll.enroll_id = graduate_result.enroll_id
			WHERE term_register.term = ".$_SESSION['termyears'][0]." AND term_register.years ='".$_SESSION['termyears'][1]."'";
			$key = array_keys($query);
			for($i=0;$i<count($query);$i++){
				$rs[$i] = $db->Execute($query[$key[$i]]);
				while(!$rs[$i]->EOF){
					$row[$key[$i]][]=$rs[$i]->fields;
					$rs[$i]->MoveNext();
				}
			}
			switch($segment[3]){
				case "gradeprocess":
					$rs['sel'] = $db->Execute("SELECT * FROM graduate_result WHERE enroll_id = ".$_POST['enroll_id']);
					if($rs['sel']->EOF){
						$res['callback']['result'] = $db->Execute($sql->add_db("graduate_result",
						array("enroll_id"=>$_POST['enroll_id'],
						"result_grade"=>$_POST['grade_val'])))->EOF;
					}else{
						$res['callback']['result'] = $db->Execute($sql->update_db("graduate_result",
						array("result_grade"=>$_POST['grade_val'])," enroll_id = ".$_POST['enroll_id']))->EOF;
					}
						echo json_encode($res['callback']);	
					exit();
				break;
				case "gradeprocess_n":
					$res['callback']['result'] = $db->Execute($sql->update("no_credit_course","result_grade = '".$_POST['grade_val']."'","id = ".$_POST['enroll_id']))->EOF;
					
					echo json_encode($res['callback']);	
					exit();
				break;
			}
		break;
		case "exam":
			$query = array();
			$rs = array();
			$page['view'] = "exam_landing";
			$query['_termStd'] .= "SELECT
			CONCAT (graduate_personal.Title_Name,
					graduate_personal.Graduate_Name,' ',
					graduate_personal.Graduate_Lastname) AS stdName,
			graduate_personal.Graduate_ID,
			CONCAT (graduate_personal.Title_Name_English,'.',
					graduate_personal.Graduate_Name_English,' ',
					graduate_personal.Graduate_Lastname_English) AS stdNameEN,
			term_register.id,
			term_register.years,
			term_register.term,
			edu_plan.program_suite,
			program.program_name,
			degree_level.degree_level_name
			FROM
			term_register
			INNER JOIN graduate_personal ON term_register.Graduate_ID = graduate_personal.Graduate_ID
			INNER JOIN edu_plan ON edu_plan.id = graduate_personal.edu_plan_id
			INNER JOIN program ON edu_plan.program_id = program.program_id
			INNER JOIN degree_level ON program.degree_level_id = degree_level.id
			WHERE term_register.term = ".$_SESSION['termyears'][0]." AND term_register.years ='".$_SESSION['termyears'][1]."'";
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
					WHERE term_register.term = ".$_SESSION['termyears'][0]." AND term_register.years ='".$_SESSION['termyears'][1]."'";	
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
					WHERE term_register.term = ".$_SESSION['termyears'][0]." AND term_register.years ='".$_SESSION['termyears'][1]."'";
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
					WHERE term_register.term = ".$_SESSION['termyears'][0]." AND term_register.years ='".$_SESSION['termyears'][1]."'";
			$key = array_keys($query);
			for($i=0;$i<count($query);$i++){
				$rs[$i] = $db->Execute($query[$key[$i]]);
				while(!$rs[$i]->EOF){
					$row[$key[$i]][]=$rs[$i]->fields;
					$rs[$i]->MoveNext();
				}
			}
			$page['_get'] = $_GET;
			switch ($segment[3]){
				case "cenew":
					$page['view'] = "exam_ce";
					$query['_exam_ce'] .= " AND term_register.Graduate_ID = '".$page['_get']['gradid']."'";
					$res['ce_count'] = $db->Execute($query['_exam_ce'])->RecordCount()+1;
					if(!empty($_POST['operation'])){
						unset($_POST['operation']);
						$rs['ins'] = $db->Execute($sql->add_db("graduate_examination",array("exan_name"=>$_POST['exam_name'],"term_register_id"=>$page['_get']['termid'],"status"=>$_POST['status'])));
						if($rs['ins']){
							unset($_POST['exam_name']);
							unset($_POST['status']);
							$_POST['graduate_examination_id'] = $db->Insert_ID();

							$rs['ins'] = $db->Execute($sql->add_db("examination_result_ce",$_POST));
							if($rs['ins']){
								$res['callback']['result'] = "ทำรายการสำเร็จ";
							}else{
								$res['callback']['result'] =  $db->ErrorMsg();
							}
						}else{
							$res['callback']['result'] = "OUT".$db->ErrorMsg();
						}
					}
					
				break;
				case "fenew":
					$page['view'] = "exam_fe";
					$query['_exam_fe'] .= " AND term_register.Graduate_ID = '".$page['_get']['gradid']."'";
					$res['fe_count'] = $db->Execute($query['_exam_fe'])->RecordCount()+1;
					if(!empty($_POST['operation'])){
						unset($_POST['operation']);
						$rs['ins'] = $db->Execute($sql->add_db("graduate_examination",array("exan_name"=>$_POST['exam_name'],"term_register_id"=>$page['_get']['termid'],"status"=>$_POST['status'])));
						if($rs['ins']){
							unset($_POST['exam_name']);
							unset($_POST['status']);
							$_POST['graduate_examination_id'] = $db->Insert_ID();
							$rs['ins'] = $db->Execute($sql->add_db("examination_result_fe",$_POST));
							if($rs['ins']){
								$res['callback']['result'] = "ทำรายการสำเร็จ";
							}else{
								$res['callback']['result'] =  $db->ErrorMsg();
							}
						}else{
							$res['callback']['result'] = "OUT".$db->ErrorMsg();
						}
					}
				break;
				case "qenew":
					$page['view'] = "exam_qe";
					$query['_exam_qe'] .= " AND term_register.Graduate_ID = '".$page['_get']['gradid']."'";
					$res['qe_count'] = $db->Execute($query['_exam_qe'])->RecordCount()+1;
					if(!empty($_POST['operation'])){
						unset($_POST['operation']);
						$rs['ins'] = $db->Execute($sql->add_db("graduate_examination",array("exan_name"=>$_POST['exam_name'],"term_register_id"=>$page['_get']['termid'],"status"=>$_POST['status'])));
						if($rs['ins']){
							unset($_POST['exam_name']);
							unset($_POST['status']);
							$_POST['graduate_examination_id'] = $db->Insert_ID();
							$rs['ins'] = $db->Execute($sql->add_db("examination_result_qe",$_POST));
							if($rs['ins']){
								$res['callback']['result'] = "Fin";
							}else{
								$res['callback']['result'] =$db->ErrorMsg();
							}
						}else{
							$res['callback']['result'] = $db->ErrorMsg();
					
						}
					}
				break;
				case "ceedit":
					$page['view'] = "exam_ce";
				
					if(!empty($_POST['operation'])){
						unset($_POST['operation']);
						$rs['upd'] = $db->Execute($sql->update_db("graduate_examination",
						array("exan_name"=>$_POST['exam_name'],
							"status"=>$_POST['status']),"id = ".$_POST['grad_exam_id']));	
						if($rs['upd']->EOF){
							$ce_id = $_POST['ce_id'];
							unset($_POST['exam_name'],$_POST['status'],$_POST['grad_exam_id'],$_POST['ce_id']);
							$rs['upd'] = $db->Execute($sql->update_db("examination_result_ce",$_POST,"id = $ce_id"));	
							if($rs['upd']->EOF){
								$res['callback']['result'] = "Fin";
							}else{
								$res['callback']['result'] = "ERROR";
							}
						}else{
							$res['callback']['result'] = $sql->update_db("graduate_examination",
						array("exan_name"=>$_POST['exam_name'],
							"status"=>$_POST['status']),"id = ".$_POST['grad_exam_id']);
						}
					}
					$query['_exam_ce'] .= " AND term_register.Graduate_ID = '".$page['_get']['gradid']."' AND examination_result_ce.id = ".$page['_get']['termid'];
					$row['_exam_ce'] = $db->Execute($query['_exam_ce'])->fields;
					//print_r($query);
				break;
				case "feedit":
					$page['view'] = "exam_fe";
										
					if(!empty($_POST['operation'])){
						unset($_POST['operation']);
						$rs['upd'] = $db->Execute($sql->update_db("graduate_examination",array("exan_name"=>$_POST['exam_name'],
						"status"=>$_POST['status']),"id = ".$_POST['grad_exam_id']));
						
						if($rs['upd']->EOF){
							$fe_id = $_POST['fe_id'];
							unset($_POST['exam_name'],$_POST['status'],$_POST['grad_exam_id'],$_POST['fe_id']);
							$rs['upd'] = $db->Execute($sql->update_db("examination_result_fe",$_POST,"id = $fe_id"));
							if($rs['upd']->EOF){
								$res['callback']['result'] = "ืำรายการสำเร็จ";
							}else{
								$res['callback']['result'] = $db->ErrorMsg();
							}
						}else{
							$res['callback']['result'] = $db->ErrorMsg();
						}
					}
					$query['_exam_fe'] .= " AND term_register.Graduate_ID = '".$page['_get']['gradid']."'";
					$row['_exam_fe'] = $db->Execute($query['_exam_fe'])->fields;
				break;
				case "qeedit":
					$page['view'] = "exam_qe";
						
					if(!empty($_POST['operation'])){
						unset($_POST['operation']);
						$rs['upd'] = $db->Execute($sql->update_db("graduate_examination",array("exan_name"=>$_POST['exam_name'],
						"status"=>$_POST['status']),"id = ".$_POST['grad_exam_id']));
						
						if($rs['upd']->EOF){
							$qe_id = $_POST['qe_id'];
							unset($_POST['exam_name'],$_POST['status'],$_POST['grad_exam_id'],$_POST['qe_id']);
							$rs['upd'] = $db->Execute($sql->update_db("examination_result_qe",$_POST,"id = $qe_id"));
							if($rs['upd']->EOF){
								$res['callback']['result'] = "ทำรายการสำเร็จ";
							}else{
								$res['callback']['result'] = $db->ErrorMsg()."1";
							}
						}else{
							$res['callback']['result'] = $db->ErrorMsg()."2";
						
						}
					}
					$query['_exam_qe'] .= " AND term_register.Graduate_ID = '".$page['_get']['gradid']."'";
					//$res['qe_count'] = $db->Execute($query['_exam_qe'])->RecordCount()+1;
					$row['_exam_qe'] = $db->Execute($query['_exam_qe'])->fields;
				break;
			}
		break;
		default : $currenttemplate = "error404.html";
	}
}
?>