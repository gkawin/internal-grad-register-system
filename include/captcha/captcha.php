<?php
session_start();
include "class.captcha.php";
$capchar = new Captcha();
$capchar->size = rand(3,5); // จำนวนอักขระ
$capchar->session="sCaptcha"; // ชื่อ Session
$capchar->display();
?>