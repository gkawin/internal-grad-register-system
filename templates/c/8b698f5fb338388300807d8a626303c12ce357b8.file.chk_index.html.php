<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 19:02:28
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\chk_index.html" */ ?>
<?php /*%%SmartyHeaderCode:157004f51e86ed98bd7-67766922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b698f5fb338388300807d8a626303c12ce357b8' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\chk_index.html',
      1 => 1338829344,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157004f51e86ed98bd7-67766922',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f51e86eef203',
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f51e86eef203')) {function content_4f51e86eef203($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
body {
	font-family:Tahoma;
	background:#6D3636;
	margin:0;
	font-size:13px;
	height:100%;
}
</style>

<div class="container">
<div style="padding:5pt;"><a href="/chk" style="text-decoration:underline;">หน้าหลัก</a> > จัดการประเภทวิชา</div>
	<section class="css-table">
    <ul>
    	<li class="k-button ex1" >
        	<a href="/chk/tracking">ติดตามและตรวจสอบจบของบัณฑิต</a>
        </li>
        <!--<li class="k-button">
        	<a href="/chk/showresult">ตรวจผลการศึกษา</a>
        </li>-->
        <!--<li class="k-button">
        	<a href="/chk/transcript">สร้างระเบียนผลการศึกษา</a>
        </li>-->
         <li class="k-button" id="my"> <a href="/my"> <img src="/templates/skin/default/images/icon/profile_icon.png" width="24" height="24" style="vertical-align:middle;"/> 
         <?php echo $_smarty_tpl->tpl_vars['lang']->value['myprofile'];?>

        </a> </li>
    </ul>
    </section>

</div>
</body>
</html>
<?php }} ?>