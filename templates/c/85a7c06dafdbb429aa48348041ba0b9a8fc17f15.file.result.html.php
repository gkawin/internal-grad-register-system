<?php /* Smarty version Smarty-3.1.7, created on 2012-07-10 15:33:26
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\result.html" */ ?>
<?php /*%%SmartyHeaderCode:123154f3bc80c9c79b9-16354295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85a7c06dafdbb429aa48348041ba0b9a8fc17f15' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\result.html',
      1 => 1341908822,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123154f3bc80c9c79b9-16354295',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f3bc80cc6337',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item' => 0,
    'enroll' => 0,
    'result' => 0,
    'ncrd' => 0,
    'grade' => 0,
    'exam_ce' => 0,
    'exam_fe' => 0,
    'exam_qe' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f3bc80cc6337')) {function content_4f3bc80cc6337($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>

ul.token-input-list-facebook{
	width:455px;
}
</style>
<script>
$(function(){
	$(".treeView").each(function(index, element) {
            $(".treeView").kendoTreeView({ dragAndDrop: false});
        });
		$(function(){
			 $("#datePicker").kendoDatePicker({
				format : "yyyy-MM-dd"
			});
		});
});
function other(method,value){
	if(method==="exam_name"){
		var state = $("#other_name").is(":disabled");
		if(value==1){
			$("#other_name").show().removeAttr("disabled");
		}else{
			if(!state){
				$("#other_name").hide().attr("disabled","disabled");
			}
		}
	}else if(method=="fe_resulted_form"){
		var state = $("#fe_resulted_form").is(":disabled");
		if(value==1){
			$("#fe_resulted_form").show().removeAttr("disabled");
		}else{
			if(!state){
				$("#fe_resulted_form").hide().attr("disabled","disabled");
			}
		}
	}
}
</script> 

<!-- CONTENT -->
<div class="container">
  <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="main"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > ตัวเลือกจัดการผลการศึกษา</div>
  <p id="main">
  <form method="post">
    <p> กรุณาเลือกภาคการศึกษา
      <select name="term_semester">
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_semester']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <option>
        <?php echo $_smarty_tpl->tpl_vars['item']->value['term'];?>

        /
        <?php echo $_smarty_tpl->tpl_vars['item']->value['years']+543;?>

        </option>
        <?php } ?>
      </select>
    </p>

    <ul style="list-style:none;">
      <li>
        <button name="study_operaion" value="1" type="submit" class="k-button"><img src="/templates/skin/default/images/icon/results_icon.png" width="24" height="24" style="vertical-align:middle;"> จัดการผลการศึกษา</button>
      </li>
      <li >
        <button name="exam_operaion" value="0" type="submit"  class="k-button"><img src="/templates/skin/default/images/icon/exam_icon.png" width="24" height="24" style="vertical-align:middle;"> จัดการผลการสอบ</button>
      </li>
    </ul>
  </form>
  </p>
  <script>
$(function(){
	$("button").click(function(event){
		var oTemp = $("form").serialize();
		if($(this).val()==1){
			$("form").attr('action','/edu/result/study');
		}else{
			$("form").attr('action','/edu/result/exam');
		}
	});
});
  
  </script>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="study"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/result" style="text-decoration:underline;">ตัวเลือกจัดการผลการศึกษา ภาคเรียนที่
    <?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][0];?>

    ปีการศึกษา
    <?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][1]+543;?>

  </a> > จัดการผลการศึกษา</div>
  <p>
  <h2 style="color:#0000FF;text-decoration:underline;">รายชื่อนักศึกษาที่ลงทะเบียนในภาคเรียน
    <?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][0];?>

    ที่
    
    ปีการศึกษา
<?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][1]+543;?>

  </h2>
  <table id="tblist" border="0" cellpadding="5" width="100%">
    <thead class="k-header">
      <tr>
        <th width="77%">ชื่อ - สกุลนักศึกษา</th>
        <th width="23%">หลักสูตร</th>
      </tr>
    </thead>
    <tbody>
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_termStd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <tr>
        <td><ul class="treeView">
            <li><span style="display:block;">
              <?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>

              </span> <span style="display:block;">
              <?php echo $_smarty_tpl->tpl_vars['item']->value['stdNameEN'];?>

              </span>
              <ul>
                <table width="100%" bgcolor="#FFFFFF">
                  <thead class="k-header">
                    <tr>
                      <th colspan="6">รายวิชาที่ได้ลงทะเบียนในภาคการศึกษานี้</th>
                    </tr>
                  </thead>
                  <tr bgcolor="#CCCCCC">
                    <th width="53%">รายวิชา</th>
                    <th width="15%">กลุ่ม</th>
                    <th width="13%">หน่วยกิต</th>
                    <th width="19%">เกรด</th>
                  </tr>
                  <?php  $_smarty_tpl->tpl_vars['enroll'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['enroll']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_enroll']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['enroll']->key => $_smarty_tpl->tpl_vars['enroll']->value){
$_smarty_tpl->tpl_vars['enroll']->_loop = true;
?>
                  <?php if ($_smarty_tpl->tpl_vars['item']->value['Graduate_ID']==$_smarty_tpl->tpl_vars['enroll']->value['Graduate_ID']){?>
                  
                  <tr class="innerlist">
                    <td><?php echo $_smarty_tpl->tpl_vars['enroll']->value['course_id'];?>

                      <?php echo $_smarty_tpl->tpl_vars['enroll']->value['course_name'];?>
</td>
                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['enroll']->value['section'];?>
</td>
                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['enroll']->value['credit'];?>
</td>
                    <td><select onChange="changeValue(this,'<?php echo $_smarty_tpl->tpl_vars['enroll']->value['enroll_id'];?>
',null)">
                    <?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_chkresult']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
$_smarty_tpl->tpl_vars['result']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['result']->value['enroll_id']==$_smarty_tpl->tpl_vars['enroll']->value['enroll_id']){?>
                    <option selected><?php echo $_smarty_tpl->tpl_vars['result']->value['result_grade'];?>
</option>
                    <?php }?>
                    <?php } ?>
                    <option disabled>กรุณาเลือก</option>
                    <option>A</option>
                    <option>B+</option>
                    <option>B</option>
                    <option>C+</option>
                    <option>C</option>
                    <option>D+</option>
                    <option>D</option>
                    <option>F</option>
                    <option>I</option>
                    <option>W</option>
                    <option>OP</option>
                    <option>S</option>
                    <option>U</option>
                   
                   </select></td>
                  </tr>
                  
                  <?php }?>
                  
                  <?php } ?>
                   <?php  $_smarty_tpl->tpl_vars['ncrd'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ncrd']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_no_credit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ncrd']->key => $_smarty_tpl->tpl_vars['ncrd']->value){
$_smarty_tpl->tpl_vars['ncrd']->_loop = true;
?>
                  <?php if ($_smarty_tpl->tpl_vars['item']->value['Graduate_ID']==$_smarty_tpl->tpl_vars['ncrd']->value['Graduate_ID']){?>
                  <tr>
                    <td colspan="4" class="k-header">รายวิชาไม่คิดหน่วยกิต</td>
                  </tr>
                  <tr>
                    <td ><?php echo $_smarty_tpl->tpl_vars['ncrd']->value['course_id'];?>
 <?php echo $_smarty_tpl->tpl_vars['ncrd']->value['course_name'];?>
</td>
                    <td align="center"><?php echo $_smarty_tpl->tpl_vars['ncrd']->value['section'];?>
</td>
                    <td  align="center"><?php echo $_smarty_tpl->tpl_vars['ncrd']->value['credit'];?>
</td>
                    <td>
                    <select onChange="changeValue(this,<?php echo $_smarty_tpl->tpl_vars['ncrd']->value['id'];?>
,'ncrd')">
                    <?php  $_smarty_tpl->tpl_vars['grade'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['grade']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_storeGrade_ncrd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['grade']->key => $_smarty_tpl->tpl_vars['grade']->value){
$_smarty_tpl->tpl_vars['grade']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['grade']->value==$_smarty_tpl->tpl_vars['ncrd']->value['result_grade']){?>
                    <option selected><?php echo $_smarty_tpl->tpl_vars['grade']->value;?>
</option>
                    <?php }?>
                    <option><?php echo $_smarty_tpl->tpl_vars['grade']->value;?>
</option>
                    <?php } ?>
                   </select>
                    </td>
                    
                  </tr>
                  <?php }?>
                  <?php } ?>
                  <tr>
                    <td colspan="2" bgcolor="#CCCCCC">ลงทะเบียนทั้งหมด</td>
                    <td align="center" bgcolor="#CCCCCC"><?php echo $_smarty_tpl->tpl_vars['row']->value['total_credit'][$_smarty_tpl->tpl_vars['item']->value['Graduate_ID']];?>
</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </ul>
            </li>
          </ul></td>
        <td valign="top"><?php echo $_smarty_tpl->tpl_vars['item']->value['program_name'];?>

          สาขา
          <?php echo $_smarty_tpl->tpl_vars['item']->value['major_name'];?>
, <?php echo $_smarty_tpl->tpl_vars['item']->value['program_suite'];?>
</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </p>
  <script>
  function changeValue(o,enroll_id,type){
		if(!confirm("ยืนยันการเปลี่ยนแปลงข้อมูล")) return;
		$("#raw_point").removeAttr("disabled");
		var url = (type==null)? "/edu/result/study/gradeprocess" : "/edu/result/study/gradeprocess_n";
		$.post(url,
		{
			"grade_val":o.value,
			"enroll_id":enroll_id
		},function(res){
			if(res.result) alert("ทำรายการสำเร็จ")
		},'json')
	}
	function changeValue_exam(method,value,id){
		if(!confirm("ยืนยันการเปลี่ยนแปลงข้อมูล")) return;
	}
  </script>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="exam_landing"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/result" style="text-decoration:underline;">ตัวเลือกจัดการผลการศึกษา</a> > จัดการผลการสอบต่างๆ</div>
  <p>
<h2 style="color:#0000FF;text-decoration:underline;">รายชื่อนักศึกษาที่มีรายการสอบในภาคเรียนที่ 
    <?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][0];?>

     ปีการศึกษา
<?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][1]+543;?>

  </h2>
  <table id="tblist" border="0" cellpadding="5" width="100%">
    <thead class="k-header">
      <tr>
        <th width="61%">ชื่อ - สกุลนักศึกษา</th>
        <th width="16%">หลักสูตร</th>
        <th width="23%">ดำเนินการ</th>
      </tr>
    </thead>
    <tbody>
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_termStd']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <tr>
        <td><ul class="treeView">
            <li><span style="display:block;">
              <?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>

              </span> <span style="display:block;">
              <?php echo $_smarty_tpl->tpl_vars['item']->value['stdNameEN'];?>

              </span>
              <ul>
                <table width="100%" bgcolor="#FFFFFF">
                  <thead class="k-header">
                    <tr>
                      <th colspan="5">รายการสอบต่างๆ</th>
                    </tr>
                  </thead>
                  

                  <tr bgcolor="#CCCCCC">
                    <th>ชื่อรายการสอบ</th>
                    <th>สอบครั้งที่</th>
                    <th>สถานะ</th>
                    
                    <th>ผลการสอบ</th>
                    <th>ดำเนินการ</th>
                  </tr>
                  <?php  $_smarty_tpl->tpl_vars['exam_ce'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['exam_ce']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_exam_ce']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exam_ce']->key => $_smarty_tpl->tpl_vars['exam_ce']->value){
$_smarty_tpl->tpl_vars['exam_ce']->_loop = true;
?>
                  <?php if ($_smarty_tpl->tpl_vars['exam_ce']->value['Graduate_ID']==$_smarty_tpl->tpl_vars['item']->value['Graduate_ID']){?>
                  <tr>
                    <td width="65%"><?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['exan_name'];?>
</td>
                    <td width="16%" align="center"><?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['ce_num'];?>
</td>
                    <td width="19%" align="center"><?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['status1'];?>
</td>
                    
                    <td width="19%" align="center">
                    <?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['ce_result'];?>

                    </td>
                    <td width="19%" align="left">
                    <ul class="ulmenu">
                    <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:baseline;"><a href="/edu/result/exam/ceedit?ceid=<?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['ce_id'];?>
&gradexamid=<?php echo $_smarty_tpl->tpl_vars['exam_ce']->value['grad_exam_id'];?>
&gradid=<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
&gradname=<?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
" target="_blank" >แก้ไข</a></li>
                    </ul>
                    </td>
                  </tr>
                  <?php }?>
                  <?php } ?>
                  <?php  $_smarty_tpl->tpl_vars['exam_fe'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['exam_fe']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_exam_fe']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exam_fe']->key => $_smarty_tpl->tpl_vars['exam_fe']->value){
$_smarty_tpl->tpl_vars['exam_fe']->_loop = true;
?>
                  <?php if ($_smarty_tpl->tpl_vars['exam_fe']->value['Graduate_ID']==$_smarty_tpl->tpl_vars['item']->value['Graduate_ID']){?>
                  <tr>
                    <td width="65%"><?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['exan_name'];?>
</td>
                    <td width="16%" align="center"><?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['fe_num'];?>
</td>
                    <td width="19%" align="center"><?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['status1'];?>
</td>
                    
                    <td width="19%" align="center">
                    <?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['fe_result'];?>

                    </td>
                    <td width="19%" align="center"> <ul class="ulmenu">
                    <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:baseline;"><a href="/edu/result/exam/feedit?feid=<?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['fe_id'];?>
&gradexamid=<?php echo $_smarty_tpl->tpl_vars['exam_fe']->value['grad_exam_id'];?>
&gradid=<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
&gradname=<?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
" target="_blank" >แก้ไข</a></li>
                    </ul></td>
                  </tr>
                  <?php }?>
                  <?php } ?>
                  <?php  $_smarty_tpl->tpl_vars['exam_qe'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['exam_qe']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_exam_qe']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exam_qe']->key => $_smarty_tpl->tpl_vars['exam_qe']->value){
$_smarty_tpl->tpl_vars['exam_qe']->_loop = true;
?>
                  <?php if ($_smarty_tpl->tpl_vars['exam_qe']->value['Graduate_ID']==$_smarty_tpl->tpl_vars['item']->value['Graduate_ID']){?>
                  <tr>
                    <td width="65%"><?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['exan_name'];?>
</td>
                    <td width="16%" align="center"><?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['qe_num'];?>
</td>
                    <td width="19%" align="center"><?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['status1'];?>
</td>
                    
                    <td width="19%" align="center">
                     <?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['qe_result'];?>

                    </td>
                    <td width="19%" align="center"> <ul class="ulmenu">
                    <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:baseline;"><a href="/edu/result/exam/qeedit?qeid=<?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['qe_id'];?>
&gradexamid=<?php echo $_smarty_tpl->tpl_vars['exam_qe']->value['grad_exam_id'];?>
&gradid=<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
&gradname=<?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
" target="_blank" >แก้ไข</a></li>
                    </ul></td>
                  </tr>
                  <?php }?>
                  <?php } ?>
                </table>
              </ul>
            </li>
          </ul></td>
        <td valign="top"><?php echo $_smarty_tpl->tpl_vars['item']->value['program_name'];?>

          ,
          <?php echo $_smarty_tpl->tpl_vars['item']->value['program_suite'];?>
</td>
        <td valign="top">
        <ul class="ulmenu">
        	<li><img src="/templates/skin/HTML5 Admin Template/images/icn_new_article.png" style="vertical-align:middle;"> <a href="/edu/result/exam/cenew?termid=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&term=<?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][0];?>
&years=<?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][1];?>
&gradid=<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
&gradname=<?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
" target="_blank" >เพิ่มผลการสอบประมวลความรู้</a></li>
            <li>
            <img src="/templates/skin/HTML5 Admin Template/images/icn_new_article.png" style="vertical-align:middle;"> <a href="/edu/result/exam/fenew?termid=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
term=<?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][0];?>
&years=<?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][1];?>
&gradid=<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
&gradname=<?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
" target="_blank" >เพิ่มผลการสอบภาษาต่างประเทศ</a>
            </li>
            <?php if ($_smarty_tpl->tpl_vars['item']->value['degree_level_name']=="ปริญญาเอก"){?>
            <li>
            <img src="/templates/skin/HTML5 Admin Template/images/icn_new_article.png" style="vertical-align:middle;"> <a href="/edu/result/exam/qenew?termid=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
&term=<?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][0];?>
&years=<?php echo $_smarty_tpl->tpl_vars['row']->value['splitterm'][1];?>
&gradid=<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
&gradname=<?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
" target="_blank" >เพิ่มผลการสอบวัดคุณสมบัติ</a>
            </li>
            <?php }?>
        </ul>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </p>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="exam_ce"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/result" style="text-decoration:underline;">ตัวเลือกจัดการผลการศึกษา</a> > <a href="#" onClick="history.go(-1)" style="text-decoration:underline;">จัดการผลการสอบต่างๆ</a> &gt; บันทึกรายการสอบ ผลการสอบประมวลความรู้</div>
  <p id="exam_ce">
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback'])){?>
  <p id="landing"><?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>ปิดหน้าต่างนี้ <a href="#"  onClick=" window.close()">คลิ๊กที่นี้</a></p>
  <?php }?>
  
  <h2>ใบบันทึกรายการสอบ ผลการสอบประมวลความรู้</h2>

  <form method="post" action="">
<input type="hidden" name="ce_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['ceid'];?>
">
 <input type="hidden" name="grad_exam_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradexamid'];?>
">	<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF">
          <tr>
            <td>ชื่อผู้บันทึก :</td>
            <td colspan="3" ><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
          </tr>
      <tr>
            <td width="14%">ชื่อผู้สอบ :</td>
            <td colspan="3" ><?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradid'];?>
: <?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradname'];?>
</td>
          </tr>
          <tr>
            <td>รายการสอบ :</td>
            <td width="33%" ><input type="text" name="exam_name" readonly value="สอบประมวลความรู้" class="k-textbox"></td>
            <td width="11%">ครั้งที่ :</td>
            <td width="42%"><input name="ce_num" type="text" required class="k-textbox" value="<?php if (!empty($_smarty_tpl->tpl_vars['res']->value['ce_count'])){?><?php echo $_smarty_tpl->tpl_vars['res']->value['ce_count'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_num'];?>
<?php }?>"  size="6" readonly></td>
          </tr>
          <tr>
            <td>สอบวันที่ :</td>
            <td><input name="ce_date" type="text" id="datePicker" required value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_date'];?>
"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>ผลการสอบ :</td>
            <td><select name="ce_result">
             <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_result']=="U"){?>
                    <option >S</option>
                    <option selected>U</option>
                    <option>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_result']=="S"){?>
                    <option selected>S</option>
                    <option >U</option>
                    <option>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_result']=="OP"){?>
                    <option >S</option>
                    <option >U</option>
                    <option selected>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_result']=="I"){?>
                     <option >S</option>
                    <option >U</option>
                    <option >OP</option>
                    <option selected>I</option>
                    <?php }else{ ?>
                    <option selected>S</option>
                    <option >U</option>
                    <option >OP</option>
                    <option >I</option>
                    <?php }?>
            </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th colspan="4" class="k-header">ผลคะแนนสอบตามประเภทต่างๆ</th>
          </tr>
          <tr>
            <td>สอบข้อเขียน :</td>
            <td><input name="ce_result_writing" type="text" required class="k-textbox" size="6" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_result_writing'];?>
" onKeyUp="checkDex(this)"></td>
            <td>สอบปากเปล่า :</td>
            <td><input name="ce_result_oral" type="text" required class="k-textbox" size="6" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_result_oral'];?>
" onKeyUp="checkDex(this)"></td>
          </tr>
          <tr>
            <td>สอบปฎิบัติ :</td>
            <td><input name="ce_result_lab" type="text" required class="k-textbox" size="6" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_ce']['ce_result_lab'];?>
" onKeyUp="checkDex(this)"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>สถานะการสอบ :</td>
            <td><select name="status">
            <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_ce']['status']==1){?>
              <option value="1" selected>สอบแล้ว</option>
              <option value="0">ยังไม่ได้สอบ</option>
              <option value="2">ไม่ชำระเงิน</option>
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_ce']['status']==0){?>
            	<option value="1" >สอบแล้ว</option>
              <option value="0" selected>ยังไม่ได้สอบ</option>
              <option value="2">ไม่ชำระเงิน</option>
            <?php }else{ ?>
            <option value="1">สอบแล้ว</option>
              <option value="0">ยังไม่ได้สอบ</option>
              <option value="2" >ไม่ชำระเงิน</option>
            <?php }?>
            </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th colspan="4"><input name="operation" type="submit" value="บันทึกข้อมูล" onClick="return comfirm('ยืนยังการบันทึก')" required></th>
          </tr>
        </table>
  </form>
    </p>
 
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="exam_fe"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/result" style="text-decoration:underline;">ตัวเลือกจัดการผลการศึกษา</a> > <a href="#" onClick="history.go(-1) "style="text-decoration:underline;">จัดการผลการสอบต่างๆ</a> &gt; บันทึกรายการสอบ ผลการภาษาต่างประเทศ</div>
  <p id="exam_fe">
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback'])){?>
  <p id="landing"><?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>ปิดหน้าต่างนี้ <a href="#"  onClick=" window.close()">คลิ๊กที่นี้</a></p>
  <?php }?>
  <h2>ใบบันทึกรายการสอบ ผลการภาษาต่างประเทศ</h2>
  <form method="post" action="">
<input type="hidden" name="fe_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['feid'];?>
">
  <input type="hidden" name="grad_exam_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradexamid'];?>
">
    	<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF">
          <tr>
            <td>ชื่อผู้บันทึก :</td>
            <td colspan="3" ><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
          </tr>
          <tr>
            <td width="14%">ชื่อผู้สอบ</td>
            <td colspan="3" ><?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradid'];?>
: <?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradname'];?>
</td>
          </tr>
          <tr>
            <td>รายการสอบ :</td>
            <td width="33%" >
            
            <select name="exam_name" onChange="other('exam_name',this.value)">
            <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['exan_name']=="สอบ TOEIC"){?>
            <option selected>สอบ TOEIC</option>
            <option>สอบ TOFEL</option>
            <option value="1">อื่นๆ โปรดระบุ</option>
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['exan_name']=="สอบ TOFEL"){?>
            <option >สอบ TOEIC</option>
            <option selected>สอบ TOFEL</option>
            <option value="1">อื่นๆ โปรดระบุ</option>
            <?php }else{ ?>
            <option >สอบ TOEIC</option>
            <option >สอบ TOFEL</option>
            <option value="1"  >อื่นๆ โปรดระบุ</option>
            <?php }?>
            </select>
            <input type="text" id="other_name"  name="exam_name" <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['exan_name']=='สอบ TOEIC'||$_smarty_tpl->tpl_vars['row']->value['_exan_fe']['exam_name']=='สอบ TOFEL'){?>disabled<?php }?> style="display:<?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['exan_name']=='สอบ TOEIC'||$_smarty_tpl->tpl_vars['row']->value['_exan_fe']['exam_name']=='สอบ TOFEL'){?>none<?php }?>;" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_fe']['exan_name'];?>
" class="k-textbox" ></td>
            <td width="11%">ครั้งที่ :</td>
            <td width="42%"><input name="fe_num" type="text" required class="k-textbox" value="<?php if (!empty($_smarty_tpl->tpl_vars['res']->value['fe_count'])){?><?php echo $_smarty_tpl->tpl_vars['res']->value['fe_count'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_num'];?>
<?php }?>" size="6" readonly></td>
          </tr>
          <tr>
            <td>สอบวันที่ :</td>
            <td><input name="fe_date" type="text" id="datePicker" required value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_date'];?>
"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>ผลการสอบ :</td>
            <td><select name="fe_result">
            <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_result']=="U"){?>
                    <option >S</option>
                    <option selected>U</option>
                    <option>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_result']=="S"){?>
                    <option selected>S</option>
                    <option >U</option>
                    <option>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_result']=="OP"){?>
                    <option >S</option>
                    <option >U</option>
                    <option selected>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_result']=="I"){?>
                     <option >S</option>
                    <option >U</option>
                    <option >OP</option>
                    <option selected>I</option>
                    <?php }else{ ?>
                    <option selected>S</option>
                    <option >U</option>
                    <option >OP</option>
                    <option >I</option>
                    <?php }?>
            </select>
            </td>
            <td>คะแนนดิบ :</td>
            <td><input name="fe_raw_result" type="text" maxlength="3" size="6" class="k-textbox" required value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_raw_result'];?>
" onKeyUp="checkDex(this)"></td>
          </tr>
          <tr>
            <td>สถานที่สอบ :</td>
            <td><select name="fe_resulted_form" onChange="other('fe_resulted_form',this.value)">
            <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_resulted_form']=="จัดสอบภายในมหาวิทยาลัย"){?>
              <option selected>จัดสอบภายในมหาวิทยาลัย</option>
              <option value="1">สถานที่สอบอื่นๆ โปรดระบุ</option>
            <?php }else{ ?>
            	<option >จัดสอบภายในมหาวิทยาลัย</option>
              <option value="1" selected>สถานที่สอบอื่นๆ โปรดระบุ</option>
            <?php }?>
            </select>
              <br>
            <input type="text" name="fe_resulted_form" class="k-textbox" <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_resulted_form']=='จัดสอบภายในมหาวิทยาลัย'){?> disabled <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_resulted_form'];?>
"  style="display:<?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['fe_resulted_form']=='จัดสอบภายในมหาวิทยาลัย'){?>none;<?php }else{ ?><?php }?>" id="fe_resulted_form"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>สถานะการสอบ :</td>
            <td><select name="status">
              <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['status']==1){?>
              <option value="1" selected>สอบแล้ว</option>
              <option value="0">ยังไม่ได้สอบ</option>
              <option value="2">ไม่ชำระเงิน</option>
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_fe']['status']==0){?>
            	<option value="1" >สอบแล้ว</option>
              <option value="0" selected>ยังไม่ได้สอบ</option>
              <option value="2">ไม่ชำระเงิน</option>
            <?php }else{ ?>
            <option value="1">สอบแล้ว</option>
              <option value="0">ยังไม่ได้สอบ</option>
              <option value="2" selected>ไม่ชำระเงิน</option>
            <?php }?>
            </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th colspan="4"><input name="operation" type="submit" value="บันทึกข้อมูล" required></th>
          </tr>
        </table>
  </form>
    </p>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="exam_qe"){?>
  	<div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/result" style="text-decoration:underline;">ตัวเลือกจัดการผลการศึกษา</a> > <a href="#" onClick="history.go(-1)" style="text-decoration:underline;">จัดการผลการสอบต่างๆ</a> &gt; บันทึกรายการสอบ ผลการสอบวัดคุณสมบัติ</div>
  <p id="exam_qe">
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback'])){?>
  <p id="landing"><?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>ปิดหน้าต่างนี้ <a href="#"  onClick=" window.close()">คลิ๊กที่นี้</a></p>
  <?php }?>
  <h2>ใบบันทึกรายการสอบ ผลการสอบวัดคุณสมบัติ (เฉพาะนักศึกษาปริญญาเอก)</h2>
  <form method="post" action="">
<input type="hidden" name="qe_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['qeid'];?>
">
  <input type="hidden" name="grad_exam_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradexamid'];?>
">
    	<table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF">
          <tr>
            <td>ชื่อผู้บันทึก :</td>
            <td colspan="3" ><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
          </tr>
          <tr>
            <td width="17%">ชื่อผู้สอบ</td>
            <td colspan="3" ><?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradid'];?>
: <?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['gradname'];?>
</td>
          </tr>
          <tr>
            <td>รายการสอบ :</td>
            <td width="32%" ><input type="text" readonly value="สอบวัดคุณสมบัติ" class="k-textbox" name="exam_name"></td>
            <td width="14%">ครั้งที่ :</td>
            <td width="37%"><input name="qe_num" type="text" required class="k-textbox" value="<?php if (!empty($_smarty_tpl->tpl_vars['res']->value['qe_count'])){?><?php echo $_smarty_tpl->tpl_vars['res']->value['qe_count'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_num'];?>
<?php }?>" size="6"></td>
          </tr>
          <tr>
            <td>สอบวันที่ :</td>
            <td><input name="qe_date" type="text" id="datePicker" required value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_date'];?>
"></td>
            <td>รายนามคณะกรรมการ :</td>
            <td><textarea name="qe_committee_list" cols="40" rows="3" required class="k-textbox"><?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_committee_list'];?>
</textarea></td>
          </tr>
          <tr>
            <td>ผลการสอบ :</td>
            <td><select name="qe_result">
              <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_result']=="U"){?>
                    <option >S</option>
                    <option selected>U</option>
                    <option>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_result']=="S"){?>
                    <option selected>S</option>
                    <option >U</option>
                    <option>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_result']=="OP"){?>
                    <option >S</option>
                    <option >U</option>
                    <option selected>OP</option>
                    <option>I</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_result']=="I"){?>
                     <option >S</option>
                    <option >U</option>
                    <option >OP</option>
                    <option selected>I</option>
                    <?php }else{ ?>
                    <option selected>S</option>
                    <option >U</option>
                    <option >OP</option>
                    <option >I</option>
                    <?php }?>
            </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th colspan="4" class="k-header">ผลคะแนนสอบตามประเภทต่างๆ</th>
          </tr>
          <tr>
            <td>สอบข้อเขียน :</td>
            <td><input name="qe_result_writing" type="text" required class="k-textbox" size="6" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_result_writing'];?>
" onKeyUp="checkDex(this)"></td>
            <td>สอบปากเปล่า :</td>
            <td><input name="qe_result_oral" type="text" required class="k-textbox" size="6" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_exam_qe']['qe_result_oral'];?>
" onKeyUp="checkDex(this)"></td>
          </tr>
          <tr>
            <td>สถานะการสอบ :</td>
            <td><select name="status">
              <?php if ($_smarty_tpl->tpl_vars['row']->value['_exam_qe']['status']==1){?>
              <option value="1" selected>สอบแล้ว</option>
              <option value="0">ยังไม่ได้สอบ</option>
              <option value="2">ไม่ชำระเงิน</option>
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_exam_qe']['status']==0){?>
            	<option value="1" >สอบแล้ว</option>
              <option value="0" selected>ยังไม่ได้สอบ</option>
              <option value="2">ไม่ชำระเงิน</option>
            <?php }else{ ?>
            <option value="1">สอบแล้ว</option>
              <option value="0">ยังไม่ได้สอบ</option>
              <option value="2" >ไม่ชำระเงิน</option>
            <?php }?>
            </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <th colspan="4"><input name="operation" type="submit" value="บันทึกข้อมูล" required></th>
          </tr>
        </table>
  </form>
    </p>
  <?php }?>
  <div class="clear-all"></div>
</div>
</body>
</html><?php }} ?>