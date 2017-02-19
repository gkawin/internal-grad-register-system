<?php

$titleMsg = "CHECKER STAFF MANAGEMENT || DASHBOARD";
if(mb_eregi('chk.cb.php',$_SERVER['PHP_SELF'])){
	$currenttemplate= "error404.html";
}else{
	$currenttemplate = "chk_index.html";
	if(!empty($segment[1])&&$segment[1]=="tracking"){
		require_once(ROOT_DIR.'/modules/chk/tracking/tracking.h.php');
		require_once(ROOT_DIR.'/modules/chk/tracking/tracking.cb.php');	
	/*}
	else if($segment[1] == "showresult"){
		require_once(ROOT_DIR.'/modules/chk/showresult/showresult.h.php');
		require_once(ROOT_DIR.'/modules/chk/showresult/showresult.cb.php');*/
	}else if($segment[1]=== "transcript"){
		require_once(ROOT_DIR.'/modules/chk/transcript/transcript.h.php');
		require_once(ROOT_DIR.'/modules/chk/transcript/transcript.cb.php');
	}
	else if(isset($segment[1])){
		$currentpage = "error404.html";
	}
}


?>