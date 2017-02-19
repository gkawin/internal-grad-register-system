<?php /* Smarty version Smarty-3.1.7, created on 2012-07-16 16:57:10
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\chk_track.html" */ ?>
<?php /*%%SmartyHeaderCode:250764f5254b6816a59-55073309%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ce5c533997fc6f26d3d9d91b94e0e0b37276a6b' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\chk_track.html',
      1 => 1342432628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '250764f5254b6816a59-55073309',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f5254b684ba3',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item' => 0,
    'res' => 0,
    'h' => 0,
    'nocrd' => 0,
    'exam_ce' => 0,
    'exam_fe' => 0,
    'exam_qe' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f5254b684ba3')) {function content_4f5254b684ba3($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
#titleMsg{ font-weight:bold;}
</style>
<div class="container"> <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="main"){?>
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
      <td><a href="/chk/tracking/graduatecheck/<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
" id="linkcolorblue"><strong> <?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
 </strong></a></td>
      <td><img src="/common/images/graduate/<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" width="64" height="64" style="margin-right:5px;float:left;"/> <?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
 <br>
        <?php echo $_smarty_tpl->tpl_vars['item']->value['stdNameEN'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['item']->value['edu_program'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['degree_name'];?>
</td>
      <td align="center"><?php switch ($_smarty_tpl->tpl_vars['item']->value['graduate_status']){?>
<?php case 0:?>
        <div style="color:#FF0000;font-weight:bold;">กำลังศึกษา</div>
        <?php break 1?>
        <?php case 1:?>
        <div style="color:#009900;font-weight:bold;">จบการศึกษา</div>
        <?php break 1?>
        <?php case 2:?>
        <div style="color:#333333;font-weight:bold;">ลาออก</div>
        <?php break 1?>
        <?php case 3:?>
        <div style="color:#3300FF;font-weight:bold;">รักษาสภาพ</div>
        <?php break 1?>
        <?php case 4:?>
        <div style="color:#663300;font-weight:bold;">รอการอนุมัติจบ</div>
        <?php break 1?>
        <?php }?></td>
    </tr>
    <?php } ?>
      </tbody>
    
  </table>
  </p>
  <div class="clear-all"></div>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="graduatecheck"){?> 
  <script>
 $(function(){
   $.post("/chk/tracking/graduatecheck/updatefront",
   { "graduateID": '<?php echo $_smarty_tpl->tpl_vars['res']->value['graduateID'];?>
',
   "statusGrad":$("div#statusGrad").attr("data-rel")
   },function(){})
 });
</script>
  <div style="padding:5pt;"><a href="/chk" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/chk/tracking" style="text-decoration:underline;">ติดตามและตรวจสอบจบ</a> > รายละเอียดการติดตามและตรวจสอบจบ</div>
  <p>
  <h1>ติดตามและตรวจสอบจบ</h1>
  <table width="50%" border="0" cellpadding="5" style="border:#000 solid 1px; background-color:#FFFFFF; float:left;">
    <tbody>
      <tr>
        <td width="38%" rowspan="7" align="center" valign="top"><img src="/common/images/graduate/<?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['image'];?>
" width="162" height="162"/></td>
        <td width="24%" id="titleMsg">ชื่อ :</td>
        <td width="38%"><?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['stdName'];?>
</td>
      </tr>
      <tr>
        <td id="titleMsg">รหัสนักศึกษา :</td>
        <td><?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['Graduate_ID'];?>
</td>
      </tr>
      <tr>
        <td id="titleMsg">หลักสูตร :</td>
        <td><?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['program_id'];?>

          <?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['program_name'];?>

          สาขา
          <?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['major_name'];?>
</td>
      </tr>
      <tr>
        <td id="titleMsg">แผน :</td>
        <td><?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['program_suite'];?>
</td>
      </tr>
      <tr>
        <td id="titleMsg">ระดับ :</td>
        <td><?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['degree_name'];?>
</td>
      </tr>
      <tr>
        <td id="titleMsg">คณะ :</td>
        <td><?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['fac_name'];?>
</td>
      </tr>
      <tr>
        <td id="titleMsg"><span style="color:#009;">ผลการตรวจสอบ :</span></td>
        <td> <?php if (($_smarty_tpl->tpl_vars['page']->value['eduInfo']['all_credit']-$_smarty_tpl->tpl_vars['row']->value['_pass_credit'])>0){?>
          <div style="color:#FF0000;font-weight:bold;" id="statusGrad" data-rel="0">กำลังศึกษา</div>
          <?php }elseif(($_smarty_tpl->tpl_vars['page']->value['eduInfo']['all_credit']-$_smarty_tpl->tpl_vars['row']->value['_pass_credit'])<=0){?>
          <?php if ($_smarty_tpl->tpl_vars['row']->value['examresult']&&$_smarty_tpl->tpl_vars['res']->value['_reg_nocredit']['result']&&$_smarty_tpl->tpl_vars['res']->value['_exam_qe']['result']&&$_smarty_tpl->tpl_vars['res']->value['_exam_fe']['result']&&$_smarty_tpl->tpl_vars['res']->value['_exam_ce']['result']){?>
          <div style="color:#FFCC00;font-weight:bold;" id="statusGrad" data-rel="4">รอการอนุมัติจบ</div>
          <?php }else{ ?>
          <div style="color:#FF0000;font-weight:bold;" id="statusGrad" data-rel="0">กำลังศึกษา</div>
          <?php }?>
          <?php }?></td>
      </tr>
      <tr>
        <th colspan="3" class="k-header" >หมวดหมู่ข้อมูลการศึกษา</th>
      </tr>
      <tr>
        <td id="titleMsg">หน่วยกิตขั้นต่ำของหลักสูตร :</td>
        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['eduInfo']['all_credit'];?>
 หน่วยกิต</td>
      </tr>
      <tr>
        <td id="titleMsg">หน่วยกิตที่ผ่าน :</td>
        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['row']->value['_pass_credit'];?>
          หน่วยกิต</td>
      </tr>
      <tr>
        <td id="titleMsg">หน่วยกิตที่รอ :</td>
        <td colspan="2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['page']->value['eduInfo']['all_credit'];?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['row']->value['_pass_credit'];?>
<?php $_tmp2=ob_get_clean();?><?php echo $_tmp1-$_tmp2;?>
 หน่วยกิต</td>
      </tr>
      <tr>
        <td id="titleMsg">ชั้นปีที่ :</td>
        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['_schoolyear']['School_Year'];?>
 </td>
      </tr>
      <tr>
        <td id="titleMsg">จำนวนปีที่เรียน :</td>
        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['eduInfo']['years_normal'];?>
 ปี</td>
      </tr>
      <tr>
        <td id="titleMsg">เรียนสูงสุด :</td>
        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['eduInfo']['max_years'];?>
 ปี</td>
      </tr>
      <tr>
        <th colspan="3" class="k-header">หมวดหมู่ข้อมูล GPA</th>
      </tr>
      <tr>
        <td id="titleMsg">GPA ต่ำสุด :</td>
        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['eduInfo']['minimum_gpa'];?>
</td>
      </tr>
      <tr>
        <td id="titleMsg">GPA ที่ได้ :</td>
        <td colspan="2"> <?php if ($_smarty_tpl->tpl_vars['page']->value['eduInfo']['minimum_gpa']>$_smarty_tpl->tpl_vars['row']->value['_gpax']){?> <span style="color:#F00;"><strong><?php echo $_smarty_tpl->tpl_vars['row']->value['_gpax'];?>
</strong> (ติดต่อนักศึกษาโดยด่วน)</span> <?php }else{ ?> <span style="color:#0C0;"><strong><?php echo $_smarty_tpl->tpl_vars['row']->value['_gpax'];?>
</strong></span> <?php }?> </td>
      </tr>
      <tr>
        <td id="titleMsg" valign="top">ออกใบระเบียนนักศึกษา :</td>
        <td colspan="2"><a href="/chk/transcript/docsexport/th/<?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['Graduate_ID'];?>
" target="_blank" class="k-button ex1" rel="th">คลิ๊กที่นี้เพื่อสร้างใบระเบียน (ภาษาไทย)<br />
          </a> <!--<a href="/chk/transcript/docsexport/en/<?php echo $_smarty_tpl->tpl_vars['page']->value['gradInfo']['Graduate_ID'];?>
" target="_blank" class="k-button ex1" rel="en">คลิ๊กที่นี้เพื่อสร้างใบระเบียน (English)</a>--></td>
      </tr>
    </tbody>
  </table>
  <table width="50%" border="0" cellpadding="5" style="border:#000 solid 1px; background-color:#FFFFFF; float:left;">
    
    <!--- SHOW WIDECARD ---> 
    <?php  $_smarty_tpl->tpl_vars['h'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['h']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_plan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value){
$_smarty_tpl->tpl_vars['h']->_loop = true;
?>
    <tr>
      <th colspan="3" class="k-header" align="left"> <span style="float:left;"><?php echo $_smarty_tpl->tpl_vars['h']->key;?>
</span> <?php if ($_smarty_tpl->tpl_vars['h']->key=="วิทยานิพนธ์"){?> <span style="float:right;"> [ผล : <?php if (($_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['_reged']<$_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['ct_credit'])||($_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['_pass']<$_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['ct_credit'])){?> <strong style="color:red;">FAIL</strong> <?php }else{ ?> <strong style="color:green;">PASS</strong> <?php }?> ] </span> <?php }else{ ?> <span style="float:right;"> [ผล : <?php if (($_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['_reged']<$_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['ct_credit'])||($_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['_pass']<$_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['ct_credit'])){?> <strong style="color:red;">FAIL</strong> <?php }else{ ?> <strong style="color:green;">PASS</strong> <?php }?> ] </span> <span style="float:right;"> [ลง : <?php if (empty($_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['_reged'])){?>0<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['_reged'];?>
<?php }?> หน่วยกิต ] </span> <span style="float:right;"> [ทั้งหมด : <?php echo $_smarty_tpl->tpl_vars['row']->value['_plandetails'][$_smarty_tpl->tpl_vars['h']->key]['ct_credit'];?>
 หน่วยกิต ] </span> <?php }?> </th>
    </tr>
    <tr bgcolor="#999999">
      <th width="53%" align="">วิชา</th>
      <th width="19%">เกรด</th>
      <th width="20%">ผล</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['h']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <?php if (isset($_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']])){?> <!-- วิชาได้ถูกกำหนด--> 
    <?php if ($_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['required_type']==1){?>
    <tr>
      <td> 
      <?php echo $_smarty_tpl->tpl_vars['item']->value['course_id'];?>

      <?php echo $_smarty_tpl->tpl_vars['item']->value['course_name'];?>
  <strong>(<?php echo $_smarty_tpl->tpl_vars['item']->value['credit'];?>
 หน่วยกิต)</strong>
      </td>
      <td align="center"> 
      	<?php echo $_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['result_grade'];?>
<br>
        <span style="font-size:9px;"> (<?php echo $_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['term'];?>
/<?php echo $_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['years']+543;?>
) </span></td>
      <td align="center"> <?php if ($_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['result_grade']=="F"){?> <span style="color:red;font-weight:bold;">FAIL</span> <?php }else{ ?> <span style="color:green;font-weight:bold;">PASS</span> <?php }?></td>
    </tr>
    <?php }else{ ?>
    <tr>
      <td> 
     <?php echo $_smarty_tpl->tpl_vars['item']->value['course_id'];?>

      <?php echo $_smarty_tpl->tpl_vars['item']->value['course_name'];?>
 <strong>(<?php echo $_smarty_tpl->tpl_vars['item']->value['credit'];?>
 หน่วยกิต)</strong>
      </td>
      <td align="center"> 
      	<?php echo $_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['result_grade'];?>
<br>
        <span style="font-size:9px;"> (<?php echo $_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['term'];?>
/<?php echo $_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['years']+543;?>
) </span></td>
      <td align="center"> <?php if ($_smarty_tpl->tpl_vars['row']->value['_reg'][$_smarty_tpl->tpl_vars['item']->value['course_id']]['result_grade']=="F"){?> <span style="color:red;font-weight:bold;">FAIL</span> <?php }else{ ?> <span style="color:green;font-weight:bold;">PASS</span> <?php }?></td>
    </tr>
    <?php }?>
    
    <?php }else{ ?>
  	<?php if ($_smarty_tpl->tpl_vars['item']->value['required_type']==1){?>
       <tr>
         <td>
         <?php echo $_smarty_tpl->tpl_vars['item']->value['course_id'];?>

      	 <?php echo $_smarty_tpl->tpl_vars['item']->value['course_name'];?>
 <strong>(<?php echo $_smarty_tpl->tpl_vars['item']->value['credit'];?>
 หน่วยกิต)</strong></td>
         <td align="center">-</td>
         <td align="center"><span style="color:red;font-weight:bold;">FAIL</span></td>
       </tr>
    <?php }else{ ?>
    <tr>
         <td colspan="3" align="center"><span style="font-size:11px;color:#FF0000;">ไม่พบข้อมูลลงทะเบียน</span></td>
       </tr>
       <?php break 1?>
    <?php }?>
    <?php }?>
    <?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
  
    <tr>
      <th colspan="3">ไม่พบข้อมูล</th>
    </tr>
    <?php } ?>
    
    <?php } ?>
    <tr>
      <th colspan="3" align="left" class="k-header"> <span style="float:left;">รายวิชาไม่คิดหน่วยกิต</span> <span style="float:right;"> <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['_reg_nocredit'])){?>
        
        
        [ผล : <?php if ($_smarty_tpl->tpl_vars['res']->value['_reg_nocredit']['result']==false){?> <strong style="color:red;">FAIL</strong> <?php }else{ ?> <strong style="color:green;">PASS</strong> <?php }?> ] </span> <?php }else{ ?>
        [ผล : <strong style="color:red;">FAIL</strong> ] </span> <?php }?> </th>
    </tr>
    <tr bgcolor="#999999">
      <th >วิชา</th>
      <th>เกรด</th>
      <th>ผล</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['nocrd'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nocrd']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_reg_nocredit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nocrd']->key => $_smarty_tpl->tpl_vars['nocrd']->value){
$_smarty_tpl->tpl_vars['nocrd']->_loop = true;
?>
    <tr>
      <td><?php echo $_smarty_tpl->tpl_vars['nocrd']->value['course_id'];?>
 <?php echo $_smarty_tpl->tpl_vars['nocrd']->value['course_name'];?>
 <strong>(<?php echo $_smarty_tpl->tpl_vars['nocrd']->value['credit'];?>
 หน่วยกิต)</strong></td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['nocrd']->value['result_grade'];?>
</td>
      <td align="center"> <?php if ($_smarty_tpl->tpl_vars['nocrd']->value['result_grade']=="S"){?> <span style="color:green;"><strong>PASS</strong></span> <?php }else{ ?> <span style="color:red;"><strong>FAIL</strong></span> <?php }?> </td>
    </tr>
    <?php }
if (!$_smarty_tpl->tpl_vars['nocrd']->_loop) {
?>
    <tr>
      <td colspan="3" align="center"><span style="font-size:11px;color:#FF0000;">ไม่พบข้อมูลลงทะเบียน</span></td>
    </tr>
    <?php } ?>
    <tr>
      <th colspan="3" class="k-header" align="left"><span style="float:left;">รายละเอียดผลการสอบประเภทต่าง</span> <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['_exam_ce'])&&!empty($_smarty_tpl->tpl_vars['row']->value['_exam_fe'])&&!empty($_smarty_tpl->tpl_vars['row']->value['_exam_qe'])){?> <span style="float:right;"> [ผล : <?php if (!$_smarty_tpl->tpl_vars['res']->value['_exam_qe']['result']||!$_smarty_tpl->tpl_vars['res']->value['_exam_fe']['result']||!$_smarty_tpl->tpl_vars['res']->value['_exam_ce']['result']){?> <strong style="color:red;">FAIL</strong> <?php }else{ ?> <strong style="color:green;">PASS</strong> <?php }?> ] </span> <?php }else{ ?> <span style="float:right;"> [ผล : <strong style="color:red;">FAIL</strong> ]</span> <?php }?> </th>
    </tr>
    <tr bgcolor="#999999">
      <th>ชื่อการทดสอบเกณฑ์</th>
      <th>ผล</th>
      <th>สอบเมื่อ</th>
    </tr>
    <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['_exam_ce'])&&!empty($_smarty_tpl->tpl_vars['row']->value['_exam_fe'])&&!empty($_smarty_tpl->tpl_vars['row']->value['_exam_qe'])){?>
    <?php  $_smarty_tpl->tpl_vars['exam_ce'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['exam_ce']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_exam_ce']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exam_ce']->key => $_smarty_tpl->tpl_vars['exam_ce']->value){
$_smarty_tpl->tpl_vars['exam_ce']->_loop = true;
?>
    <tr>
      <td><?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['exan_name'];?>

        ครั้งที่
        <?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['ce_num'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['ce_result'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['ce_date'];?>
</td>
    </tr>
    <?php } ?>
    <?php  $_smarty_tpl->tpl_vars['exam_fe'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['exam_fe']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_exam_fe']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exam_fe']->key => $_smarty_tpl->tpl_vars['exam_fe']->value){
$_smarty_tpl->tpl_vars['exam_fe']->_loop = true;
?>
    <tr>
      <td><?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['exan_name'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['fe_result'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['fe_date'];?>
</td>
    </tr>
    <?php } ?>
    <?php  $_smarty_tpl->tpl_vars['exam_qe'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['exam_qe']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_exam_qe']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exam_qe']->key => $_smarty_tpl->tpl_vars['exam_qe']->value){
$_smarty_tpl->tpl_vars['exam_qe']->_loop = true;
?>
    <tr>
      <td><?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['exan_name'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['qe_result'];?>
</td>
      <td align="center"><?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['qe_date'];?>
</td>
    </tr>
    <?php } ?>
    <?php }else{ ?>
    <tr>
      <td colspan="3" align="center"><span style="font-size:11px;color:#FF0000;">ไม่พบข้อมูลลงทะเบียน</span></td>
    </tr>
    <?php }?>
  </table>
  </p>
  <?php }?>
  <div class="clear-all"></div>
</div>
</body></html><?php }} ?>