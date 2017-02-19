<?php /* Smarty version Smarty-3.1.7, created on 2012-03-27 19:38:47
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\admin_index.html" */ ?>
<?php /*%%SmartyHeaderCode:52784f4099818cd8b2-13055324%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a631f0038a525b64d56ff8e5336cfe29c6d99309' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\admin_index.html',
      1 => 1332869925,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52784f4099818cd8b2-13055324',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f409981902a3',
  'variables' => 
  array (
    'titleMsg' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f409981902a3')) {function content_4f409981902a3($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link href="../../../libs/jquery/plugins/jquery UI/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<script src="../../../libs/jquery/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="../../../libs/jquery/plugins/jquery UI/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<title>
<?php echo $_smarty_tpl->tpl_vars['titleMsg']->value;?>

</title>
<link href="/templates/skin/default/login.css" rel="stylesheet" type="text/css" />
<script>
	function chkFields(){
			var username = $("#username").val();
			var pwd = $("#pwd").val();
			
			if(username == ""){
				document.form1.username.focus();
				document.getElementById('username').style.backgroundColor='#F69';
				return false;
			}else{
				document.getElementById('username').style.backgroundColor='#FFF';
			}
			if(pwd== ""){
				document.form1.pwd.focus();
				document.getElementById('pwd').style.backgroundColor='#F69';
				return false;
			}else{
				document.getElementById('pwd').style.backgroundColor='#FFF';
			}
	}
</script>

</head>
<style>
.confirmPwd{
 background-color:#FFF;
position: absolute; top: 50%; left: 50%; width: 500px; 
}
</style>
<body>
<?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="adminLogin"){?>
<div class="confirmPwd">
hdfghdg
</div>
<?php }?>
</body>
</html><?php }} ?>