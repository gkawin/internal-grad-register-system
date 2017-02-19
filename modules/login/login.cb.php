<?php
$currenttemplate = "login.html";
$titleMsg = "Login | Internal Graduate Register System";
$page['username'] = $sql->anti_db($_POST['username']);
$page['pwd'] = $sql->anti_db(sha1($_POST['pwd']));
$failLoginCount = 0;
$auth = false;
$query_firstlogin = "SELECT username FROM account WHERE username <> 'admin'";
$rs = $db->Execute($query_firstlogin);
if($rs->EOF){
	$_SESSION['firstLogin'] = true;
}else{
	$_SESSION['firstLogin'] = false;
}
if($page['username']==="admin"){
	$query = "SELECT
	account.id,
	account.username,
	account.pwd,
	account.status,
	account.sec_work,
	account.employee_id FROM account";
}else{
	$query = "SELECT
	account.id,
	account.username,
	account.pwd,
	account.status,
	account.sec_work,
	account.employee_id,
	employee.titlename,
	employee.firstname,
	employee.lastname,
	employee.titlenameEN,
	employee.firstnameEN,
	employee.lastnameEN,
	employee.positionEN,
	employee.`position`,
	employee.under_major_id
	FROM account";
	$query .= " Inner Join employee ON account.employee_id = employee.id";
}
if(isset($_POST['Login_Submit'])){
	$query .= " WHERE username = '".$page['username']."' AND pwd = '".$page['pwd']."'";
	$rs = $db->Execute($query);
	if($rs->EOF){
		 $page['error_alert'] = $lang['loginerrmsg'];
		 $failLoginCount++;
		 if($failLoginCount >= AUTH_TRY){
			 $auth=true;
		 }
	}else{
		while(!$rs->EOF){
			if($rs->fields['status']==1){
				
				$_SESSION['sec_work'] = $rs->fields['sec_work'];
				$_SESSION['employee_id'] = base64_encode($rs->fields['employee_id']);
				$_SESSION['username'] = $rs->fields['username'];
				$_SESSION['nameTH'] = $rs->fields['titlename'].$rs->fields['firstname']." ".$rs->fields['lastname'];
				$_SESSION['nameEN'] = $rs->fields['titlenameEN'].$rs->fields['firstnameEN']." ".$rs->fields['lastnameEN'];
				$_SESSION['postion'] = $rs->fields['postion'];
				$_SESSION['postionEN'] = $rs->fields['postionEN'];
				
				$db->Execute("INSERT INTO account_log(account_id,ip,last_login,last_module) VALUES (
				".$rs->fields['id'].",
				'".$_SERVER['REMOTE_ADDR']."',
				'".date("Y-m-d")." ".date("H:i:s")."','login')");
				redirectway($rs->fields['sec_work'],$db);	
				
			}else{
				 $page['error_alert'] = $lang['loginerrmsg_suspend'];
			}
			$rs->MoveNext();
		}
	}
}

function redirectway($result,$db){
	if($result==0){
		if($auth){
			$_SESSION['admin'] = true;
			$bin = rand(1,20);
			$_SESSION['keycode'] = sha1(md5($bin));
			
			header("Location: /system?auth=verify&key=".md5($bin));
			unset($bin);
		}else{
			$_SESSION['admin'] = true;
			$_SESSION['bState'] = true;
			header("Location: /system");
		}	
	}else if($result== 1){
		$query = "SELECT * FROM faculty WHERE fac_id <> 99";
		$rs = $db->Execute($query);
		if($rs->EOF){
			header("Location: /edu/faculty/form/new");
		}else{	
		
		header("Location: /edu");
		}
	}elseif($result==2){
		header("Location: /chk");
	}
}

if(!empty($_SESSION['employee_id'])){redirectway($_SESSION['sec_work'],null);}

?>