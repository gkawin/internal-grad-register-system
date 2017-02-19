<?php /* Smarty version Smarty-3.1.7, created on 2012-07-02 21:36:32
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\course.html" */ ?>
<?php /*%%SmartyHeaderCode:292304f166064cc5982-56990548%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52c2e91026e73ac6b9446656fad461414a3ea1ed' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\course.html',
      1 => 1341239773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '292304f166064cc5982-56990548',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f166064df53e',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'itemSection' => 0,
    '_section' => 0,
    'microItem' => 0,
    'res' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f166064df53e')) {function content_4f166064df53e($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
.toolbar ul {
	list-style:none;padding:0;
}
.toolbar li{ display:inline;}
ul.token-input-list-facebook{
	width:455px;
}
</style>
<script>
$(function(){
	$(".delCourse").click(function(){
		if(confirm("คุณต้องการลบข้อมูลรายวิชาทั้งหมดหรือไม่")){
			/*check Course*/
			var courseid = $(this).attr("rel");
			$this = $(this);
			$.post('/edu/course',{ "deltype":"<?php ob_start();?><?php echo md5('chkpil');?>
<?php $_tmp1=ob_get_clean();?><?php echo sha1($_tmp1);?>
","courseid":courseid},function(data){
				if(data.result){
					if(confirm("โปรดระวัง มีกลุ่มเรียนบรรจุอยู่ในหลักสูตร คุณต้องการลบข้อมูลรายวิชและข้อมูลกลุ่มเรียนทั้งหมดหรือไม่")){
						$.post('/edu/course',{ "deltype":"<?php ob_start();?><?php echo md5('confirmdel');?>
<?php $_tmp2=ob_get_clean();?><?php echo sha1($_tmp2);?>
","courseid":courseid},function(data){
							if(data.result){
								$this.parents("tr").fadeOut("fast", function(){
								$this.parents("tr").remove();
								});
							}
						},'json')
					}else{
						return false;
					}
				}else{
					$.post('/edu/course',{ "deltype":"<?php ob_start();?><?php echo md5('confirmdel');?>
<?php $_tmp3=ob_get_clean();?><?php echo sha1($_tmp3);?>
","courseid":courseid},function(data){
						if(data.result){
							$this.parents("tr").fadeOut("fast", function(){
							$this.parents("tr").remove();
							});
						}
						},'json')
				}
			},'json')
		}
	});	

	$(".delSection").click(function(event){
		var sBin = $(this).attr("rel");
		$this = $(this);
		
		if(!confirm("คุณต้องการลบกลุ่มเรียนหรือไม่"))return;
			$.post("/edu/course",{ "deltype":"<?php ob_start();?><?php echo md5('secdel');?>
<?php $_tmp4=ob_get_clean();?><?php echo sha1($_tmp4);?>
","section_id":sBin,"section":$this.attr("data-id"),"course_id":$this.attr("data-rel")},
			function(data){
				if(data.result){
					$this.parents("tr.innersection").fadeOut('slow',
					function(){
						$this.parents("tr.innersection").remove();
					});
				}
			},"json");
	});
});

	function callPrefixCourse(value){
		$.post("/edu/course",{ "callprefix":1,"data":value},
		function(data){
			$("#course_id_prefix").attr("value",data.prefix_name).removeAttr("disabled");
			$("#course_id_prefixEN").attr("value",data.prefix_nameEN).removeAttr("disabled");
			
		},'json');
	}	
	function copyValueChk(o){
		document.getElementById('course_id_postfixEN').value = o.value;
		var filter = /^[0-9]*$/;
		if(!filter.test(o.value)) {
			alert('ขออภัย กรุณาป้อนตัวเลขเท่านั้น');
			o.value = '';
			o.focus();
			return false;
		}else{
			if(o.value.length == 3){
				var sBin = $('#course_id_prefix').val()+o.value
				$("#status_bar").html('<img src="../../../common/images/icons/loading.gif" align="absmiddle">&nbsp;Checking availability...');
				$.ajax({  
				type: "POST",  
				url: "/edu/course",  
				data: "chkAvaliable="+ sBin,  
				success: 
					function(msg){
							$("#status_bar").ajaxComplete(function(event, request, settings){ 
							if(msg == 'OK'){ 
								$(this).html('&nbsp;<img src="../../../common/images/icons/accepted.png" align="absmiddle"> <font color="Green"> Available </font>');
								return true;
							}else{  
								$(this).html(msg);
								return false;
							}   
						});
					}
				});
			}
		}
	}
</script> 
<script>
$(function(){
	function a(){
		var pre = '<?php echo $_smarty_tpl->tpl_vars['page']->value['courseBefore'];?>
';
		if(pre=='')
			return  null;
		else
			var json = eval('('+pre+')');
			return json;
	}
	$("input[name=course_before]").tokenInput("/service/callbackJson?module=course", 
		{ 	theme: "facebook",
			preventDuplicates: true,
          	propertyToSearch: "id",
			prePopulate: a(),
			resultsFormatter: 
				function(item){ 
				return "<li><div style='display: inline-block;'><div class='course_name'>" + item.id + " : " + item.course_name + "</div><div class='course_nameEN'>" + item.course_idEN + " : " + item.course_nameEN + "</div></div></li>" 
				}
		});
	
	
	 function startChange() {
        var startDate = start.value();

                        if (startDate) {
                            startDate = new Date(startDate);
                            startDate.setDate(startDate.getDate() + 1);
                            end.min(startDate);
                        }
                    }

                    function endChange() {
                        var endDate = end.value();

                        if (endDate) {
                            endDate = new Date(endDate);
                            endDate.setDate(endDate.getDate() - 1);
                            start.max(endDate);
                        }
                    }

                    var start = $("input[name=date_midterm]").kendoDatePicker({
                        change: startChange,
						format: "yyyy-MM-dd"
                    }).data("kendoDatePicker");

                    var end = $("input[name=date_final]").kendoDatePicker({
                        change: endChange,
						format: "yyyy-MM-dd"
                    }).data("kendoDatePicker");

                   // start.max(end.value());
                    //end.min(start.value());

	
});
	
</script> 
<!-- CONTENT -->
<div class="container">
  <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการวิชา</div>
  <section>
    <ul style="padding:0;">
      <li class="k-button"><a href="/edu/course/form/new" class="add_new_icon ex1">เพิ่มวิชาเรียนใหม่</a></li>
      <!--<li><a href="/edu/course/sectionduty" id="ldel" class="k-button">ภาระการเรียนการสอน</a></li>-->
    </ul>
    <table  width="100%" cellpadding="3" class="tblists" id="tblist">
      <thead class="k-header">
        <tr>
          <th width="67%"  style="text-align: left">ชื่อวิชา</th>
          <th width="16%"  style="text-align: center">ชั่วโมง<br>
            (บรรยาย - ปฎิบัติ)</th>
          <th width="6%"  style="text-align: center">หน่วยกิต</th>
          <th width="11%"  style="text-align: center">ดำเนินการ</th>
        </tr>
      </thead>
      <tbody>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr class="rowhl" valign="top">
          <td style="text-align: left"><ul class="treeView">
              <li><span style="display:block;">
                <?php echo $_smarty_tpl->tpl_vars['row']->value['course_id'];?>

                <?php echo $_smarty_tpl->tpl_vars['row']->value['course_name'];?>

                </span> <span style="display:block;">
                <?php echo $_smarty_tpl->tpl_vars['row']->value['course_idEN'];?>

                <?php echo $_smarty_tpl->tpl_vars['row']->value['course_nameEN'];?>

                </span>
                <ul>
                  <table width="100%" bgcolor="#FFFFFF">
                    <thead class="k-header">
                      <tr>
                        <th width="13%">กลุ่มเรียน</th>
                        <th width="21%">สำหรับสาขา</th>
                        <th width="23%">ประเภทวิชา</th>
                        <th width="9%">ที่นั่ง</th>
                        <th width="15%">ลง</th>
                        <th width="19%">ดำเนินการ</th>
                      </tr>
                    </thead>
                    
                    <?php  $_smarty_tpl->tpl_vars['itemSection'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itemSection']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_section']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itemSection']->key => $_smarty_tpl->tpl_vars['itemSection']->value){
$_smarty_tpl->tpl_vars['itemSection']->_loop = true;
?>
                    
                    <?php if ($_smarty_tpl->tpl_vars['itemSection']->key==$_smarty_tpl->tpl_vars['row']->value['course_id']){?>
                     <?php  $_smarty_tpl->tpl_vars['_section'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_section']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['itemSection']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_section']->key => $_smarty_tpl->tpl_vars['_section']->value){
$_smarty_tpl->tpl_vars['_section']->_loop = true;
?>
                    <tr>
                      <td colspan="7" bgcolor="#CCCCCC" style="font-weight:bold;text-decoration:underline;"><?php echo $_smarty_tpl->tpl_vars['_section']->key;?>
</td>
                    </tr>
                   <?php  $_smarty_tpl->tpl_vars['microItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['microItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['_section']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['microItem']->key => $_smarty_tpl->tpl_vars['microItem']->value){
$_smarty_tpl->tpl_vars['microItem']->_loop = true;
?>
                    <tr class="innersection">
                      <td align="center"><?php echo $_smarty_tpl->tpl_vars['microItem']->value['section'];?>
</td>
                      <td align="left"><?php echo $_smarty_tpl->tpl_vars['microItem']->value['formajor'];?>
</td>
                      <td align="center"><?php echo $_smarty_tpl->tpl_vars['microItem']->value['category'];?>
</td>
                      <td align="center"><?php echo $_smarty_tpl->tpl_vars['microItem']->value['total_seat'];?>
</td>
                      <td align="center"><?php echo $_smarty_tpl->tpl_vars['microItem']->value['seat'];?>
</td>
                      <td align="left"><ul class="ulmenu">
                          <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"><a href="/edu/course/section/edit?courseid=<?php echo $_smarty_tpl->tpl_vars['microItem']->value['course_id'];?>
&sectionid=<?php echo $_smarty_tpl->tpl_vars['microItem']->value['secid'];?>
&section=<?php echo $_smarty_tpl->tpl_vars['microItem']->value['section'];?>
"> แก้ไข</a></li>
                          <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"><a href="#" class="delSection" rel="<?php echo $_smarty_tpl->tpl_vars['microItem']->value['secid'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['course_id'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['microItem']->value['section'];?>
"> ลบ</a></li>
                          <!--<li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"><a href="/edu/course/section/schedule?secid=<?php echo $_smarty_tpl->tpl_vars['_section']->value['secid'];?>
&section=<?php echo $_smarty_tpl->tpl_vars['_section']->value['section'];?>
&degtype=<?php echo $_smarty_tpl->tpl_vars['_section']->value['deg_id'];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['_section']->value['course_id'];?>
"> กำหนดเวลา</a></li>-->
                        </ul></td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                    <?php }?>
                    <?php } ?>
                  </table>
                </ul>
              </li>
            </ul></td>
          <td style="text-align: center" valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['lecture'];?>

            -
            <?php echo $_smarty_tpl->tpl_vars['row']->value['practice'];?>
</td>
          <td style="text-align: center" valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['credit'];?>
</td>
          <td valign="top"><ul class="ulmenu">
              <li><img src="/templates/skin/HTML5 Admin Template/images/icn_new_article.png" style="vertical-align:middle;"> <a href="/edu/course/section/new?courseid=<?php echo $_smarty_tpl->tpl_vars['row']->value['course_id'];?>
">sec. ใหม่</a></li>
              <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/course/form/edit?courseid=<?php echo $_smarty_tpl->tpl_vars['row']->value['course_id'];?>
">แก้ไขวิชา</a></li>
              <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"> <a href="#" class="delCourse" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['course_id'];?>
">ลบวิชา</a></li>
            </ul></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/course" style="text-decoration:underline;">จัดการวิชา</a> >
    <?php if (empty($_smarty_tpl->tpl_vars['page']->value['editAll'])){?>
    เพิ่มวิชาใหม่
    <?php }else{ ?>
    แก้ไขวิชา
    <?php }?>
  </div>
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
  <p id="landing">
    <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>

    <br>
    หากต้องการสร้างกลุ่มเรียนใหม่ กรุณา <a href="/edu/course/section/new?courseid=<?php echo $_smarty_tpl->tpl_vars['res']->value['addid'];?>
">คลิ๊กที่นี้</a>
    <?php }?>
  <div>
    <form id="addnew" method="post" action="">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:#000000 solid 1px;">
          <thead class="k-header">
            <tr>
              <th colspan="2" scope="col" >แบบฟอร์มบันทึก และแก้ไขประเภทรายวิชา</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td width="22%"><?php if (empty($_smarty_tpl->tpl_vars['page']->value['editAll'])){?>
                ชื่อผู้บันทึก
                <?php }else{ ?>
                ชื่อผู้แก้ไข
                <?php }?>
                :</td>
              <td width="78%"><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
            </tr>
            <tr valign="middle">
              <td>วิชาที่ต้องเรียนมาก่อน :</td>
              <td><input name="course_before" >
                (หากไม่มี กรุณาปล่อยว่าง)</td>
            </tr>
            <tr>
              <td>สังกัด :</td>
              <td><select name="major_id" onChange="callPrefixCourse(this.value)">
                  
                  <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['editAll'][0]['major_id'])){?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['major_id'];?>
" selected>
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['major_name'];?>

                  |
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['fac_name'];?>

                  </option>
                  <?php }else{ ?>
                  <option value="" disabled selected>กรุณาเลือก</option>
                  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_major']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['major_id'];?>
">
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['major_name'];?>

                  |
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['fac_name'];?>

                  </option>
                  <?php } ?>
                  <?php }?>
                </select>
            </tr>
            <tr>
              <td>รหัสวิชา :</td>
              <td><div style="float:left;">
                  <input name="course_id_prefix" type="text" id="course_id_prefix" size="3" maxlength="2" readonly class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_id_prepostfix'][0];?>
">
                  <input name="course_id_postfix" type="text" required id="course_id_postfix" size="3" maxlength="3" class="k-textbox" onKeyUp="return copyValueChk(this)" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_id_prepostfix'][1];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['editAll'])){?> readonly <?php }?>>
                </div>
                <div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
            </tr>
            <tr>
              <td>Course ID :</td>
              <td><div style="float:left;">
                  <input name="course_id_prefixEN" type="text" id="course_id_prefixEN" size="3" maxlength="2" readonly class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_id_prepostfixEN'][0];?>
">
                  <input name="course_id_postfixEN" type="text" id="course_id_postfixEN" size="3" maxlength="3" class="k-textbox" readonly value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_id_prepostfixEN'][1];?>
<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_id_prepostfixEN'][2];?>
">
                </div>
                <div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
            </tr>
            <tr>
              <td>ชื่อวิชา :</td>
              <td><input name="course_name" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_name'];?>
" size="70" maxlength="255" required validationMessage="กรุณากป้อนชื่อวิชาที่เป็นภาษาไทย" class="k-textbox" onKeyUp="checkThai(this)"></td>
            </tr>
            <tr>
              <td>Course Name :</td>
              <td><input name="course_nameEN" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_nameEN'];?>
" size="70" maxlength="255" required validationMessage="กรุณากป้อนชื่อวิชาที่เป็นภาษาอังกฤษ" class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>รายละเอียดวิชา :</td>
              <td><textarea name="course_description" cols="70" rows="3" required validationMessage="กรุณาป้อนรายละเอียดวิชาที่เป็นภาษาไทย" class="k-textbox"><?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_description'];?>

</textarea>
                *หากไม่ระบุ กรุณาใส่เครื่องหมาย -</td>
            </tr>
            <tr>
              <td>Course Description :</td>
              <td><textarea name="course_descriptionEN" cols="70" rows="3" required validationMessage="กรุณาป้อนรายละเอียดวิชาที่เป็นภาษาอังกฤษ"  class="k-textbox"><?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['course_descriptionEN'];?>

</textarea>
                *หากไม่ระบุ กรุณาใส่เครื่องหมาย -</td>
            </tr>
            <tr>
              <td>หน่วยกิต :</td>
              <td><input name="credit" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['credit'];?>
" size="3" maxlength="2" required validationMessage="กรุณาป้อนหน่วยกิต" onKeyUp="checkDex(this)"  class="k-textbox">
                หน่วย</td>
            </tr>
            <tr>
              <td>ชั่วโมงบรรยาย / สัปดาห์ :</td>
              <td><input name="lecture" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['lecture'];?>
" size="5" maxlength="1" required validationMessage="กรุณาระบุชั่วโมงบรรยาย / สัปดาห์" onKeyUp="checkDex(this)"  class="k-textbox">
                ชั่วโมง </td>
            </tr>
            <tr>
              <td>ชั่วโมงปฎิบัติ / สัปดาห์ :</td>
              <td><input name="practice" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['practice'];?>
" size="5" maxlength="1" required onKeyUp="checkDex(this)"  class="k-textbox">
                ชั่วโมง</td>
            </tr>
            <tr>
              <td>สอบกลางภาค</td>
              <td><input name="date_midterm" type="text" size="70" maxlength="255" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['date_midterm'];?>
"/></td>
            </tr>
            <tr>
              <td>สอบปลายภาค</td>
              <td><input name="date_final" type="text" size="70" maxlength="255" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['editAll'][0]['date_final'];?>
"/></td>
            </tr>
            <tr>
              <td>สถานะ :</td>
              <td><select name="status">
                  <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['editAll'][0]['status'])){?>
                  <?php if ($_smarty_tpl->tpl_vars['page']->value['editAll'][0]['status']==1){?>
                  <option value="1" selected>เปิดใช้งาน</option>
                  <option value="0">ยกเลิกการใช้งาน</option>
                  <option value="2">รอการอนุมัติ</option>
                  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['editAll'][0]['status']==2){?>
                  <option value="2" selected>รอการอนุมัติ</option>
                  <option value="0" >ยกเลิกการใช้งาน</option>
                  <option value="1">เปิดใช้งาน</option>
                  <?php }else{ ?>
                  <option value="0" selected>ยกเลิกการใช้งาน</option>
                  <option value="1">เปิดใช้งาน</option>
                  <option value="2">รอการอนุมัติ</option>
                  <?php }?>
                  <?php }else{ ?>
                  <option value="2">รอการอนุมัติ</option>
                  <option value="1" selected>เปิดใช้งาน</option>
                  <option value="0">ยกเลิกการใช้งาน</option>
                  <?php }?>
                </select></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>"  onClick="return confirm('ยืนยันข้อมูล')">
                <input type="reset" value="Clear" /></td>
            </tr>
          </tbody>
        </table>
      </fieldset>
    </form>
  </div>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="section"){?>
  <section>
    <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/course" style="text-decoration:underline;">จัดการวิชา</a> >
      <?php if (empty($_smarty_tpl->tpl_vars['page']->value['EditSec'])){?>
      เพิ่มกลุ่มเรียน
      <?php }else{ ?>
      แก้ไขกลุ่มเรียน
      <?php }?>
    </div>
    <?php if (empty($_smarty_tpl->tpl_vars['page']->value['dlvl'])){?>
    <p style="background:#FF9999; border:#FF0000 solid 3px; padding:10px;">กรุณากำหนดระดับบปริญญาก่อนที่จะใช้งานการแบ่งกลุ่มเรียน กำหนดระดับปริญญา <a href="/edu/level?cfm=presection">คลิ๊กที่นี้</a></p>
    <?php }?>
    <?php if (empty($_smarty_tpl->tpl_vars['page']->value['_teacher'])){?>
    <p style="background:#FF9999; border:#FF0000 solid 3px; padding:10px;">กรุณากำหนดรายชื่อบุคลกรก่อนที่จะใช้งานการแบ่งกลุ่มเรียน กำหนดบุคลากร <a href="/edu/employee/form/new?cfm=presection">คลิ๊กที่นี้</a></p>
    <?php }?>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
    <p id="landing">
      <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>

      <br>
      หากต้องการเพิ่มหลักสูตรและแผนการศึกษา กรุณา<a href="/edu/syllabus">คลิ๊กที่นี้</a></p>
    <?php }?>
    <form name="frm0" action="" method="post">
      <table width="100%" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:#000000 solid 1px;">
        <thead>
          <tr>
            <th colspan="2" scope="col" class="k-header">กลุ่มเรียน (Section) วิชา <u>
              <?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['course_id'];?>

              <?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['course_name'];?>

              </u></th>
          </tr>
        </thead>
        <tbody valign="top">
          <tr>
            <td width="18%"><?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>
              ชื่อผู้บันทึก
              <?php }else{ ?>
              ชื่อผู้แก้ไข
              <?php }?></td>
            <td width="82%"><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
          </tr>
          <tr>
            <td>ระดับปริญญา :</td>
            <td>
           <?php if (empty($_smarty_tpl->tpl_vars['page']->value['EditSec']['degree_level_name'])){?>
            <select name="degree_level_id" onChange="return getNumberSection(this)">
                <option value="" selected disabled>กรุณาเลือก</option>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['dlvl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                <?php echo $_smarty_tpl->tpl_vars['item']->value['degree_level_name'];?>

                <?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>

                </option>
                <?php } ?>
              </select>
           <?php }else{ ?>
           <?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['degree_level_name'];?>

           <input name="degree_level_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['deg_id'];?>
">
           <?php }?>
           </td>
          </tr>
          <tr>
            <td>วิชา :</td>
            <td><input name="course" type="text" value="<?php if (empty($_smarty_tpl->tpl_vars['page']->value['EditSec'])){?><?php echo $_smarty_tpl->tpl_vars['page']->value['c_name'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['course_name'];?>
<?php }?>" size="70" disabled class="k-textbox"></td>
          </tr>
          <tr>
            <td>กลุ่มที่ : </td>
            <td><input name="section" id="section" type="text" class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['section'];?>
" size="3" maxlength="3" readonly></td>
          </tr>
          <tr>
            <td>สำหรับสาขา :</td>
            <td><textarea name="formajor" cols="60" rows="3" class="k-textbox"><?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['formajor'];?>

</textarea>
              หากไม่ระบุ กรุณาใส่ -</td>
          </tr>
          <tr>
            <td>จำนวนที่นั่ง :</td>
            <td><input name="total_seat" type="text" size="2" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['total_seat'];?>
"  required validationMessage="กรอกจำนวนที่นั่ง" class="k-textbox" onKeyUp="return checkDex(this)"></td>
          </tr>
          
          <tr>
            <td>ประเภทการเรียนการสอน :</td>
            <td>
            <input  id="study_lec" type="checkbox" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['EditSec']['study_lec']||($_smarty_tpl->tpl_vars['page']->value['chkLab']>0)){?> checked <?php }?>  >
            <input name="study_lec" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['page']->value['chkLab']>0){?>1<?php }else{ ?>0<?php }?>">
            ปฏิบัติ 
              <input id="study_practice" disabled type="checkbox"<?php if ($_smarty_tpl->tpl_vars['page']->value['EditSec']['study_practice']||($_smarty_tpl->tpl_vars['page']->value['chkLec']>0)){?> checked <?php }?> >
              <input name="study_practice" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['page']->value['chkLec']>0){?>1<?php }else{ ?>0<?php }?>">
              บรรยาย</td>
          </tr>
         
          <tr>
            <td>ผู้สอน :</td>
            <td><input name="teacher" id="teacher" type="text"/></td>
          </tr>
          <tr>
            <td>ประเภทวิชา :</td>
            <td><input name="category" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['category'];?>
" maxlength="255" size="70" required validationMessage="ระบุประเภทวิชา" class="k-textbox"></td>
          </tr>
          <tr>
            <td>สถานะ :</td>
            <td><select name="status">
                <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['EditSec']['status'])){?>
                <?php if ($_smarty_tpl->tpl_vars['page']->value['EditSec']['status']==1){?>
                <option value="1" selected>เปิดใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['page']->value['EditSec']['status']==2){?>
                <option value="2" selected>รอการอนุมัติ</option>
                <option value="0" >ยกเลิกการใช้งาน</option>
                <option value="1">เปิดใช้งาน</option>
                <?php }else{ ?>
                <option value="0" selected>ยกเลิกการใช้งาน</option>
                <option value="1">เปิดใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }?>
                <?php }else{ ?>
                <option value="1">เปิดใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }?>
              </select></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><?php if (isset($_smarty_tpl->tpl_vars['page']->value['EditSec'])){?>
              <input name="operation" type="submit" value="บันทึกการแก้ไข" onClick="return confirm('ยืนยันข้อมูล')">
              <?php }else{ ?>
              <input name="operation" type="submit" value="เพิ่มข้อมูล" onClick="return confirm('ยืนยันข้อมูล')">
              <?php }?>
              <input name="course_id" type="hidden" value="<?php if (empty($_smarty_tpl->tpl_vars['page']->value['EditSec'])){?><?php echo $_smarty_tpl->tpl_vars['page']->value['c_id'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['course_id'];?>
<?php }?>">
              <?php if (empty($_smarty_tpl->tpl_vars['page']->value['EditSec']['id'])){?>
              <input name="hsec_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['secid'];?>
">
              <?php }?></td>
          </tr>
        </tbody>
      </table>
    </form>
    <script>
	function getNumberSection(o){
		var courseid = "<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['courseid'];?>
";
		var degree_lvl = o.value;
		$.post("/edu/course/section/new",
		{
			"findSection":true,
			"courseid":courseid,
			"degree_lvl":degree_lvl
		},
		function(res){
			document.getElementById("section").value = res.CountSec;
		},"json");
	}
	function TeacherJSON(){
		var pre = '<?php echo $_smarty_tpl->tpl_vars['page']->value['_teacher'];?>
';
		if(pre=='')
			return  null;
		else
			var json = eval('('+pre+')');
			return json;
	}
	function majorJSON(){
		var pre = '<?php echo $_smarty_tpl->tpl_vars['page']->value['aMajor'];?>
';
		if(pre=='')
			return  null;
		else
			var json = eval('('+pre+')');
			return json;
	}
	$("#for_major").tokenInput("/service/callbackJson?module=major", 
		{ 	theme: "facebook",
			preventDuplicates: true,
			prePopulate: majorJSON()
	});	
	$("#teacher").tokenInput("/service/callbackJson?module=emp_unteach", 
		{ 	theme: "facebook",
			preventDuplicates: true,
			deleteConfirm: true,
			prePopulate:  TeacherJSON(),
			onDelete: function (item) {
               $.post('/edu/course',{ "deltype":"<?php ob_start();?><?php echo md5('teachDel');?>
<?php $_tmp5=ob_get_clean();?><?php echo sha1($_tmp5);?>
","emp_id":item.id,"sec_id":'<?php echo $_smarty_tpl->tpl_vars['page']->value['EditSec']['id'];?>
'},function(data){
				   if(data.result){
					   alert("เรียบร้อยแล้ว")
				   }
				},'json');
            }
	});	
	</script> 
  </section>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="schedule"){?>
  <script>
  function goRoomStatement(o){
	  var section = '<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['section'];?>
';
	  var secid = '<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['secid'];?>
';
	  var degtype = '<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['degtype'];?>
';
	  var courseid = '<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['courseid'];?>
';
  	$.post("/edu/course/section/schedule/chkroom",
	{
		//"chkroom":true,
		"secid":secid,
		"section":section,
		"degtype":degtype,
		"courseid":courseid,
		"roomid":o.value
	},function(res){
		$("div#tableLanding").html(res);
	})
  }
  </script>
  <?php }?>
  <div class="clear-all"></div>
</div>
</body>
</html><?php }} ?>