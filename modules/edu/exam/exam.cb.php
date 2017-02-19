<?php
$currenttemplate = "exam.html";
$titleMsg = "Examination Result Management";
$page['view'] = "list";
$query['_gradList'] = "SELECT
edu_plan.program_suite,
program.program_name,
major.major_name,
faculty.fac_name,
graduate_personal.Graduate_ID,
graduate_personal.Title_Name,
graduate_personal.Graduate_Name,
graduate_personal.Graduate_Lastname,
graduate_personal.graduate_status
FROM
graduate_personal
Inner Join edu_plan ON edu_plan.id = graduate_personal.edu_plan_id
Inner Join program ON edu_plan.program_id = program.program_id
Inner Join major ON major.major_id = graduate_personal.Major
Inner Join faculty ON major.fac_id = faculty.fac_id";
$key = array_keys($query);
for($i=0;$i<count($query);$i++){
	$rs[$i] = $db->Execute($query[$key[$i]]);
	while(!$rs[$i]->EOF){
		$page[$key[$i]][]=$rs[$i]->fields;
		$rs[$i]->MoveNext();
	}
}
?>