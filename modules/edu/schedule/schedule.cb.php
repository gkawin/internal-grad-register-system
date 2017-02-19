<?php
$currenttemplate = "schedule.html";
$titleMsg = "View Schedule";

$page['view'] = "list";

$query_gradinfo = "SELECT
DISTINCT course.course_id,
edu_plan.program_suite,
program.program_name,
major.major_name,
faculty.fac_name,
graduate_personal.Graduate_ID,
graduate_personal.Title_Name,
graduate_personal.Graduate_Name,
graduate_personal.Graduate_Lastname,
graduate_personal.graduate_status,
course_take_term.term,
course_take_term.years,
course_take_term.calc_resulted,
course_section.section,
course.course_name,
course_section.date_midexam,
course_section.date_finalexam
FROM
graduate_personal
Inner Join edu_plan ON edu_plan.id = graduate_personal.edu_plan_id
Inner Join program ON edu_plan.program_id = program.program_id
Inner Join major ON major.major_id = graduate_personal.Major
Inner Join faculty ON major.fac_id = faculty.fac_id
Inner Join course_take_term ON course_take_term.Graduate_ID = graduate_personal.Graduate_ID
Inner Join section_room_take_term ON course_take_term.id = section_room_take_term.term_id
Inner Join section_room_use ON section_room_take_term.section_room_id = section_room_use.id
Inner Join course_section ON section_room_use.course_section_id = course_section.id
Inner Join course ON course_section.course_id = course.course_id";
$query = "SELECT
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
$rs = $db->Execute($query);
while(!$rs->EOF){
	$page['all'][] = $rs->fields;
	$rs->MoveNext();
}
if($segment[2]==="view"){
	$page['view'] = "schedule";
	$query_gradinfo .= " WHERE graduate_personal.Graduate_ID = '".$_GET['graduateid']."'";
	$rs = $db->Execute($query_gradinfo);
$i=0;
	while(!$rs->EOF){
	$page['_gradinfo'] = $rs->fields;
	$page['itemSemester'][] = $rs->fields['term']."/".$rs->fields['years'];
	$page['classinfo'][] = array_unique($rs->fields);
	$rs->MoveNext();
	$i++;
	}

	//print_r($page['itemSemester']);
/*	//$i = $page['_gradinfo']['years'];
if($_GET['navi']==="prov"){
	if(isset($_GET['years'])){
		$i = $_GET['years'];
		
	}else{
		$i = $page['_gradinfo']['years'];
	}
	*/
/*}elseif($_GET['navi']==="forw"){
	echo 4;

}*/
	//////////////////////////
	$timeSetting = array();
	$page['week'][0] = "วัน/เวลา";
	$page['week'][1]="จันทร์";
	$page['week'][2]="อังคาร";
	$page['week'][3] = "พุธ";
	$page['week'][4]="พฤหัส";
	$page['week'][5]="ศุกร์";
	$page['week'][6] = "เสาร์";
	$page['week'][7]="อาทิตย์";
	$query_timetable = sprintf("SELECT
course_take_term.term,
course_take_term.years,
graduate_personal.Graduate_ID,
section_room_use.`day`,
section_room_use.time_min,
section_room_use.time_max,
building_room.room_name,
building.building_id,
course_section.section,
course_section.course_id,
(section_room_use.time_max)-(section_room_use.time_min) AS col
FROM
graduate_personal
Inner Join course_take_term ON graduate_personal.Graduate_ID = course_take_term.Graduate_ID
Inner Join section_room_take_term ON section_room_take_term.term_id = course_take_term.id
Inner Join section_room_use ON section_room_take_term.section_room_id = section_room_use.id
Inner Join building_room ON building_room.id = section_room_use.building_room_id
Inner Join building ON building_room.building_id = building.building_id
Inner Join course_section ON section_room_use.course_section_id = course_section.id
WHERE graduate_personal.Graduate_ID = '".$_GET['graduateid']."' %s","ORDER BY course_take_term.years DESC");

$rs_timetable = $db->Execute($query_timetable);
while(!$rs_timetable->EOF){
	$page['_timetable'][] = $rs_timetable->fields;
	$page['_timetable']['day'][] = $rs_timetable->fields['day'];
	$page['_timetable']['time_min'][] = $rs_timetable->fields['time_min'];
	$page['_timetable']['time_max'][] = $rs_timetable->fields['time_max'];
	$page['_timetable']['term'][] = $rs_timetable->fields['term'];
	$page['_timetable']['years'][] = $rs_timetable->fields['years'];
	$rs_timetable->MoveNext();
}
$timeSetting['start'] = min($page['_timetable']['time_min']);
$timeSetting['end'] = max($page['_timetable']['time_max'])-1;
$timeSetting['d_start'] = min($page['_timetable']['day']);
$timeSetting['d_end'] = max($page['_timetable']['day']);
$timeSetting['term'] = max($page['_timetable']['term']);
$timeSetting['years'] = max($page['_timetable']['years']);

		for($i=0;$i<=$timeSetting['d_end'];$i++){
	for($t=$timeSetting['start'];$t<=$timeSetting['end'];$t++){
		$query_gentable = "SELECT
course_take_term.term,
course_take_term.years,
graduate_personal.Graduate_ID,
section_room_use.`day`,
section_room_use.time_min,
section_room_use.time_max,
building_room.room_name,
building.building_id,
course_section.section,
course_section.course_id,
(section_room_use.time_max)-(section_room_use.time_min) AS col
FROM
graduate_personal
Inner Join course_take_term ON graduate_personal.Graduate_ID = course_take_term.Graduate_ID
Inner Join section_room_take_term ON section_room_take_term.term_id = course_take_term.id
Inner Join section_room_use ON section_room_take_term.section_room_id = section_room_use.id
Inner Join building_room ON building_room.id = section_room_use.building_room_id
Inner Join building ON building_room.building_id = building.building_id
Inner Join course_section ON section_room_use.course_section_id = course_section.id
WHERE graduate_personal.Graduate_ID = '".$_GET['graduateid']."' AND section_room_use.`day` = '$i' AND section_room_use.time_min = '$t' AND course_take_term.term = ".$timeSetting['term']." AND course_take_term.years = ".$timeSetting['years']."";
	$rs_gentable = $db->Execute($query_gentable);
	if($rs_gentable->EOF){
		$page['times'][$page['week'][$i]][$t] = null;
		//unset($page['times'][$page['week'][$i]][$t]);	
	}else{
		while(!$rs_gentable->EOF){
			$page['times'][$page['week'][$i]][$t] = $rs_gentable->fields;
			$t = $page['times'][$page['week'][$i]][$t]['time_max']-1;
			$rs_gentable->MoveNext();
		}
	}
	
	}
}


}


?>
