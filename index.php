<?php
session_start();
session_cache_expire(60);
error_reporting(E_ALL ^ E_NOTICE);
$segment = isset($_SERVER['PATH_INFO']) ? explode('/',preg_replace('~^/?(.*?)/?$~','$1',$_SERVER['PATH_INFO'])) : array() ;
require_once($_SERVER['DOCUMENT_ROOT'].'/conf/siteconf.conf.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/libs/adodb/adodb.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/libs/smarty/libs/SmartyBC.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/stringsql.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/newclass.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/env.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/include/utility.inc.php');

$loadmodule = (isset($segment[0])&&(!empty($segment[0]))) ? $segment[0] : 'login';
	$inc = 'modules/'.$loadmodule;
	
	if (is_dir($inc) && (file_exists($inc.'/'.$loadmodule.'.cb.php'))) {
		(file_exists($inc.'/'.$loadmodule.'.h.php')) ? require_once($inc.'/'.$loadmodule.'.h.php'):null;
		require_once($inc.'/'.$loadmodule.'.cb.php');
	}else{
		$currentpage = "error404.html";	
	}

	$page['user'] = $_SESSION;
	//print_r($_SESSION);
	$smarty = new SmartyBC();
	$smarty->template_dir = (!$_SESSION['admin']) ? $_SERVER['DOCUMENT_ROOT'].'/templates/skin/'.SKIN.'/' : $_SERVER['DOCUMENT_ROOT'].'/templates/skin/'.SKIN_ADMIN.'/' ;
	$smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'].'/templates/c/';
	$smarty->assign('page',$page);
	$smarty->assign('res',$res);
	$smarty->assign('row',$row);
	$smarty->assign('lang',$lang);
	$smarty->assign('char_set',CHAR_SET);
	$smarty->assign('currlang',LANG);
	$smarty->assign('titleMsg',$titleMsg);
	$smarty->display($currenttemplate);
	
?>
