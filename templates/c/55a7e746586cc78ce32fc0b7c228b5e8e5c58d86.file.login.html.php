<?php /* Smarty version Smarty-3.1.7, created on 2011-12-29 07:20:39
         compiled from "./templates/skin/default\login.html" */ ?>
<?php /*%%SmartyHeaderCode:21834efc0650571160-02968502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55a7e746586cc78ce32fc0b7c228b5e8e5c58d86' => 
    array (
      0 => './templates/skin/default\\login.html',
      1 => 1325139636,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21834efc0650571160-02968502',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4efc06505bce6',
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4efc06505bce6')) {function content_4efc06505bce6($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<title>Login | Internal Graduate Register System</title>

</head>

<body>
 <div id="wrap">
    <div class="idea">
        <img src="/templates/skin/default/images/logo.png" width="100px" height="100px" alt=""/>
        <p>Internal Graduate Register System</p>
    </div>
    <div class="block">
        <div class="left"></div>
        <div class="right" style="position: relative">
        <form action="" method="post" name="frm_login">
            <div class="div-row">
              <img src="/templates/skin/default/images/users.png" style="position:absolute;top:24px;left:8px; z-index: 99;" height="24" width="24" alt="" />
                <input type="text" name="username"/>
            </div>
            <div class="div-row">
              <img src="/templates/skin/default/images/key.png" style="position:absolute;top:75px;left:8px; z-index: 99;" height="24" width="24" alt="" />
                <input type="password" name="password" />
            </div>
            <div class="send-row">
             <input type="submit" name="Login_Submit" value="Log in" id="Login_Submit" class="Button" style="height:40px;width:72px;left: 200px; top: -14px" />
            </div>
            </form>
            <div id="lang_change">   
            	<label><?php echo $_smarty_tpl->tpl_vars['lang']->value['select_lang'];?>
 : </label>  <a href="languages?lang=th"><?php echo $_smarty_tpl->tpl_vars['lang']->value['th'];?>
</a> | <a href="languages?lang=en"><?php echo $_smarty_tpl->tpl_vars['lang']->value['en'];?>
</a>
           
    </div>
        </div> 
    </div>
</div>
</body>
</html>
<?php }} ?>