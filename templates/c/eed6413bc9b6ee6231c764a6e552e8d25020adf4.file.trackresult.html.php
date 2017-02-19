<?php /* Smarty version Smarty-3.1.7, created on 2012-03-08 21:33:48
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\trackresult.html" */ ?>
<?php /*%%SmartyHeaderCode:244144f5902b79ff1c0-45489004%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eed6413bc9b6ee6231c764a6e552e8d25020adf4' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\trackresult.html',
      1 => 1331238827,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244144f5902b79ff1c0-45489004',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f5902b7a3b70',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f5902b7a3b70')) {function content_4f5902b7a3b70($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
body {
	font-family:Tahoma;
	background:#6D3636;
	margin:0;
	font-size:13px;
	height:100%;
}
#linkcolorblue{
	color:#0000FF;
}
</style>
<script>
$(function(){
	$(".treeView").each(function(index, element) {
            $(".treeView").kendoTreeView({ dragAndDrop: false});
        });
});
</script> 
<!-- CONTENT -->
<div class="container">
<?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>

<section style="padding:5px;">
<h1 style="color:#00C";>เลือกรหัสนักศึกษา เพื่อตรวจสอบจบและติดตามนักศึกษา</h1>
    <table  width="100%" cellpadding="3" id="tblist">
        <thead  style="text-decoration:underline; font-weight:bold;" class="k-header">
          <tr style="text-align: left">
            <th width="10%" style="text-align: center">รหัสนักศึกษา</th>
            <th width="30%">ชื่อนักศึกษา</th>
            <th width="20%">หลักสูตร</th>
            <th width="20%"> คณะ </th>
            <th width="13%">หลักสูตรแผน</th>
            <th width="7%">สถานะภาพ</th>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top" style="text-align: left">
            <td><a href="/chk/showresult/view?graduateid=<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_ID'];?>
&graduatename=<?php echo $_smarty_tpl->tpl_vars['row']->value['Title_Name'];?>
<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Lastname'];?>
" id="linkcolorblue"><strong><?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_ID'];?>
</strong></a></td>
            <td><img src="http://202.28.37.99/duk/admin/Manager_Graduate/images_small/<?php echo $_smarty_tpl->tpl_vars['row']->value['image'];?>
" width="64" height="64" style="margin-right:5px;float:left;"/><span style="display:block;"><?php echo $_smarty_tpl->tpl_vars['row']->value['Title_Name'];?>
<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Lastname'];?>
</span><span><?php echo $_smarty_tpl->tpl_vars['row']->value['Title_Name_English'];?>
<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Name_English'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Lastname_English'];?>
</span></td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['program_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['plan'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['graduate_status'];?>
</td>
          </tr>
          <?php } ?>
        </tbody>
    </table>
  </section>

    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="viewResult"){?>
    <section>
    <table border="0" cellpadding="5" width="50%">
 
        <tr>
          <th colspan="7" class="k-header">ภาคการศึกษาที่ </th>
          </tr>
        <tr>
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
          <td colspan="7" style="text-align: center" class="k-header">ผลการเรียนเทอม</td>
        </tr>
        <tr style="background-color:#FFF;">
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
    </section>
    <?php }?>
  <div class="clear-all"></div>
</div>
</body>
</html><?php }} ?>