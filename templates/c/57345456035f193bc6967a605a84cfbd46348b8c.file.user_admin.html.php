<?php /* Smarty version Smarty-3.1.7, created on 2012-07-06 11:18:06
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\user_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:161274fd252a4a36753-62999521%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57345456035f193bc6967a605a84cfbd46348b8c' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\\user_admin.html',
      1 => 1341517562,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161274fd252a4a36753-62999521',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fd252a4a4cf3',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fd252a4a4cf3')) {function content_4fd252a4a4cf3($_smarty_tpl) {?>
<script>

$(function(){
	$("img.ico_del").click(function(){
		$this = $(this);
		var accid = $(this).attr("data-rel")
		if(!confirm("ยืนยันการลบข้อมูลหรือไม่")) return false;
		$this.addClass("loading")
		$.post("/system/user/del",
		{
			"accid":accid
		},function(res){
			if(res.result){
				alert("ทำรายการสำเร็จ")
				$this.removeClass("loading");
				$this.parents("tr").fadeOut('fast').remove()
			}
		},'json')
		
	});
	$("#emp input[type=text],textarea").css("width","90%");
	$("#emp input[type=text],textarea").each(function(index, element) {
        $(this).removeClass("k-textbox");
    });
	$("#opration").click(function(event){
		if(!confirm("ยืนยันการทำรายการ")) return;
		var temp = $("form").serialize()
		$.post("/system/user/add",{ "opration":temp}
		,function(res){
			if(res.result){
				$("#result").fadeIn("slow").html("ทำรายการสำเร็จ").delay(5500).fadeOut("slow");
			}else{
				$("#result").fadeIn(res.reason).html("ไม่สามารถทำรายการได้").delay(5500).fadeOut("slow");
			}
		},'json');
		event.preventDefault();
	})
	
})

</script>

<?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="userAdd"){?>
<b  ></b>
<article class="module width_full">
  <header>
    <h3>เพิ่มบัญชีผู้ใช้งานใหม่</h3>
  </header>
  <div class="module_content">
  <div id="result" style="display:none; background:#00FF33; padding:10px;" align="center"></div>
  <form method="post" action="" id="newAccount">
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">

      <tr>
     
        <td><fieldset>
            <label>กำหนดชื่อบัญชีผู้ใช้ (ไม่ต่ำกว่า 5 - 12 )</label>
            <input type="text" name="username" id="sUsername" maxlength="12" onKeyUp="return chkUser(this)" required>
            <div id="landing" style="float:left;margin:7pt; font-weight:bold;"></div>
          </fieldset></td>
      </tr>
      <tr>
        <td><fieldset>
            <label>รหัสผ่าน</label>
            <input type="text" name="pwd" id="sPwd"  required><input type="button" id="generatePwd" value="สร้างรหัสผ่าน" style="float:left;margin:7pt;">

                      </fieldset></td>
      </tr>
      <tr>
        <td><fieldset >
            <label>ชื่อเจ้าของบัญชี</label>
            (จะต้องเป็นบุคลากรในสำนักงานเท่านั้น)
            <select name="employee_id">
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_emp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['EMP_NAME'];?>
</option>
            <?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
            <option value="" disabled selected>ไม่ปรากฎ กรุณากำหนดพนักงานให้อยู่ในกลุ่มเจ้าหน้าที่ประจำสำนักงาน</option>
            <?php } ?>
            </select>
        </fieldset></td>
      </tr>
      <tr>
        <td><fieldset >
            <label>ประเภทบัญชี</label>
            <select name="sec_work">
            	<option value="1">เจ้าหน้าที่ฝ่ายภาระการศึกษา</option>
                <option value="2">เจ้าหน้าที่ฝ่ายตรวจสอบ</option>
            </select>
          </fieldset></td>
      </tr>
      <tr>
        <td><fieldset>
            <label>สถานะบัญชี</label>
            <select name="status">
              <option value="1"> เปิดการใช้งาน </option>
              <option value="0"> ระงับการใช้งาน </option>
            </select>
          </fieldset></td>
      </tr>
      <tr>
        <td align="center"><input id="opration" type="submit" name="opration" value="ส่งข้อมูล" <?php if (empty($_smarty_tpl->tpl_vars['row']->value['_emp'])){?> disabled <?php }?>></td>
      </tr>
    </table>
    </form>
    <div class="clear"></div>
  </div>
</article>
<!-- end of stats article -->
<?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="viewUser"){?>
<article class="module width_full">
  <header>
    <h3>รายชื่อบัญชี</h3>
  </header>
 
  <div class="module_content">
   <div id="landing" style="display:none; background:#0F0; width:100%;text-align:center;padding:5px;"></div>
  <table id="tblist" border="0" width="100%" cellpadding="5">
  <thead class="k-header" align="center">
  	<tr>
  	  <td width="10%" height="30">ลำดับบัญชี</td>
  	  <td width="20%">ชื่อบัญชี</td>
  	  <td width="20%">ฝ่าย</td>
  	  <td width="30%">เจ้าของบัญชี</td>
  	  <td width="10%">สถานะ</td>
    	<td width="10%">ดำเนินการ</td>
    </tr>
  </thead>
  <tbody>
   <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_acc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
  <tr>
 
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['username'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['sec_work'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['EMP_NAME'];?>
</td>
    <td align="center">
    <select name="status" onChange="changeStatus(this,<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
)">
    <?php if ($_smarty_tpl->tpl_vars['item']->value['status']==1){?>
    	<option value="1" selected>ใช้งาน</option>
        <option value="2">ระงับการใช้งาน</option>
        <option value="0">ยกเลิกการใช้งาน</option>
    <?php }elseif($_smarty_tpl->tpl_vars['item']->value['status']==2){?>
    	<option value="2" selected>ระงับการใช้งาน</option>
        <option value="1" >ใช้งาน</option>
        <option value="0">ยกเลิกการใช้งาน</option>
    <?php }else{ ?>
    	<option value="0" selected>ยกเลิกการใช้งาน</option>
        <option value="1" >ใช้งาน</option>
        <option value="2" >ระงับการใช้งาน</option>
        
    <?php }?>
        
    </select>
    </td>
    <td align="center"><img src="/templates/skin/HTML5 Admin Template/images/icn_trash.png" class="ico_del" data-rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="cursor:pointer;"></td>
   
    </tr>
     <?php } ?>
  </tbody>
  </table>
    <div class="clear"></div>
  </div>
</article>
<?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="emp"){?>
<article class="module width_full">
  <header>
    <h3>เพิ่มรายชื่อพนักงาน (ไม่สังกัดภาค)</h3>
  </header>
  <div class="module_content" id="emp">
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
  <div style="text-align:center;background:#0F0;"><?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
</div>
  <?php }?>
  <form id="addnew" method="post" action="" name="FRM" enctype="multipart/form-data">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF">
          <thead class="k-header">
            <tr>
              <th colspan="4" scope="col" >แบบฟอร์มบันทึกและแก้ไขรายละเอียดบุคลากร</th>
            </tr>
          </thead>
          <tbody>
            <tr  valign="top">
              <th colspan="4" class="k-header">กำหนดบัญชีผู้ใช้</th>
            </tr>
            <tr  valign="top">
              <td >ชื่อบัญชี :</td>
              <td colspan="1" ><input name="username" size="15" maxlength="12"  type="text" required validationMessage="กรุณากรอกคำนำหน้าชื่อ" class="k-textbox" onKeyUp="return chkUser(this),checkEngChar(this)" style="float:left;">  <div id="landing" style="float:left;margin:7pt; font-weight:bold;"></div></td>
              <td></td>
              <td></td>
            </tr>
            <tr  valign="top">
              <td >รหัสผ่าน :</td>
              <td colspan="0" ><input name="pwd" size="15" maxlength="12" type="text" required validationMessage="กรุณากรอกรหัสผ่าน" class="k-textbox" id="sPwd" style="float:left;" onKeyUp="checkEngChar(this)"><a id="generatePwd" style="margin-left:7pt;">Generate password</a></td>
              <td></td>
              <td></td>
            </tr>
          
            <tr  valign="top">
              <td >ประเภทบัญชี :</td>
              <td ><select name="sec_work">
                  <option value="1">เจ้าหน้าที่ฝ่ายภาระการศึกษา</option>
                  <option value="2">เจ้าหน้าที่ฝ่ายตรวจสอบ</option>
              </select></td>
              <td></td>
              <td></td>
            </tr>
            
            <tr  valign="top">
              <th colspan="4" class="k-header">รายละเอียดข้อมูลทั่วไป</th>
            </tr>
            <tr  valign="top">
              <td width="15%" >รูปภาพ :</td>
              <td ><?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit'])){?>
                <img src="../../../common/images/employee_pics/<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['pic_path'];?>
" width="100" height="100">
                <?php }?>
                <input type="file" name="uploadPic" id="photo"/></td>
                <td></td>
                <td></td>
            </tr>
            <tr valign="top">
              <td>คำนำหน้า : </td>
              <td width="35%"><input name="titlename" size="15" maxlength="255" type="text" required validationMessage="กรุณากรอกคำนำหน้าชื่อ" class="k-textbox" onKeyUp="checkThai(this)">
                <br>
                <br></td>
              <td width="13%" >Titlename :</td>
              <td width="37%"><input name="titlenameEN"  type="text" size="15" maxlength="255" required validationMessage="titlename is required." class="k-textbox" onKeyUp="checkEngChar(this)">
                <br>
                <br></td>
            </tr>
            <tr>
              <td>ชื่อ :</td>
              <td><input type="text" size="30" maxlength="255" name="firstname"  required validationmessage="กรุณากรอกชื่อ" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Name :</td>
              <td><input name="firstnameEN"  type="text" size="30" maxlength="255" required validationmessage="Firstname is required." class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>สกุล :</td>
              <td><input name="lastname"  type="text" size="30" maxlength="255" required validationmessage="กรุณากรอกนามสกุล" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Lastname :</td>
              <td><input name="lastnameEN"  type="text" size="30" maxlength="255" required validationmessage="Lastname is required." class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>เลขประจำตัวประชาชน :</td>
              <td><input name="nation_id" onKeyUp="autoTab(this)" size="20" maxlength="20" type="text" required validationMessage="กรุณากรอกเลขประจำตัวประชาชน 13 หลัก" class="k-textbox" ></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr  valign="top">
              <td>ตำแหน่งบริหาร :</td>
              <td><input name="admin_position" type="text" class="k-textbox" size="40" maxlength="255" onKeyUp="checkThai(this)">
                <br>
                *หากไม่มีกรุณาใส่ -</td>
              <td>Admin Position :</td>
              <td><input name="admin_positionEN" type="text" class="k-textbox" onKeyUp="checkEngChar(this)" size="40" maxlength="255">
                <br>
                *หากไม่มีกรุณาใส่ -</td>
            </tr>
            <tr>
              <td>ตำแหน่งงาน :</td>
              <td><input name="position" type="text" required class="k-textbox" size="40" maxlength="255" validationMessage="กรุณาป้อนข้อมล" ></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>วันจ้างงาน :</td>
              <td><input name="hire_date" type="text" size="40" id="hire_date" required validationMessage="กรุณาเลือกวันเริ่มจ้าง" class="k-textbox"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
          <thead class="k-header">
            <tr>
              <th colspan="4" scope="col">รายละเอียดข้อมูลส่วนตัว</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>เพศ :</td>
              <td><label>
                <input type="radio" name="gender" value="1">ชาย</label>
                <label>
                  <input type="radio" name="gender" value="0">หญิง</label></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>วันเกิด :</td>
              <td><input name="birthday" id="birthday" type="text"size="40" ></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr  valign="top">
              <td>ศาสนา :</td>
              <td><select name="religion" id="religion" >
                    <option value="พุทธ|Bhudda" >พุทธ | Bhudda</option>
                    <option value="คริสต์|Chirst">คริสต์ | Chirst</option>
                    <option value="อิสลาม|Ilsam">อิสลาม | Ilsam</option>
                    <option value="999" >อื่นๆ โปรดระบุ</option>
             	 </select>
                <p>
                <div id="religionTH_landing"></div>
                </td>
              <td id="label_religionEN">&nbsp;</td>
              <td id="religion_landing">&nbsp;</td>
            </tr>
            <tr>
              <td>กรุ๊ปเลือด :</td>
              <td colspan="3">
              <select name="blood_group">
                <option>O</option>
                <option>A</option>
                <option>B</option>
                <option>AB</option>
                <option>other</option>
              </select></td>
            </tr>
            <tr  valign="top">
              <td>ที่อยู่ที่ติดต่อได้ :</td>
              <td><textarea name="address" cols="40" rows="3" required validationMessage="กรุณากรอกที่อยู่ที่ติดต่อได้" class="k-textbox" onKeyUp="checkThai(this)"></textarea></td>
              <td>Address Contact :</td>
              <td class="odd"><textarea name="addressEN" cols="40" rows="3" required validationMessage="Address Contact is required." class="k-textbox" onKeyUp="checkEngChar(this)" ></textarea></td>
            </tr>
            <tr>
              <td>อำเภอ :</td>
              <td><input name="amphur" type="text" size="40" required validationMessage="กรุณากรอกชื่ออำเภอ" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Amphur :</td>
              <td class="odd"><input name="amphurEN" type="text" size="40" required validationMessage="Amphur is required." class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>จังหวัด :</td>
              <td><input name="province" type="text" size="40" required validationMessage="กรุณากรอกชื่อจังหวัด" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Province :</td>
              <td class="odd"><input name="provinceEN" type="text"  size="40" required validationMessage="Province is required." class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>โทรศัพท์ :</td>
              <td><input name="mobile" type="tel" size="40" maxlength="10" class="k-textbox"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          <tbody>
          <thead class="k-header">
            <tr>
              <th colspan="4" scope="col">รายละเอียดการศึกษา</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>ระดับปริญญาตรี :</td>
              <td><input name="behavior_degree" type="text" size="40"  required validationMessage="กรุณาป้อนระดับการศึกษา ปริญญาตรี" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Behavior Degree :</td>
              <td><input name="behavior_degreeEN" type="text" size="40"  required validationMessage="กรุณาป้อนระดับการศึกษา ปริญญาตรี" class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>ระดับปริญญาโท :</td>
              <td><input name="master_degree" type="text" size="40"  required validationMessage="กรุณาป้อนระดับการศึกษา ปริญญาโท" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Master Degree :</td>
              <td><input name="master_degreeEN" type="text" size="40"  required validationMessage="กรุณาป้อนระดับการศึกษา ปริญญาโท" class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr  valign="top">
              <td>ระดับปริญญาเอก :</td>
              <td><input name="phd_degree" type="text" size="40" class="k-textbox" onKeyUp="checkThai(this)">
                <br>
                *หากไม่ระบุ กรุณาใส่เครื่องหมาย -</td>
              <td>Doctor Degree :</td>
              <td><input name="phd_degreeEN" type="text" size="40" class="k-textbox" onKeyUp="checkEngChar(this)">
                <br>
*หากไม่ระบุ กรุณาใส่เครื่องหมาย -</td>
            </tr>
            <tr>
              <td colspan="4" align="center">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="submit" name="operation" value="เพิ่มข้อมูล" id="button" onClick="return confirm('ยืนยันข้อมูล')"></td>
            </tr>
          </tbody>
        </table>
      </fieldset>
    </form>
    <div class="clear"></div>
  </div>
</article>

<?php }?>
<?php }} ?>