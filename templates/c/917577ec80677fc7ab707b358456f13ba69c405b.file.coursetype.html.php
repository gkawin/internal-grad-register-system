<?php /* Smarty version Smarty-3.1.7, created on 2012-07-08 00:08:42
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\coursetype.html" */ ?>
<?php /*%%SmartyHeaderCode:322434efca5f1cb7fd4-38794110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '917577ec80677fc7ab707b358456f13ba69c405b' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\coursetype.html',
      1 => 1341680912,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '322434efca5f1cb7fd4-38794110',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4efca5f1cf479',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4efca5f1cf479')) {function content_4efca5f1cf479($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>

ul.token-input-list-facebook{
	width:455px;
}
</style>
<script>
$(function(){
	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลหรือไม่")) return;
		$this = $(this);
		$this.addClass("loading");
		$.post("/edu/coursetype",{ "del_id":$this.attr("rel"),"name":$this.attr("data-rel")},function(data){
			if(data.result){
					$this.parents("tr").fadeOut("fast", function(){
						$this.parents("tr").remove();
					});
					$this.removeClass("loading");
			}else{
				alert("ไม่สามารถลบได้ เนื่องจาก\n- มีรายวิชาค้างอยู่ในกลุ่มประเภทวิชา\nกรุณาแก้ไข");
				$this.removeClass("loading");
			}
		},'json');
		return(false);
	});
	
});
	function checkEngChar(elm) {
		var filter = /^[a-zA-Z\d!@#$%\^\&\*\(\)\-\+~\[\]{}\\|;:'"\M<>\?\/,\.\s=_]*$/;
		if(!filter.test(elm.value)) {
			alert('Sorry, only english charactors are allowed here.');
			elm.value = '';
			elm.focus();
		}
	}
	
	function chkValue(value){
		if(value.length >=6){
			$("#status_bar").html('<img src="../../../common/images/icons/loading.gif" align="absmiddle">&nbsp;Checking availability...');
			 $.ajax({  
    		type: "POST",  
			url: "/edu/coursetype",  
			data: "chkAvaliable="+ value,  
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
		}else{
			$("#status_bar").html('<font color="red">กรุณากรอกให้มากกว่า <strong>6</strong> ตัวอักษร</font>');
			return false;
		}
	}
</script> 
<!-- CONTENT -->
<div class="container">
    <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
     <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการประเภทวิชา</div>
    <section>
      <ul style="padding:0;">
          <li class="k-button"><a href="/edu/coursetype/form"   class="add_new_icon ex1" >เพิ่มประเภทการศึกษาใหม่</a></li>
        </ul>

      <table  width="100%" cellpadding="3" id="tblist">
        <thead  style="text-decoration:underline; font-weight:bold;" class="k-header">
          <tr>
            <td width="327" style="text-align: left">ชื่อประเภทวิชา</td>
            <td width="329" style="text-align: left">Course Type Name</td>
            <td width="195" align="center" style="text-align: left">สถานะ</td>
            <td width="195" align="center" style="text-align: left">ดำเนินการ</td>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top">
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['course_type_nameTH'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['course_type_nameEN'];?>
</td>
            <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['status1'];?>
</td>
            <td ><ul class="ulmenu">
              <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/coursetype/form?editid=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
">แก้ไขประเภทวิชา</a></li>
               <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"> <a href="#" class="rdel" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['course_type_nameTH'];?>
">ลบประเภทวิชา</a></li>
               </ul></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/coursetype" style="text-decoration:underline;">จัดการประเภทวิชา</a> > <?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มประเภทวิชาใหม่<?php }else{ ?>แก้ไขประเภทวิชา<?php }?></div>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
    <p id="landing">
      <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>หากต้องการกำหนดรายวิชาต่างๆ กรุณา <a href="/edu/course">คลิ๊กที่นี้</a></p>

    <?php }?>
    <div>
    <form id="addnew" method="post" action="">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF">
        <thead  class="k-header">
          <tr>
            <th colspan="2" scope="col">แบบฟอร์มบันทึก และแก้ไขประเภทรายวิชา
            </th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td><?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>ชื่อผู้บันทึก<?php }else{ ?>ชื่อผู้แก้ไข<?php }?> :</td>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
          </tr>
          <tr>
            <td width="20%">ชื่อประเภทวิชา :</td>
            <td width="80%"><input name="course_type_nameTH" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['course_type_nameTH'];?>
" size="70" maxlength="255" onkeyup="chkValue(this.value),checkThai(this)" style="float:left;" required class="k-textbox"><div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
            </tr>
          <tr >
            <td>Course Type Name :</td>
            <td><input name="course_type_nameEN" required value="<?php echo $_smarty_tpl->tpl_vars['row']->value['course_type_nameEN'];?>
" size="70" maxlength="255" onKeyUp="checkEngChar(this)" class="k-textbox"></td>
          </tr>
          <tr >
            <td>ลักษณะวิชา :</td>
            <td><select name="required_type">
            <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['required_type'])){?>
            <?php switch ($_smarty_tpl->tpl_vars['row']->value['required_type']){?>
<?php case 1:?>
            <option value="1" selected>วิชาบังคับ</option>
            <?php break;?><?php case 2:?>
            <option value="2" selected>วิชาเลือก</option>
            <?php break;?><?php case 3:?>
            <option value="3" selected>วิชาเสรี</option>
            <?php break;?><?php case 4:?>
            <option value="4" selected>วิชาพิเศษ</option>
            <?php }?>
            <?php }else{ ?>
            <option value="1" selected>วิชาบังคับ</option>
            <option value="2">วิชาเลือก</option>
            <option value="3">วิชาเสรี</option>
            <option value="4">วิชาพิเศษ</option>
            <?php }?>
            </select></td>
          </tr>
          <tr >
            <td>สถานะ :</td>
            <td>
              <select name="status">
                <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['status'])){?>
                <?php if ($_smarty_tpl->tpl_vars['row']->value['status']==1){?>
                <option value="1" selected>เปิดใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['row']->value['status']==2){?>
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
                </select>
              </td>
          </tr>
          <tr>
          	<td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>"onClick="return confirm('ยืนยันข้อมูล')"></td>
          </tr>
          </tbody>
        </table>
        </fieldset>
      </form>
    </div>
    <?php }?>
    <div class="clear-all"></div>
  </div>
</div>

</body>
</html><?php }} ?>