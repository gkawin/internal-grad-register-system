<?php
//root directory
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']);

//support administrator
define('SUPPORT_ADMIN','tongza.g@gmail.com');

//database configuration
define('DBHOST','');
define('DBUSER','');
define('DBPASS','');
define('DBNAME','igrs_empty');
define('CHAR_SET','utf-8');
define('DBTYPE','mysql');

// languages 

define('LANG',$_SESSION['lang']);
define('LANG_PATH',ROOT_DIR.'/include/lang/');

//Skin Site

define('SKIN','default');
define('SKIN_ADMIN','HTML5 Admin Template');
define('SKIN_PATH',$_SERVER['DOCUMENT_ROOT'].'/templates/skin/'.SKIN);

//SESSION EXPIRE
define('SESSIONEXPIRE',30);
//Key salt
define('SALT',"DEFAULT");

//SET TIME ZONE
date_default_timezone_set("Asia/Bangkok");

//จำนวนที่เข้าระบบผิด
define(AUTH_TRY,3);
?>
