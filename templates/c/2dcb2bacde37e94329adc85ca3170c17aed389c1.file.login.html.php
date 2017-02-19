<?php /* Smarty version Smarty-3.1.7, created on 2012-07-10 13:41:45
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\login.html" */ ?>
<?php /*%%SmartyHeaderCode:103404efbf2fb5b46d7-78202467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2dcb2bacde37e94329adc85ca3170c17aed389c1' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\login.html',
      1 => 1341857668,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103404efbf2fb5b46d7-78202467',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4efbf2fb6ed33',
  'variables' => 
  array (
    'titleMsg' => 0,
    'page' => 0,
    'lang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4efbf2fb6ed33')) {function content_4efbf2fb6ed33($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link href="../../../libs/jquery/plugins/jquery UI/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<link href="/templates/skin/default/grid.css" rel="stylesheet" type="text/css" />
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

<body>
<div id="wrap">
  <div class="idea"> <img src="/templates/skin/default/images/logo.png" width="100px" height="100px" alt=""/>
    <p>Internal Graduate Register System</p>
  </div>
  <?php if ($_smarty_tpl->tpl_vars['page']->value['error_alert']!=''){?>
<div id="landing" style="text-align:center; padding:10pt; top:50px; background:#FFFFCC; position:relative;">
	<p>*<?php echo $_smarty_tpl->tpl_vars['page']->value['error_alert'];?>
</p>
   </div>
   <?php }?>
   <?php if ($_smarty_tpl->tpl_vars['page']->value['user']['firstLogin']){?>
   <div id="landing" style="text-align:center; padding:10pt; top:50px; background:#FFFFCC; position:relative;">
	<p>หากเข้าระบบครั้งแรก กรุณาเข้าระบบโดยใช้ <br>
	- username : admin<br>
- password : admin</p>
   </div>
   <?php }?>
  <div class="block">
    <div class="left"></div>
    <div class="right" style="position: relative">
      <form  method="post" action="/login" name="form1" onSubmit="return chkFields()">
        <div class="div-row"> <img src="/templates/skin/default/images/users.png" style="position:absolute;top:24px;left:8px; z-index: 99;" height="24" width="24" alt="" />
          <input type="text" name="username" id="username"/>
        </div>
        <div class="div-row"> <img src="/templates/skin/default/images/key.png" style="position:absolute;top:75px;left:8px; z-index: 99;" height="24" width="24" alt="" />
          <input type="password" name="pwd" id="pwd" />
        </div>
        <div class="send-row">
          <input type="submit" name="Login_Submit" value="Login" id="Login_Submit" class="Button" style="height:40px;width:72px;left: 200px; top: -14px" />
        </div>
      </form>
      <div id="lang_change">
        <label>
          <?php echo $_smarty_tpl->tpl_vars['lang']->value['select_lang'];?>

          : </label>
        <a href="languages?lang=th">
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['th'];?>

        </a> | <a href="languages?lang=en">
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['en'];?>

        </a> </div>
    </div>
  </div>
</div>
</body>
</html><?php }} ?>