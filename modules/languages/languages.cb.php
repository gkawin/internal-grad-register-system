<?php
if(mb_eregi('languages.compile.php',$_SERVER['PHP_SELF'])){echo '<h1>access denied</h1>';exit;}
$currentpage = "home.html";
$_SESSION['lang'] = $_GET['lang'];
header("location:/");
?>