<?php
$sub = (isset($segment[2])|| $segment[2]!="form")? " >> ".$segment[2] : null;
$part = (isset($segment[2]))? "/".$segment[0]."/".$segment[1]."/".$segment[2] : "/".$segment[0]."/".$segment[1];
$page['editor']['time'] = date("H:i:s");
$page['editor']['day'] = date("Y-m-d");
$page['editor']['detail'] = mysql_escape_string(json_encode(
	array(	"ip"=>$_SERVER['REMOTE_ADDR'],
			"modules"=>$segment[1].$sub,
			"path"=>$part,
			"data"=>$_POST)));
$page['editor']['whoaction'] = empty($_SESSION['nameTH'])? "ADMIN NOT ACTIVE" : $_SESSION['nameTH'];

switch ($segment[2]){
	case "changepassword":
		if(!empty($_POST['requestOldPwd'])){
			$rs['sel'] = $db->Execute("SELECT pwd FROM account WHERE username = '".$_POST['username']."'");
		}
	$page['view'] = "changepassword";
	break;
}

?>