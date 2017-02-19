<?php /* Smarty version Smarty-3.1.7, created on 2012-03-08 21:55:58
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\chk_track_access.html" */ ?>
<?php /*%%SmartyHeaderCode:200014f591cde6b7761-89145987%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac9a984e180c2d078427bde689726c852ec5ec22' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\chk_track_access.html',
      1 => 1331239996,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200014f591cde6b7761-89145987',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f591cde73d34',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f591cde73d34')) {function content_4f591cde73d34($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<h1 class="k-header">ติดตามและตรวจสอบจบ</h1>
<table border="0" cellpadding="5" width="80%" align="center">

<tr>
  <th width="128" rowspan="5" style="text-align: left" valign="top"><img src="http://202.28.37.99/duk/admin/Manager_Graduate/images_small/<?php echo $_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['image'];?>
" width="128" height="128"/></th>
  <th width="175" style="text-align: left">ชื่อ :</th>
  <td width="454" style="text-align: left"><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
echo $_GET['graduatename'];<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
</tr>
<tr>
  <th style="text-align: left">รหัสนักศึกษา :</th>
  <td style="text-align: left"><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
echo $_GET['graduateid'];<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
</tr>
<tr>
  <th style="text-align: left">หลักสูตร :</th>
  <td style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['program_name'];?>
</td>
</tr>
<tr>
  <th style="text-align: left">คณะ :</th>
  <td style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['fac_name'];?>
</td>
</tr>
<tr>
  <th style="text-align: left"><h3 style="color:#009; text-decoration:underline;">ผลการตรวจสอบ :</h3></th>
<td style="text-align: left"><?php if ($_smarty_tpl->tpl_vars['page']->value['resultEdu']=="FAIL"){?><h3 style="color:#F00; text-decoration:underline;">FAIL</h3><?php }elseif($_smarty_tpl->tpl_vars['page']->value['resultEdu']=="PASS"){?><h3 style="color:#090; text-decoration:underline;">PASS</h3><?php }?></td>
</tr>


<tr>

<th colspan="3" style="text-align: left" class="k-header">หมวดหมู่ข้อมูลการศึกษา</th>
  </tr>

<tr>
  <th colspan="2" style="text-align: left" >หน่วยกิตขั้นต่ำของหลักสูตร :</th>
  <td><?php echo $_smarty_tpl->tpl_vars['page']->value['_eduCalc']['all_credit'];?>
</td>
</tr>
<tr>
  <th colspan="2" style="text-align: left" >หน่วยกิตที่ผ่าน :</th>
  <td><?php echo $_smarty_tpl->tpl_vars['page']->value['_eduCalc']['credit'];?>
</td>
</tr>
<tr>
  <th colspan="2" style="text-align: left" >หน่วยกิตที่รอ :</th>
  <td><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['page']->value['_eduCalc']['all_credit'];?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['page']->value['_eduCalc']['credit'];?>
<?php $_tmp2=ob_get_clean();?><?php echo $_tmp1-$_tmp2;?>
</td>
</tr>
<tr>
  <th colspan="2" style="text-align: left" >รายวิชาที่ได้ลงทะเบียน</th>
  <td></td>
</tr>
<tr>
  <th colspan="3" style="text-align: left" class="k-header">หมวดหมู่ข้อมูลปีการศึกษา</th>
  </tr>
<tr>
  <th colspan="2" style="text-align: left" >ปีการศึกษาสูงสุด :</th>
  <td><?php echo $_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['years_normal'];?>
 ปี</td>
</tr>
<!--<tr>
  <th colspan="2" style="text-align: left" >ชั้นปี :</th>
  <td></td>
</tr>-->
<tr>
  <th colspan="3" style="text-align: left" class="k-header" >หมวดหมู่ข้อมูล GPA</th>
  </tr>
<tr>
  <th colspan="2" style="text-align: left" >GPA ต่ำสุด :</th>
  <td><?php echo $_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['minimum_gpa'];?>
</td>
</tr>
<tr>
  <th colspan="2" style="text-align: left" >GPA ที่ได้ :</th>
  <td></td>
</tr>
<tr>
  <th style="text-align: left" >&nbsp;</th>
  <th style="text-align: left" >&nbsp;</th>
  <td></td>
</tr>
<tr>
  <th style="text-align: left" >&nbsp;</th>
  <th style="text-align: left" >&nbsp;</th>
  <td></td>
</tr>
</table>

</body>
</html><?php }} ?>