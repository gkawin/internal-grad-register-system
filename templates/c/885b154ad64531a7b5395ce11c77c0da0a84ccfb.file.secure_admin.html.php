<?php /* Smarty version Smarty-3.1.7, created on 2012-07-06 02:50:07
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\secure_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:15304ff5e8b0b0fca8-31218626%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '885b154ad64531a7b5395ce11c77c0da0a84ccfb' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\\secure_admin.html',
      1 => 1341517796,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15304ff5e8b0b0fca8-31218626',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4ff5e8b0cf3b5',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff5e8b0cf3b5')) {function content_4ff5e8b0cf3b5($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['page']->value['view']==''){?>

 <article class="module width_full">
    <header>
      <h3>จัดการระบบรักษาความปลอดภัย</h3>
    </header>
    <div class="module_content" style="position:relative;">
   	<div style="margin-left:4.7em; position:relative;">
  <a href="/system/secure/changepassword" class="k-button "  style="display:block; margin:5pt; width:20%; float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_edit_article.png" style="vertical-align:middle;"> เปลี่ยนรหัสผ่าน</a>
   <div class="clear"></div>
    </div>
    </div>
  </article>
  
<?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="changepassword"){?>
<article class="module width_full">
  <header>
    <h3>เปลี่ยนรหัสผ่านผู้ดูแลระบบ</h3>
  </header>
  <div class="module_content">
  <div id="result" style="display:none; background:#00FF33; padding:10px;" align="center"></div>
  <form method="post" action="" id="newAccount">
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

      <tr>
     
        <td><fieldset>
            <label>รหัสผ่านเดิม</label>
            <input type="password" name="oldPwd" id="oldPwd" maxlength="12" class="k-textbox" required>
            
          </fieldset></td>
      </tr>
      <tr>
        <td><fieldset>
            <label>รหัสผ่านใหม่</label>
            <input name="pwd" size="15" maxlength="12" type="text" required validationMessage="กรุณากรอกรหัสผ่าน" class="k-textbox" id="sPwd" style="float:left;" onKeyUp="checkEngChar(this)"><input type="button" id="generatePwd" style="margin-left:7pt;" value="Generate password">
            </fieldset></td>
      </tr>
      <tr>
        <td align="center"><input id="opration" type="submit" name="opration" value="ยืนยันการเปลี่ยนรหัสผ่าน" <?php if (empty($_smarty_tpl->tpl_vars['row']->value['_emp'])){?> disabled <?php }?>></td>
      </tr>
    </table>
    </form>
    <div class="clear"></div>
  </div>
</article>
<?php }?>
<?php }} ?>