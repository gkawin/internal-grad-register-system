<?php
$currenttemplate = "trackresult.html";
$titleMsg = "Tracking Result | Checker Management";

$page['view'] = "list";
$query = "SELECT
graduate_prosonal.Graduate_ID,
graduate_prosonal.Title_Name,
graduate_prosonal.Graduate_Name,
graduate_prosonal.Graduate_Lastname,
program.program_name,
edu_plan.all_credit,
edu_plan.program_suite AS plan,
program.years_normal,
program.max_years,
program.minimum_gpa,
graduate_prosonal.Title_Name_English,
graduate_prosonal.Graduate_Name_English,
graduate_prosonal.Graduate_Lastname_English,
graduate_prosonal.graduate_status,
graduate_prosonal.image,
major.major_name,
faculty.fac_name
FROM
graduate_prosonal
Inner Join edu_plan ON graduate_prosonal.plan = edu_plan.id
Inner Join program ON edu_plan.program_id = program.program_id
Inner Join major ON major.major_id = graduate_prosonal.Major
Inner Join faculty ON major.faculty_id = faculty.fac_id";
$rs = $db->Execute($query);
while(!$rs->EOF){
	$page['all'][] = $rs->fields;
	$rs->MoveNext();
}

if($segment[2] === "view"){
	$page['view'] = "viewResult";

$query_viewResult = "SELECT
graduate_prosonal.Title_Name,
graduate_prosonal.Graduate_Name,
graduate_prosonal.Graduate_Lastname,
course_taked.term,
course_taked.`year`,
course_section.section,
graduate_prosonal.Graduate_ID,
graduate_result.result_grade,
graduate_result.raw_point,
graduate_result.extra_point,
course.credit,
course.course_id,
course.course_name
FROM
graduate_prosonal
Inner Join course_taked ON course_taked.Graduate_ID = graduate_prosonal.Graduate_ID
Inner Join course_section ON course_taked.course_section_id = course_section.id
Inner Join graduate_result ON graduate_result.take_id = course_taked.take_id
Inner Join course ON course_section.course_id = course.course_id WHERE graduate_prosonal.Graduate_ID = '".$_GET['graduateid']."'";
$rs_viewResult = $db->Execute($query_viewResult);
while(!$rs_viewResult->EOF){
	$page['_viewResult'][] = $rs_viewResult->fields;
	$rs_viewResult->MoveNext();
}
$total =0;
foreach($page['_viewResult'] as $token){
	
	
	$page['sumCredit'] += $token['credit'];
	if($token['result_grade']==="A"){
	$page['resultStr_int'][] = 4*($token['credit']);
	}elseif($token['result_grade']==="B+"){
	$page['resultStr_int'][] = 3.5*($token['credit']);
	}
	elseif($token['result_grade']==="B"){
	$page['resultStr_int'][] = 3*($token['credit']);
	}
	elseif($token['result_grade']==="C+"){
	$page['resultStr_int'][] = 2.5*($token['credit']);
	}
	elseif($token['result_grade']==="C"){
	$page['resultStr_int'][] = 2*($token['credit']);
	}
	elseif($token['result_grade']==="D+"){
	$page['resultStr_int'][] = 1.5*($token['credit']);
	}
	elseif($token['result_grade']==="D"){
	$page['resultStr_int'][] = 1*($token['credit']);
	}
	elseif($token['result_grade']==="F"){
	$page['resultStr_int'][] = 0*($token['credit']);
	}
	if($token['result_grade']==null){
		$page['earn'] = $page['sumCredit'] - $token['credit'];
	}else{
		$page['earn'] = $page['sumCredit'];
	}

}
	for($i=0;$i<=count($page['resultStr_int']);$i++){
		$total += $page['resultStr_int'][$i];
	}

	@$page['finalGrade'] = $total / $page['sumCredit'];
}

if(!empty($_GET['cmd'])&&$_GET['cmd'] == sha1("MaEJo_SeLF_AccEss")){
		$currenttemplate = "trackresult_access.html";
	}

?>