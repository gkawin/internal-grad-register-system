<?php /* Smarty version Smarty-3.1.7, created on 2012-06-23 00:03:17
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\login_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:271734fb53299a54230-95567202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43a9e975452b394ff30ec0884518517045d2e72e' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\\login_admin.html',
      1 => 1340383826,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '271734fb53299a54230-95567202',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fb53299aa91d',
  'variables' => 
  array (
    'titleMsg' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb53299aa91d')) {function content_4fb53299aa91d($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $_smarty_tpl->tpl_vars['titleMsg']->value;?>
</title>
<link rel="stylesheet" href="/templates/skin/cms_xhtml/css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->
<script src="../../../libs/jquery/jquery-1.6.2.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="/templates/skin/cms_xhtml/js/jquery/custom_jquery.js" type="text/javascript"></script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="/templates/skin/cms_xhtml/js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

<?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback'])){?>
				<div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left"><?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['error'];?>
</td>
					<td class="red-right"><a class="close-red"><img src="/templates/skin/cms_xhtml/images//table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
<?php }?>
	<!-- start logo -->
	<div id="logo-login">
		<a href="index_admin.html"><img src="/templates/skin/cms_xhtml/images/login/logo.png" width="90" height="90" alt="" /></a>
		<p>การจัดการ : ยืนยันการเข้าใช้งาน</p>
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
    <form  method="post" action="" name="form1">
		<table width="399" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<th width="255">Password</th>
			<td width="144"><input type="password" name="pwd"  onfocus="this.value=''"  class="login-inp" /></td>
		</tr>
		<tr>
			<th><IMG SRC="../../../include/captcha/captcha.php"  BORDER="0" /></th>
			<td valign="top"><INPUT TYPE="text" NAME="strCheck" class="login-inp" /></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" class="submit-login" name="Login_Submit"  /></td>
		</tr>
		</table>
        </form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="" class="forgot-pwd">Forgot Password?</a>
 </div>
 <!--  end loginbox -->
 
	<!--  start forgotbox ................................................................................... -->
	<div id="forgotbox">
		<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
		<!--  start forgot-inner -->
		<div id="forgot-inner">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Email address:</th>
			<td><input type="text" value=""   class="login-inp" /></td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="button" class="submit-login"  /></td>
		</tr>
		</table>
		</div>
		<!--  end forgot-inner -->
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
	<!--  end forgotbox -->

</div>
<!-- End: login-holder -->
</body>
</html><?php }} ?>