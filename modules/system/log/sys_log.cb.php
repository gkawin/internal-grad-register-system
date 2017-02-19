<?php
if(isset($segment[1])){
	switch($segment[1]){
		case "log":
		/*query log*/
		$query['_log'] = "SELECT * FROM system_log ORDER BY `day` DESC,time DESC";
		$rs['sel'] = $db->Execute($query['_log']);
		while(!$rs['sel']->EOF){
			$row['_log'][$rs['sel']->fields['log_id']] = $rs['sel']->fields;
			$rs['sel']->MoveNext();
		}
			$page['view'] = "log";
			
			if($segment[2]==="del"){
				if(!empty($_POST['log_id'])){
					$res['callback']['result'] = $db->Execute($sql->del("system_log","log_id=".$_POST['log_id']))->EOF;
				}
				echo json_encode($res['callback']);
				
				
				exit();
			}elseif($segment[2] ==="details"){
				
				require_once(ROOT_DIR."/modules/system/log/log_details.php");
				exit();
			}
		break;
		case "userlog":
		/*query userlog*/
		$query['_acclog'] = "SELECT
		CONCAT(employee.titlename,employee.firstname,' ',employee.lastname) AS EMP_NAME,
		account.username,
		account.`status`,
		IF(account.sec_work=1,'เจ้าหน้าที่ฝ่ายภาระการศึกษา',IF(account.sec_work=2,'เจ้าหน้าที่ฝ่ายตรวจสอบ','ผู้ดูแลระบบ')) AS sec_work,
		account_log.id,
		account_log.ip,
		account_log.last_login,
		account_log.last_module
		FROM
		account
		INNER JOIN employee ON account.employee_id = employee.id
		INNER JOIN account_log ON account.id = account_log.account_id";
		$rs['sel'] = $db->Execute($query['_acclog']);
		while(!$rs['sel']->EOF){
			$row['_acclog'][] = $rs['sel']->fields;
			$rs['sel']->MoveNext();
		}
			$page['view'] = "userlog";
			if($segment[2]==="del"){
				echo $segment[1];
				exit();
			}elseif($segment[2] ==="details"){
				require_once(ROOT_DIR."/modules/system/log/userlog_details.php");
				exit();
			}
		break;
		default: $currenttemplate = "error404.html";
	}

}
?>