<?php /* Smarty version Smarty-3.1.7, created on 2012-07-05 23:04:47
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\employee.html" */ ?>
<?php /*%%SmartyHeaderCode:296444f17d23c91b397-88766341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81a2f7703e8df8ca6ec06bd4dcf39c3b9885a4bc' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\employee.html',
      1 => 1341504283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '296444f17d23c91b397-88766341',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f17d23cb73a0',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item_empGroup' => 0,
    'res' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f17d23cb73a0')) {function content_4f17d23cb73a0($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
.test { list-style:none;padding:0;}
.test li{ padding-bottom:5px;}
.group-icon { padding-left:18px;padding-bottom:18px; background:url(/templates/skin/default/images/icon/edit_ico.png) no-repeat}
.group-icon:hover { padding-left:18px;padding-bottom:18px; background:url(/templates/skin/default/images/icon/edit_hover.png) no-repeat;}
</style>
<script>
$(function(){

	$("#hire_date").kendoDatePicker({ format: "yyyy-MM-dd", max: new Date(),min: new Date(1990, 0, 1)});
	$("#birthday").kendoDatePicker({ format: "yyyy-MM-dd",
  min: new Date(1900, 0, 1),
  max: new Date(2000,0,1)});
  
	

	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลระดับการศึกษาหรือไม่")) return;
		$this = $(this);
		$this.addClass("loading");
		$.post("/edu/employee",{ "del":$this.attr("rel")},function(data){
			if(data.result){
					$this.parents("tr").fadeOut("fast", function(){
						$this.parents("tr").remove();
					});
					$this.removeClass("loading");
			}else{
				alert("ไม่สามารถลบได้");
				$this.removeClass("loading");
			}
		},"json");
		return(false);
	});
	$("#religion").change(function(){
		if($(this).val()==999){
			$(this).parents("td").append("<div id='fieldreligion' style='width:auto;'>ศาสนา :<input name='religion' type='text' class='k-textbox' required validationMessage='กรุณาป้อนศาสนา'/> Religion :<input name='religionEN' type='text' required validationMessage='Religion is required.' class ='k-textbox'/></div>");
		}else{
			$("#fieldreligion").remove();
		}
	});
	
});

</script> 
<script>
$(document).ready(function(e) {
    $("#photo").kendoUpload({
		localization:{
			dropFilesHere: "เลือกรูปภาพที่ต้องการ",
			select:"เลือกไฟล์",
			statusUploading: "กำลังอัพโหลดรูปภาพ กรุณารอสักครู่"
		}
	});

	$("#edit a[rel]").tooltip( {  
	opacity: 0.8,position : 'bottom right'});
});
</script> 
<!-- CONTENT -->
<div class="container">
  <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการบุคลากร</div>
 
  <section>
    <ul style="padding:0; display:inline-block;list-style:none;">
      <li class="k-button"><a href="/edu/employee/form/new" class="add_new_icon ex1">เพิ่มรายชื่ออาจารย์ใหม่</a></li>
      <li class="k-button"><a href="/edu/group" id="ldel" class="ex1">ไปยังกลุ่มอาจารย์</a></li>
    </ul>
    <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['all'])){?>
     <p id="landing">
     ต้องการเพิ่มอาคารเรียน กรุณา <a href="/edu/building">คลิ๊กที่นี้</a> </p>
     <?php }?>
     <div style="text-align:center; background:#FFC;padding:5px;">*โปรดทราบ หากไม่ระบุสังกัด จะเป็นเจ้าหน้าที่ประจำในออฟฟิตบัณฑิตวิทยาลัย</div>
    <table  width="100%" cellpadding="5" class="tblist" id="tblist">
      <thead class="k-header">
        <tr>
          <th width="288">ชื่อ - สกุล</th>
          <th width="78">ตำแหน่งบริหาร</th>
          <th width="85">ตำแหน่ง</th>
          <th width="168">สังกัด</th>
          <th width="78">สถานะ</th>
          <th width="185">กลุ่ม</th>
        </tr>
      </thead>
      <tbody>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr class="rowhl" valign="top">
          <td style="text-align: left"><img src="../../../common/images/employee_pics/<?php echo $_smarty_tpl->tpl_vars['row']->value['pic_path'];?>
" width="64" height="84" style="display:block;float:left; margin-right:5px;"/>
            <div style="padding:3px;">
              <?php echo $_smarty_tpl->tpl_vars['row']->value['titlename'];?>

              <?php echo $_smarty_tpl->tpl_vars['row']->value['firstname'];?>

              <?php echo $_smarty_tpl->tpl_vars['row']->value['lastname'];?>

            </div>
            <div style="padding:3px;">
              <?php echo $_smarty_tpl->tpl_vars['row']->value['titlenameEN'];?>

              .
              <?php echo $_smarty_tpl->tpl_vars['row']->value['firstnameEN'];?>

              <?php echo $_smarty_tpl->tpl_vars['row']->value['lastnameEN'];?>

            </div>
            <div class="tool" > <a href="/edu/employee/form/edit?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" class="k-button ex1">Edit</a><!-- | <a href="#" class="rdel k-button ex1" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
">Delete</a>--> | <a href="/edu/employee/permission/new?empid=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" class="k-button ex1">จัดกลุ่ม</a></div></td>
          <td width="78" style="text-align: left"><?php if (!empty($_smarty_tpl->tpl_vars['row']->value['admin_position'])){?>
            <?php echo $_smarty_tpl->tpl_vars['row']->value['admin_position'];?>

            <?php }else{ ?>
            -
            <?php }?></td>
          <td align="center" valign="top" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['position'];?>
</td>
          <td style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>

            , <br>
            <?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>
</td>
          <td align="center" valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['status1'];?>
</td>
          <td valign="top" style="text-align: left"><ul class="test">
              <?php  $_smarty_tpl->tpl_vars['item_empGroup'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item_empGroup']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_empGroup']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item_empGroup']->key => $_smarty_tpl->tpl_vars['item_empGroup']->value){
$_smarty_tpl->tpl_vars['item_empGroup']->_loop = true;
?>
              <?php if ($_smarty_tpl->tpl_vars['row']->value['id']==$_smarty_tpl->tpl_vars['item_empGroup']->value['employee_id']){?>
              <li><a href="/edu/employee/permission/new?empid=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" class="group-icon" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_id'];?>
"></a>
                <?php echo $_smarty_tpl->tpl_vars['item_empGroup']->value['group_name'];?>

              </li>
              <?php }?>
              <?php }
if (!$_smarty_tpl->tpl_vars['item_empGroup']->_loop) {
?>
              ไม่พบข้อมูล
              <?php } ?>
            </ul></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/employee" style="text-decoration:underline;">จัดการบุคลากร</a> >
    <?php if (empty($_smarty_tpl->tpl_vars['page']->value['edit'])){?>
    เพิ่มชื่อบุคลากร
    <?php }else{ ?>
    แก้ไขชื่อบุคลากร
    <?php }?>
  </div>
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
  <p id="landing">
    <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>

    <br>
    หากต้องการเพิ่มกลุ่มและสิทธิ์ของบุคลากร กรุณา <a href="/edu/group">คลิ๊กที่นี้</a> </p>
  <?php }?>
  <div>
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
              <td width="15%" >รูปภาพ :</td>
              <td ><?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit'])){?>
                <img src="../../../common/images/employee_pics/<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['pic_path'];?>
" width="100" height="100">
                <?php }?>
                <input type="file" name="uploadPic" id="photo"/></td>
            </tr>
            <tr valign="top">
              <td>ชื่อ - สกุล:</td>
              <td width="35%">คำนำหน้า :
                <input name="titlename" size="15" maxlength="255" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['titlename'];?>
"  type="text" required validationMessage="กรุณากรอกคำนำหน้าชื่อ" class="k-textbox" onKeyUp="checkThai(this)">
                <br>
                <input type="text" size="40" maxlength="255" name="firstname"  value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['firstname'];?>
" required validationMessage="กรุณากรอกชื่อ" class="k-textbox" onKeyUp="checkThai(this)">
                <br>
                <input name="lastname"  type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['lastname'];?>
" size="40" maxlength="255" required validationMessage="กรุณากรอกนามสกุล" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td width="13%" >Name - Lastname :</td>
              <td width="37%">titlename :
                <input name="titlenameEN"  type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['titlenameEN'];?>
" size="15" maxlength="255" required validationMessage="titlename is required." class="k-textbox" onKeyUp="checkEngChar(this)">
                <br>
                <input name="firstnameEN"  type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['firstnameEN'];?>
" size="40" maxlength="255" required validationMessage="Firstname is required." class="k-textbox" onKeyUp="checkEngChar(this)">
                <br>
                <input name="lastnameEN"  type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['lastnameEN'];?>
" size="40" maxlength="255" required validationMessage="Lastname is required." class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>เลขประจำตัวประชาชน :</td>
              <td><input name="nation_id"  value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['nation_id'];?>
" size="20" maxlength="20" <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit']['nation_id'])){?> readonly <?php }?> type="text" required validationMessage="กรุณากรอกเลขประจำตัวประชาชน 13 หลัก" class="k-textbox" onKeyUp="checkDex(this),autoTab(this)"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr  valign="top">
              <td>ตำแหน่งบริหาร :</td>
              <td><input name="admin_position" type="text" class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['admin_position'];?>
" size="40" maxlength="255" onKeyUp="checkThai(this)">
                <br>
                *หากไม่มีกรุณาใส่ -</td>
              <td>Admin Position :</td>
              <td><input name="admin_positionEN" type="text" class="k-textbox" onKeyUp="checkEngChar(this)" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['admin_positionEN'];?>
" size="40" maxlength="255">
                <br>
                *หากไม่มีกรุณาใส่ -</td>
            </tr>
            <tr>
              <td>ตำแหน่งงาน :</td>
              <td><input name="position" type="text" required class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['position'];?>
" size="40" maxlength="255" validationMessage="กรุณาป้อนข้อมล" onKeyUp="checkThai(this)"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>สังกัด :</td>
              <td><select name="under_major_id" >
                <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit']['under_major_id'])){?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['under_major_id'];?>
" selected>
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['major_name'];?>

                  </option>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_major']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['major_id'];?>
">
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['major_name'];?>

                  </option>
                <?php } ?>
                <?php }else{ ?>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_major']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['major_id'];?>
">
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['major_name'];?>

                  </option>
                <?php } ?>
                <?php }?>
              </select></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>วันจ้างงาน :</td>
              <td><input name="hire_date" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['hire_date'];?>
" size="40" id="hire_date" required validationMessage="กรุณาเลือกวันเริ่มจ้าง" class="k-textbox"></td>
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
                <input type="radio" name="gender" value="1" <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['gender']==1){?> checked<?php }?> >
                ชาย</label>
                <label>
                  <input type="radio" name="gender" value="0" <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['gender']==0){?> checked<?php }?>>
                  หญิง</label></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>วันเกิด :</td>
              <td><input name="birthday" id="birthday" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['birthday'];?>
" size="40" ></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr  valign="top">
              <td>ศาสนา :</td>
              <td><select name="religion" id="religion" >
                <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit']['religion'])){?>
                <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['religion']=="พุทธ"){?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religion'];?>
 | <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religionEN'];?>
" selected>
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religion'];?>

                  |
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religionEN'];?>

                  </option>
                <option value="คริสต์|Chirst">คริสต์ | Chirst</option>
                <option value="อิสลาม|Ilsam">อิสลาม | Ilsam</option>
                <option value="999" >อื่นๆ โปรดระบุ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['page']->value['edit']['religion']=="คริสต์"){?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religion'];?>
 | <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religionEN'];?>
" selected>
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religion'];?>

                  |
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religionEN'];?>

                  </option>
                <option value="พุทธ|Bhudda" >พุทธ | Bhudda</option>
                <option value="อิสลาม|Ilsam">อิสลาม | Ilsam</option>
                <option value="999" >อื่นๆ โปรดระบุ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['page']->value['edit']['religion']=="อิสลาม"){?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religion'];?>
 | <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religionEN'];?>
" selected>
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religion'];?>

                  |
                  <?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['religionEN'];?>

                  </option>
                <option value="คริสต์|Chirst">คริสต์ | Chirst</option>
                <option value="พุทธ|Bhudda" >พุทธ | Bhudda</option>
                <option value="999" >อื่นๆ โปรดระบุ</option>
                <?php }?>
                <?php }else{ ?>
                <option value="พุทธ|Bhudda" >พุทธ | Bhudda</option>
                <option value="คริสต์|Chirst">คริสต์ | Chirst</option>
                <option value="อิสลาม|Ilsam">อิสลาม | Ilsam</option>
                <option value="999" >อื่นๆ โปรดระบุ</option>
                <?php }?>
              </select>
                <p></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>กรุ๊ปเลือด :</td>
              <td><select name="blood_group">
                <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit']['blood_group'])){?>
                <?php switch ($_smarty_tpl->tpl_vars['page']->value['edit']['blood_group']){?>
<?php case "B":?>
                <option>B</option>
                <?php break;?><?php case "O":?>
                <option>O</option>
                <?php break;?><?php case "A":?>
                <option>A</option>
                <?php break;?><?php case "AB":?>
                <option>AB</option>
                <?php break;?><?php case "other":?>
                
                <?php }?>
                <?php }else{ ?>
                <option>O</option>
                <option>A</option>
                <option>B</option>
                <option>AB</option>
               
                <?php }?>
              </select></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr  valign="top">
              <td>ที่อยู่ที่ติดต่อได้ :</td>
              <td><textarea name="address" cols="40" rows="3" required validationMessage="กรุณากรอกที่อยู่ที่ติดต่อได้" class="k-textbox" onKeyUp="checkThai(this)"><?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['address'];?>
</textarea></td>
              <td>Address Contact :</td>
              <td class="odd"><textarea name="addressEN" cols="40" rows="3" required validationMessage="Address Contact is required." class="k-textbox" onKeyUp="checkEngChar(this)"><?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['addressEN'];?>
</textarea></td>
            </tr>
            <tr>
              <td>อำเภอ :</td>
              <td><input name="amphur" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['amphur'];?>
" size="40" required validationMessage="กรุณากรอกชื่ออำเภอ" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Amphur :</td>
              <td class="odd"><input name="amphurEN" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['amphurEN'];?>
" size="40" required validationMessage="Amphur is required." class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>จังหวัด :</td>
              <td><input name="province" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['province'];?>
" size="40" required validationMessage="กรุณากรอกชื่อจังหวัด" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Province :</td>
              <td class="odd"><input name="provinceEN" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['provinceEN'];?>
" size="40" required validationMessage="Province is required." class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>โทรศัพท์ :</td>
              <td><input name="mobile" type="tel"  value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['mobile'];?>
" size="40" maxlength="10" class="k-textbox" onKeyUp="checkDex(this)"></td>
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
              <td><input name="behavior_degree" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['behavior_degree'];?>
" size="40"  required validationMessage="กรุณาป้อนระดับการศึกษา ปริญญาตรี" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Behavior Degree :</td>
              <td><input name="behavior_degreeEN" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['behavior_degreeEN'];?>
" size="40"  required validationMessage="กรุณาป้อนระดับการศึกษา ปริญญาตรี" class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr>
              <td>ระดับปริญญาโท :</td>
              <td><input name="master_degree" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['master_degree'];?>
" size="40"  required validationMessage="กรุณาป้อนระดับการศึกษา ปริญญาโท" class="k-textbox" onKeyUp="checkThai(this)"></td>
              <td>Master Degree :</td>
              <td><input name="master_degreeEN" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['master_degreeEN'];?>
" size="40"  required validationMessage="กรุณาป้อนระดับการศึกษา ปริญญาโท" class="k-textbox" onKeyUp="checkEngChar(this)"></td>
            </tr>
            <tr  valign="top">
              <td>ระดับปริญญาเอก :</td>
              <td><input name="phd_degree" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['phd_degree'];?>
" size="40" class="k-textbox" onKeyUp="checkThai(this)">
                <br>
                *หากไม่ระบุ กรุณาใส่เครื่องหมาย -</td>
              <td>Doctor Degree :</td>
              <td><input name="phd_degreeEN" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['phd_degreeEN'];?>
" size="40" class="k-textbox" onKeyUp="checkEngChar(this)">
                <br>
*หากไม่ระบุ กรุณาใส่เครื่องหมาย -</td>
            </tr>
            <tr>
              <td>สถานะ :</td>
              <td><select name="status">
                <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit']['status'])){?>
                <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['status']==1){?>
                <option value="1" selected>เปิดใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['page']->value['edit']['status']==2){?>
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
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['page']->value['edit'])){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>" id="button" onClick="return confirm('ยืนยันข้อมูล')"></td>
            </tr>
          </tbody>
        </table>
      </fieldset>
    </form>
  </div>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="permission"){?>
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])||empty($_smarty_tpl->tpl_vars['page']->value['group'])){?>
  <div id="landing" style="text-align:center; padding:10pt; background:#FF0000;">
    <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>

    <?php if (empty($_smarty_tpl->tpl_vars['page']->value['group'])){?>
    <p>ไม่พบรายชื่อกลุ่มในระบบ กรุณาเพิ่มข้อมูล <a href="/edu/group">คลิ๊กที่นี้</a></p>
    <?php }?>ss
    <p>หากต้องการกลับหน้าหลักบุคลากร กรุณา <a href="/edu/employee/">คลิ๊กที่นี้</a></p>
  </div>
  <?php }?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/employee" style="text-decoration:underline;">จัดการบุคลากร</a> > กำหนดสิทธิ์บุคลากร
    
  </div>
  <div>
    <h1>กำหนดสิทธิ์บุคลากร</h1>
    <p>
    <form name="group_make" id="group_make" action="" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="6" bgcolor="#FFFFFF" style="border:#000000 1px solid;">
        <tr>
          <td width="16%">ชื่อ-สกุล :</td>
          <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['empdat']['titlename'];?>

            .
            <?php echo $_smarty_tpl->tpl_vars['page']->value['empdat']['firstname'];?>

            <?php echo $_smarty_tpl->tpl_vars['page']->value['empdat']['lastname'];?>
</td>
        </tr>
        <tr>
          <td >กลุ่ม :</td>
          <td colspan="2"><select name="group_id">
              <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['group_id'];?>
">
              <?php echo $_smarty_tpl->tpl_vars['item']->value['group_name'];?>

              </option>
              <?php } ?>
            </select>
            <a href="#" onClick="window.open('/edu/group#gt',null,'height=400,width=600,status=yes,toolbar=no,menubar=no,location=no');" >ดูรายละเอียดสิทธิ์แต่ละกลุ่ม</a></td>
        </tr>
        <tr>
          <th colspan="3"><input name="employee_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['empdat']['id'];?>
" type="hidden" >
            <input name="operation" type="submit" value="บันทึก" id="save" onClick="return confirm('ยืนยันข้อมูล')"></th>
        </tr>
      </table>
    </form>
    </p>
  </div>
  <?php }?>
  <div class="clear-all"></div>
</div>
</body>
</html><?php }} ?>