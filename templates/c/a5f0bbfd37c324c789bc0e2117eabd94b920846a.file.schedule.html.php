<?php /* Smarty version Smarty-3.1.7, created on 2012-05-13 11:15:09
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\schedule.html" */ ?>
<?php /*%%SmartyHeaderCode:89014f4dc1fdba7aa1-64305925%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5f0bbfd37c324c789bc0e2117eabd94b920846a' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\schedule.html',
      1 => 1336199007,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89014f4dc1fdba7aa1-64305925',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f4dc1fdbd2b2',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item' => 0,
    'days' => 0,
    't' => 0,
    'classinfo' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f4dc1fdbd2b2')) {function content_4f4dc1fdbd2b2($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>

</style>
<!-- CONTENT -->
<div class="container">
<?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
	<div>
    <h1 style="color:#0000CC;">ตารางเรียน</h1>
    	 <table  width="100%" cellpadding="3" id="tblist">
       <thead style="text-decoration:underline; font-weight:bold;">
          <tr class="k-header">
            <th width="71">รหัสนักศึกษา</th>
            <th width="170">ชื่อนักศึกษา</th>
            <th width="165">สาขาวิชา</th>
            <th width="165">ปริญญา</th>
            <th width="165">สถานะ</th>            </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top">
          <style>
          #viewschedule{ color:#00F;}
		  #viewschedule:hover{ color:#FF0000;}
          </style>
            <td><a href="/edu/schedule/view?graduateid=<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_ID'];?>
" id="viewschedule"><?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_ID'];?>
</a></td>
            <td><div style="margin-bottom:5px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['Title_Name'];?>
<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Lastname'];?>
</div><div><?php echo $_smarty_tpl->tpl_vars['row']->value['Title_Name_English'];?>
<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Name_English'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Lastname_English'];?>
</div></td>
            <td width="165"><?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>
</td>
            <td width="165"><?php echo $_smarty_tpl->tpl_vars['row']->value['Degree'];?>
</td>
            <td width="165"><?php if ($_smarty_tpl->tpl_vars['row']->value['graduate_status']==0){?>
            กำลังศึกษา
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['graduate_status']==1){?>
            สำเร็จ
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['graduate_status']==2){?>
            ลาออก
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['graduate_status']==3){?>
            ลาพัก
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['graduate_status']==4){?>
            พ้นสภาพ
            <?php }?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
<?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="schedule"){?>
<style>
span.layout{ margin-right:30px; display:block;}
</style>
<section class="css-table">

	<table width="100%" border="0" align="center" cellpadding="5">
    <tr>
      <td colspan="2"><h1 style="color:#0000CC;">ตารางเรียน/สอบของรายวิชาที่ลงทะเบียนไว้แล้ว</h1></td>
      </tr>
    <tr>
      <td width="101">ชื่อ - สกุล :</td>
      <td width="863"><?php echo $_smarty_tpl->tpl_vars['page']->value['_gradinfo']['Title_Name'];?>
<?php echo $_smarty_tpl->tpl_vars['page']->value['_gradinfo']['Graduate_Name'];?>
 <?php echo $_smarty_tpl->tpl_vars['page']->value['_gradinfo']['Graduate_Lastname'];?>
</td>
    </tr>
    <tr>
      <td><span class="layout">สถานภาพ :</span></td>
      <td><?php if ($_smarty_tpl->tpl_vars['page']->value['_gradinfo']['Status']==0){?>
      กำลังศึกษา
      <?php }elseif($_smarty_tpl->tpl_vars['page']->value['_gradinfo']['Status']==1){?>
      สำเร็จการศึกษา 
       <?php }elseif($_smarty_tpl->tpl_vars['page']->value['_gradinfo']['Status']==2){?>
       ลาออก 
       <?php }elseif($_smarty_tpl->tpl_vars['page']->value['_gradinfo']['Status']==3){?>
       ลาพัก 
       <?php }elseif($_smarty_tpl->tpl_vars['page']->value['_gradinfo']['Status']==4){?>
       พ้นสภาพ
       <?php }?></td>
    </tr>
    <tr>
      <td><span class="layout">หลักสูตร :</span></td>
      <td><?php echo $_smarty_tpl->tpl_vars['page']->value['_gradinfo']['program_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['page']->value['_gradinfo']['major_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['page']->value['_gradinfo']['program_suite'];?>
)</td>
    </tr>
    <tr>
      <td><span class="layout">คณะ :</span></td>
      <td><?php echo $_smarty_tpl->tpl_vars['page']->value['_gradinfo']['fac_name'];?>
</td>
    </tr>
    <tr>
      <td>ปีการศึกษา</td>
      <td>ปีการศึกษา ณ ขณะนี้ <select id="semester">
      <option>---กรุณาเลือก----</option>
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['itemSemester']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <option><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
      <?php } ?>
      </select></td>
    </tr>
    </table>

    <table border="0" width="100%">
    <?php  $_smarty_tpl->tpl_vars['days'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['days']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['times']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['days']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['days']->key => $_smarty_tpl->tpl_vars['days']->value){
$_smarty_tpl->tpl_vars['days']->_loop = true;
 $_smarty_tpl->tpl_vars['days']->index++;
?>
    
    <tr align="center" BGCOLOR="#999999">
    	  <th class="k-header" style="padding-bottom:15px;padding-top:15px;"><?php echo $_smarty_tpl->tpl_vars['days']->key;?>
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
   <strong> * ข้อมูลที่ปรากฎอยู่ในตารางเรียนประกอบด้วย รหัสวิชา (จำนวนหน่วยกิต) กลุ่ม, ห้องเรียนและอาคาร ตามลำดับ</strong>
    <table width="55%" align="center" cellpadding="5" border="1">
    <tr class="k-header">
    <th colspan="5">รายละเอียดวิชาและกำหนดการสอบ</th>
    </tr>
  
    <tr class="k-header">
    <td width="14%" align="center">รหัสวิชา</td>
    <td width="32%" align="center">ชื่อรายวิชา</td>
    <td width="9%" align="center">กลุ่ม</td>
    <td width="22%" align="center">สอบกลางภาค</td>
    <td width="23%" align="center">สอบปลายภาค</td>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['classinfo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['classinfo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['classinfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['classinfo']->key => $_smarty_tpl->tpl_vars['classinfo']->value){
$_smarty_tpl->tpl_vars['classinfo']->_loop = true;
?>
      <tr>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['classinfo']->value['course_id'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['classinfo']->value['course_name'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['classinfo']->value['section'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['classinfo']->value['date_midexam'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['classinfo']->value['date_finalexam'];?>
</td>
    </tr>
    <?php } ?>
    </table>

</section>

<?php }?>
<div class="clear-all"></div>
</div>
</body>
</html>
<?php }} ?>