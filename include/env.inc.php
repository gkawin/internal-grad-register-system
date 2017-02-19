<?php
$lang = array(); // variable of languages
$page = array(); //get & set data from $_GET $_POST;
$res = array(); //respond data by the way JSON;
$row = array();
$titleMsg = "";
$query = array();
$aMenuTitle = array();
$log = array();

	$db = NewADOConnection(DBTYPE);
	//$db->debug=true;
	$db->Connect(DBHOST,DBUSER,DBPASS,DBNAME);
	$db->EXECUTE("set names utf8"); 
	$db->SetFetchMode(ADODB_FETCH_ASSOC);

if(!empty($_SESSION['lang']) && $_SESSION['lang'] == "en")
	require_once(LANG_PATH.'en.inc.php');
else
	require_once(LANG_PATH.'th.inc.php');



?>