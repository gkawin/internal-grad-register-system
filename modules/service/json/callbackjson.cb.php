<?php
header("Content-type: application/json");
if(!empty($_GET)){
	switch($_GET['module']){
		case "emp":
			$query = sprintf("SELECT CONCAT(employee.titlename,employee.firstname,' ',employee.lastname) AS name, employee.id FROM employee WHERE 
				employee.firstname 
				LIKE '%%%s%%' 
				ORDER BY 
				employee.firstname 
				DESC", mysql_real_escape_string($_GET["q"]));
		break;
		case "emp_unteach":
			$query = sprintf("SELECT
			CONCAT(employee.titlename,employee.firstname,' ',employee.lastname) AS `name`,
			employee.id
			FROM
			employee
			INNER JOIN employee_group_member ON employee_group_member.employee_id = employee.id
			INNER JOIN employee_group_name ON employee_group_member.group_id = employee_group_name.group_id
			WHERE employee.firstname LIKE '%%%s%%' AND employee_group_name.teachable = 1 ORDER BY employee.firstname DESC", mysql_real_escape_string($_GET["q"]));
		break;
		case "course":
		$query = sprintf("SELECT
	course.course_name,
	course.course_nameEN,
	course.course_id AS id,
	course.course_id,
	course.course_idEN,
	course.credit,
	course.lecture,
	course.practice
	FROM
	course
	WHERE course.course_id LIKE '%%%s%%'",mysql_real_escape_string($_GET["q"]));
		break;
		case "major":
			$query = sprintf("SELECT
	major.major_name AS name,
	major.major_id AS id
	FROM
	faculty
	INNER JOIN major ON faculty.fac_id = major.fac_id
	WHERE major.major_name LIKE '%%%s%%' AND major.major_id <> 999",mysql_real_escape_string($_GET["q"]));
		break;
		case "room":
			$query = sprintf("SELECT
	 building_room.id AS id,
	CONCAT(building_room.room_name,' ',building.building_name) AS name
	FROM
	building_room
	Inner Join building ON building_room.building_id = building.building_id
	WHERE building_room.room_name LIKE '%%%s%%' OR building.building_name LIKE '%%%s%%'",mysql_real_escape_string($_GET["q"]),mysql_real_escape_string($_GET['q']));
		break;
		case "degree_level_no_token":
			$query = sprintf("SELECT * FROM degree_level WHERE id = %d",mysql_real_escape_string($_POST["q"]));		
		break;
		case "building_no_token":
			$query = sprintf("SELECT * FROM building WHERE building_id = %d",mysql_real_escape_string($_POST["q"]));	

		break;
		case "avaliable_room_no_token":
			//$query= sprintf("SELECT * FROM section_day_learn WHERE  ";
		default: break;
	}
}

$arr = array();
$rs = $db->Execute($query);

# Collect the results
while(!$rs->EOF) {
    $arr[] = $rs->fields;
	$rs->MoveNext();
}

# JSON-encode the response
$json_response = json_encode($arr);

# Optionally: Wrap the response in a callback function for JSONP cross-domain support
if($_GET["callback"]) {
    $json_response = $_GET["callback"] . "(" . $json_response . ")";
}

# Return the response
echo $json_response;
exit();
?>
