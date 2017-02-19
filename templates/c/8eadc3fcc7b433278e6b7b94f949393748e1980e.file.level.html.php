<?php /* Smarty version Smarty-3.1.7, created on 2012-07-02 21:42:04
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\level.html" */ ?>
<?php /*%%SmartyHeaderCode:108094faab992524ef7-09701289%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8eadc3fcc7b433278e6b7b94f949393748e1980e' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\level.html',
      1 => 1341240121,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108094faab992524ef7-09701289',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4faab9925988e',
  'variables' => 
  array (
    'page' => 0,
    'item' => 0,
    'row' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faab9925988e')) {function content_4faab9925988e($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>


</style>
<script>
$(function(){
	$(".del").click(function(){
		var sBin = $(this).attr("rel");
		$this = $(this);
		if(!confirm("คุณต้องการลบหรือไม่"))return;
			$.post("/edu/level/del",{ "target":sBin},
			function(data){
				if(data.result){
					$this.parents("tr").fadeOut('slow',
					function(){
						$this.parents("tr").remove();
					});
				}else{
					if(confirm("ไม่สามารถทำรายการได้เนื่องจาก\n- มีหลักสูตรสังกัดอยู่ในระดับปริญญานี้\nหากต้องการแก้ไข้กดตกลง"))
					window.location="/edu/syllabus";
				}
			},"json");
	});
});
function showInputDeg(){
	$("input#deg_lvl").show();
	$("input#deg_lvl").attr("name","degree_level_name");
	$("select#deg_lvl").removeAttr("name");
	$("input#degree_level_nameEN").val("");
	$("input#degree_level_nameEN").removeAttr("readonly");
}
function removeInputDeg(){
	$("input#deg_lvl").hide()
	$("input#deg_lvl").removeAttr("name");
	$("select#deg_lvl").attr("name","degree_level_name");
	$("input#degree_level_nameEN").attr("readonly","readonly");
}
function chkother(o){
	if(o.value ==0){
		showInputDeg();
		
	}else if(o.value ==="ปริญญาเอก"){
		removeInputDeg();
		document.getElementById("degree_level_nameEN").value = "Doctor Degree";
	}else if(o.value ==="ปริญญาโท"){
		removeInputDeg();
		document.getElementById("degree_level_nameEN").value = "Master Degree";
	}else{
		removeInputDeg();
	}
}
</script>
<!-- CONTENT -->
<div class="container">
  <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="main"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการระดับปริญญา</div>
  <div>
    <ul style="padding:0;">
      <li class="k-button"><a href="/edu/level/new" class="add_new_icon ex1">เพิ่มระดับปริญญา</a></li>
    </ul>
  </div>
  <div>
    <table  width="100%" cellpadding="5" class="tblist" id="tblist">
      <thead class="k-header">
        <tr>

          <th>ระดับปริญญา</th>
          <th>Degree Level</th>
          <th>วุฒิการศึกษา</th>
          <th>Qualification</th>
          <th>ดำเนินการ</th>
        </tr>
      </thead>
      <tbody>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>

          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['degree_level_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['degree_level_nameEN'];?>
 (<?php echo $_smarty_tpl->tpl_vars['item']->value['typeEN'];?>
)</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['qualification'];?>
  (<?php echo $_smarty_tpl->tpl_vars['item']->value['qualification_init'];?>
)</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['qualificationEN'];?>
  (<?php echo $_smarty_tpl->tpl_vars['item']->value['qualification_initEN'];?>
)</td>
          <td><ul class="ulmenu">
              <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/level/edit?id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">แก้ไขระดับปริญญา</a></li>
              <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"> <a href="#" class="del" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">ลบระดับปริญญา</a></li>
            </ul></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/level" style="text-decoration:underline;">จัดการระดับปริญญา</a> >
    <?php if (empty($_smarty_tpl->tpl_vars['row']->value['_editsyll'])){?>
    เพิ่มใหม่
    <?php }else{ ?>
    แก้ไข
    <?php }?>
  </div>
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
    <p id="landing"><?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>หากต้องการเพิ่มประเภทวิชา กรุณา <a href="/edu/coursetype">คลิ๊กที่นี้</a></p>
  <?php }?>
  <div>
    <form name="frm" action="" method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:#000000 solid 1px;">
        <thead>
          <tr class="k-header">
            <th colspan="2" scope="col" >แบบฟอร์มเพิ่มรายละเอียดหลักสูตร</th>
          </tr>
        </thead>
        <tbody >
          <tr>
            <td width="20%" ><?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>
              ชื่อผู้บันทึก
              <?php }else{ ?>
              ชื่อผู้แก้ไข
              <?php }?>
              :</td>
            <td width="80%"><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
          </tr>
          <tr>
            <td>ระดับปริญญา :</td>
            <td>
            
            <select name="degree_level_name" id="deg_lvl" onChange="chkother(this)">
            
            <?php if (empty($_smarty_tpl->tpl_vars['page']->value['edit']['degree_level_name'])){?>
            <option disabled selected>กรุณาเลือก</option>
            <option>ปริญญาเอก</option>
            <option>ปริญญาโท</option>
            <option value="0">อื่นๆ กรุณาระบุ</option>
            <?php }else{ ?>
            <option selected><?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['degree_level_name'];?>
</option>
            <?php }?>
            </select>
            <input name="degree_level_name" id="deg_lvl"  size="30" maxlength="255" class="k-textbox" style="display:none;">
            
            </td>
          </tr>
          
          <tr>
            <td>Degree Level :</td>
            <td><input name="degree_level_nameEN" id="degree_level_nameEN" size="70" maxlength="255"  value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['degree_level_nameEN'];?>
" required class="k-textbox" readonly onKeyUp="checkEngChar(this)"></td>
          </tr>
          <tr>
            <td>ภาค :</td>
            <td>
            <select name="degree_level_type">
            <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit'])){?>
            	<?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['type']=="ปกติ"){?>
            	<option selected>ปกติ | Normal</option>
            	<option>สมทบ | Associate</option>
                <option>พิเศษ | Special</option>
                <?php }elseif($_smarty_tpl->tpl_vars['page']->value['edit']['type']=="สมทบ"){?>
                <option>ปกติ | Normal</option>
            	<option selected>สมทบ | Associate</option>
                <option>พิเศษ | Special</option>
                <?php }else{ ?>
                <option>ปกติ | Normal</option>
            	<option>สมทบ | Associate</option>
                <option selected>พิเศษ | Special</option>
                <?php }?>
            <?php }else{ ?>
	           	<option>ปกติ | Normal</option>
            	<option>สมทบ | Associate</option>
                <option>พิเศษ | Special</option>
            </select>
            <?php }?>
            </td>
          </tr>
          <tr>
            <td>วุฒิการศึกษา :</td>
            <td><input name="qualification" size="70" maxlength="255"  value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['qualification'];?>
" required class="k-textbox" onKeyUp="checkThai(this)"> <i>ตัวอย่าง ศิลปศาสตร์ดุษฎีบัณฑิต</i></td>
          </tr>
          <tr>
            <td>วุฒิการศึกษา (ย่อ) :</td>
            <td><input name="qualification_init" id="initDeg_name" type="text"  class="k-textbox" size="70" maxlength="10" required validationMessage="ระบุคุณวุฒิ" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['qualification_init'];?>
"> <i>ตัวอย่าง ศศ.ด</i></td>
          </tr>
          <tr>
            <td>Qualification : </td>
            <td><input name="qualificationEN" size="70" maxlength="255"  value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['qualificationEN'];?>
" required class="k-textbox" onKeyUp="checkEngChar(this)"> <i>Ex. Master of Science</i></td>
          </tr>
          
          <tr>
            <td>Qualification (Short) :</td>
            <td><input name="qualification_initEN" id="initDeg_nameEN" type="text"  class="k-textbox" size="70" maxlength="10" required validationMessage="Degree Qualification" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['qualification_initEN'];?>
" onKeyUp="checkEngChar(this)"> <i>Ex. M.S.</i ></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>"  onClick="return confirm('ยืนยันข้อมูล')">
              <input type="reset" value="Clear" ></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
  <?php }?>
  <div class="clear-all"></div>
</div>
</body>
</html><?php }} ?>