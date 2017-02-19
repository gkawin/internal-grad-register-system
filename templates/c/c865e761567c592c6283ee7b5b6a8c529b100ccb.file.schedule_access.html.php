<?php /* Smarty version Smarty-3.1.7, created on 2012-03-08 21:46:38
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\schedule_access.html" */ ?>
<?php /*%%SmartyHeaderCode:70944f58d1e5583534-15250418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c865e761567c592c6283ee7b5b6a8c529b100ccb' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\schedule_access.html',
      1 => 1331224638,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70944f58d1e5583534-15250418',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f58d1e562d1c',
  'variables' => 
  array (
    'page' => 0,
    'days' => 0,
    't' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f58d1e562d1c')) {function content_4f58d1e562d1c($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

	<table width="100%" border="0" align="center" cellpadding="5">
    <tr>
      <td colspan="2"><h1 style="color:#0000CC;">ตารางเรียน/สอบของรายวิชาที่ลงทะเบียนไว้แล้ว</h1></td>
      </tr>
    <tr>
      <td width="101">ชื่อ - สกุล :</td>
      <td width="863"><?php echo $_smarty_tpl->tpl_vars['page']->value['graduatename'];?>
</td>
    </tr>
    <tr>
      <td><span class="layout">สถานภาพ :</span></td>
      <td><?php if ($_smarty_tpl->tpl_vars['page']->value['Status']==0){?>
      กำลังศึกษา
      <?php }elseif($_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['Status']==1){?>
      สำเร็จการศึกษา 
       <?php }elseif($_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['Status']==2){?>
       ลาออก 
       <?php }elseif($_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['Status']==3){?>
       ลาพัก 
       <?php }elseif($_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['Status']==4){?>
       พ้นสภาพ
       <?php }?></td>
    </tr>
    <tr>
      <td><span class="layout">หลักสูตร :</span></td>
      <td><?php echo $_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['Degree'];?>
</td>
    </tr>
    <tr>
      <td><span class="layout">คณะ :</span></td>
      <td><?php echo $_smarty_tpl->tpl_vars['page']->value['_graduateinfo']['fac_name'];?>
</td>
    </tr>
    <tr>
      <td colspan="2">ปีการศึกษา  <a href="/edu/schedule/view?graduateid=<?php echo $_smarty_tpl->tpl_vars['page']->value['graduateid'];?>
&graduatename=<?php echo $_smarty_tpl->tpl_vars['page']->value['graduatename'];?>
&acadyear=<?php echo $_smarty_tpl->tpl_vars['page']->value['acadyear'];?>
&maxsemester=2"><img src="/templates/skin/default/images/icon/_previous.png" style="vertical-align:baseline"/></a><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
echo $_GET[acadyear];<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<img src="/templates/skin/default/images/icon/_next.png"/></td>
    </tr>
    </table>

    <table border="0">
    <?php  $_smarty_tpl->tpl_vars['days'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['days']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['times']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['days']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['days']->key => $_smarty_tpl->tpl_vars['days']->value){
$_smarty_tpl->tpl_vars['days']->_loop = true;
 $_smarty_tpl->tpl_vars['days']->index++;
?>
    <tr align="center" BGCOLOR="#999999">
    	  <th class="k-header"><?php echo $_smarty_tpl->tpl_vars['days']->key;?>
</th>
        
        <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['days']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value){
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
        <?php if ($_smarty_tpl->tpl_vars['days']->index==0){?>
        <th class="k-header"><?php echo $_smarty_tpl->tpl_vars['t']->key;?>
.00 - <?php echo $_smarty_tpl->tpl_vars['t']->key+1;?>
.00</th>
        <?php }elseif($_smarty_tpl->tpl_vars['t']->value==null){?>
        <td ></td>
        <?php }elseif($_smarty_tpl->tpl_vars['t']->value!=null){?>
        <td nowrap colspan="<?php echo $_smarty_tpl->tpl_vars['t']->value['col'];?>
" bgcolor="#00FF33" valign="top"><a href="/edu/course/classinfo?courseid=<?php echo $_smarty_tpl->tpl_vars['t']->value['course_id'];?>
&semester=<?php echo $_smarty_tpl->tpl_vars['t']->value['term'];?>
&term=<?php echo $_smarty_tpl->tpl_vars['t']->value['term'];?>
" style="font-weight:bold;color:#00F;"><?php echo $_smarty_tpl->tpl_vars['t']->value['course_id'];?>
</a><br/>(<?php echo $_smarty_tpl->tpl_vars['t']->value['credit'];?>
) <?php echo $_smarty_tpl->tpl_vars['t']->value['section'];?>
,<?php echo $_smarty_tpl->tpl_vars['t']->value['room_name'];?>
<br/><?php echo $_smarty_tpl->tpl_vars['t']->value['building_id'];?>
</td> 
        <?php }?>
        
     	<?php } ?>
    </tr>
    <?php }
if (!$_smarty_tpl->tpl_vars['days']->_loop) {
?>
    <tr>
    <td>HELLO</td>
    </tr>
    <?php } ?>
    </table>
</body>
</html>
<?php }} ?>