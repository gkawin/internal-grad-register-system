<?php
	$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".base64_decode($_SESSION['employee_id']).",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','logout')");

	unset($_SESSION);
	unset($row);
	unset($page);
	unset($res);
	session_destroy();
	header("Location: /");
?>