<?php

	if(!empty($segment[1])&&$segment[1]=="callbackJson"){
		require_once(ROOT_DIR.'/modules/service/json/callbackjson.cb.php');	
	}
	else if(isset($segment[1])){
		$currentpage = "error404.html";
	}
/// under construction
	?>