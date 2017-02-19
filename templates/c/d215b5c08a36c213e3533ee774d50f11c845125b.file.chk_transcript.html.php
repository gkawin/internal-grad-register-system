<?php /* Smarty version Smarty-3.1.7, created on 2012-05-27 10:53:29
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\chk_transcript.html" */ ?>
<?php /*%%SmartyHeaderCode:269814f69de794e3dd1-57244815%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd215b5c08a36c213e3533ee774d50f11c845125b' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\chk_transcript.html',
      1 => 1338108807,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269814f69de794e3dd1-57244815',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f69de7951825',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f69de7951825')) {function content_4f69de7951825($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
<div class="container">
    <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
    <div style="padding:5pt;"><a href="/chk" style="text-decoration:underline;">หน้าหลัก</a> > ติดตามและตรวจสอบจบ</div>
  <p>
  <h1>เลือกรหัสนักศึกษา เพื่อตรวจสอบจบและติดตามนักศึกษา</h1>
  <table  width="100%" cellpadding="5" id="tblist">
    <thead  class="k-header">
      <tr valign="top">
        <th width="9%">รหัสนักศึกษา</th>
        <th width="42%">ชื่อนักศึกษา</th>
        <th width="25%">หลักสูตร</th>
        <th width="14%">ระดับปริญญา</th>
        <th width="10%">สถานะภาพ</th>
      </tr>
    </thead>
    <tbody>
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <tr>
        <td><a href="/chk/transcript/docsexport/<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
" id="linkcolorblue"><strong>
          <?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>

          </strong></a></td>
        <td><img src="http://202.28.37.99/duk/admin/Manager_Graduate/images_small/<?php echo $_smarty_tpl->tpl_vars['row']->value['image'];?>
" width="64" height="64" style="margin-right:5px;float:left;"/>
          <?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>

          <br>
          <?php echo $_smarty_tpl->tpl_vars['item']->value['stdNameEN'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['edu_program'];?>
</td>
        <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['degree_name'];?>
</td>
        <td align="center"><?php switch ($_smarty_tpl->tpl_vars['item']->value['graduate_status']){?>
<?php case 1:?>
          <div style="color:#FF0000;font-weight:bold;">กำลังศึกษา</div>
          <?php break 1?>
          <?php case 0:?>
          <div style="color:#009900;font-weight:bold;">จบการศึกษา</div>
          <?php break 1?>
          <?php case 2:?>
          <div style="color:#666600;font-weight:bold;">ลาออก</div>
          <?php break 1?>
          <?php case 3:?>
          <div style="color:#FFCC00;font-weight:bold;">รักษาสภาพ</div>
          <?php break 1?>
          <?php }?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </p>
    <?php }?>
    <div class="clear-all"></div>

</div>
</body>
</html>
<?php }} ?>