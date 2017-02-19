<?php
if($segment[0]==="system"){
	if($_GET[auth] === "verify" && sha1($_GET['key'])===$_SESSION['keycode']){
		$currenttemplate = "login_admin.html";
		if(!empty($_POST['Login_Submit'])){
			if($_SESSION[sCaptcha]===$_POST['strCheck']){
				$pwd = sha1($_POST['pwd']);
				$rs['sel'] = $db->Execute($sql->anti_db("SELECT pwd FROM account WHERE pwd = '".$pwd."'"));
				if($rs['sel']->EOF){
					$res['callback']['result'] = "ไม่สามารถเข้าสู่ระบบได้"; 
				}else{
					$_SESSION['bState'] = true;
					header("Location: /system");
				}
			}
		}
	}

	/*logiin pass*/
	if($_SESSION['bState']){
		$currenttemplate = "index_admin.html";
		$rs['sel'] = $db->Execute("SELECT pwd FROM account WHERE pwd = sha1('admin')");
		if($rs['sel']->EOF){
			$res['adminChange'] = 0;
		}else{
			$res['adminChange'] = 1;
		}
		$page['segment'] = $segment[1];
		if($segment[1]==="user"){
			require_once(ROOT_DIR."/modules/system/user/sys_user.h.php");
			require_once(ROOT_DIR."/modules/system/user/sys_user.cb.php");
			
		}elseif($segment[1]==="log" || $segment[1]==="userlog"){
			require_once(ROOT_DIR."/modules/system/log/sys_log.h.php");
			require_once(ROOT_DIR."/modules/system/log/sys_log.cb.php");
		}elseif($segment[1]==="secure"){
			require_once(ROOT_DIR."/modules/system/secure/sys_secure.h.php");
			require_once(ROOT_DIR."/modules/system/secure/sys_secure.cb.php");
		}
	}
}
?>