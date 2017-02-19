<?php
session_start();
$strCheck=$_REQUEST[strCheck];
if($_SESSION[sCaptcha]==$strCheck){
	echo"Success.";
}else{
	echo"Fail !!! <br> <a href='demo.html'>Back</a>";
}
?>