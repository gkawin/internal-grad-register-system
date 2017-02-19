<?php /* Smarty version Smarty-3.1.7, created on 2012-03-09 07:07:39
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\trackresult_access.html" */ ?>
<?php /*%%SmartyHeaderCode:107004f591ade359930-86849616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '103b4e8bc05eeca437a937c7950caad6797bdaa5' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\trackresult_access.html',
      1 => 1331242046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107004f591ade359930-86849616',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f591ade3b63f',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f591ade3b63f')) {function content_4f591ade3b63f($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<table border="1" cellpadding="5" width="100%" bordercolor="#999999" bgcolor="#FFFFFF" align="center">
 
        <tr>
          <th colspan="7" class="k-header" bgcolor="#CCCCCC">ภาคการศึกษาที่ 1 / 2555</th>
          </tr>
        <tr bgcolor="#D2FCFF">
          <th width="17%">รหัสวิชา</th>
          <th colspan="3">ชื่อวิชา</th>
          <th width="22%">หน่วยกิต</th>
          <th width="8%">เกรด</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_viewResult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr style="background-color:#FFF;">
          <td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['row']->value['course_id'];?>
</td>
          <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['row']->value['course_name'];?>
</td>
          <td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['row']->value['credit'];?>
</td>
          <td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['row']->value['result_grade'];?>
</td>
        </tr>
        <?php } ?>
        <tr style="background-color:#FFF; text-align: center;">
          <td colspan="7" style="text-align: center" class="k-header" bgcolor="#D2FCFF">ผลการเรียนเทอม 1 / 2555</td>
        </tr>
        <tr style="background-color:#FFC;">
          <td colspan="2" style="text-align: center">ลงทะเบียน</td>
          <td style="text-align: center">ได้หน่วยกิต</td>
          <td colspan="4" style="text-align: center">เกรดเฉลี่ย (GPA)</td>
        </tr>
        <tr style="background-color:#FFF;">
          <td colspan="2" style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['page']->value['sumCredit'];?>
</td>
          <td width="33%" align="center"><?php echo $_smarty_tpl->tpl_vars['page']->value['earn'];?>
</td>
          <td colspan="4" align="center"><?php echo $_smarty_tpl->tpl_vars['page']->value['finalGrade'];?>
</td>
        </tr>
      
    </table>
</body>
</html>
<?php }} ?>