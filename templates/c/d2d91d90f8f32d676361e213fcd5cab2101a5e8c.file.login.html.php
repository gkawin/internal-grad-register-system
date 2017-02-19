<?php /* Smarty version Smarty-3.1.7, created on 2012-01-21 06:03:48
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/cms_xhtml\login.html" */ ?>
<?php /*%%SmartyHeaderCode:301514f1704e36f9a74-17204879%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2d91d90f8f32d676361e213fcd5cab2101a5e8c' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/cms_xhtml\\login.html',
      1 => 1327122225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '301514f1704e36f9a74-17204879',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f1704e379e12',
  'variables' => 
  array (
    'titleMsg' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f1704e379e12')) {function content_4f1704e379e12($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<!--  start message-red -->
				<div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left"><p>Error. <a href="">Please try again.</a></p></td>
					<td class="red-right"><a class="close-red"><img src="/templates/skin/cms_xhtml/images//table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>

	<!-- start logo -->
	<div id="logo-login">
		<a href="index.html"><img src="/templates/skin/cms_xhtml/images/login/logo.png" width="90" height="90" alt="" /></a><p>Internal Graduate Register System</p>
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
    <form  method="post" action="/login" name="form1">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input type="text" name="username"  class="login-inp" /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="pwd" value="************"  onfocus="this.value=''"  class="login-inp" /></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
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