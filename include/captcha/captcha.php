<?php
session_start();
include "class.captcha.php";
$capchar = new Captcha();
$capchar->size = rand(3,5); // �ӹǹ�ѡ���
$capchar->session="sCaptcha"; // ���� Session
$capchar->display();
?>