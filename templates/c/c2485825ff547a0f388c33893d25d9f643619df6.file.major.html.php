<?php /* Smarty version Smarty-3.1.7, created on 2012-05-12 11:33:35
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\major.html" */ ?>
<?php /*%%SmartyHeaderCode:272694f162a3fef2e61-75537677%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2485825ff547a0f388c33893d25d9f643619df6' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\major.html',
      1 => 1336579113,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '272694f162a3fef2e61-75537677',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f162a401c963',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'res' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f162a401c963')) {function content_4f162a401c963($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
ul.token-input-list-facebook{
	width:455px;
}
</style>
<script>
$(function(){

	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลสาขาวิชาหรือไม่")) return;
		$this = $(this);
		$.post("/edu/major",{ "del":$this.attr("rel")},function(data){
			if(data.result){
					$this.parents("tr").fadeOut("slow", function(){
						$this.parents("tr").remove();
					});
			}else{
					alert("ไม่สามารถลบได้ เนื่องจาก\n"+
					"- มีบุคลากรสังกัดอยู่\n"+
					"- มีหลักสูตรหรือแผนการศึกษาที่อ้างอิงกับสาขาวิชานี้\n"+
					"- มีนักศึกษาสังกัดอยู่\n"+
					"กรุณาแก้ไขที่หมวดสาขาวิชาก่อนทำการลบครั้งต่อไป คุณต้องการแก้ไขหรือไม่");
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
	function checkDex(elm){
		var filter = /^[0-9]*$/;
		if(!filter.test(elm.value)) {
			alert('ขออภัย กรอกเฉพาะตัวเลขเท่านั้น');
			elm.value = '';
			elm.focus();
		}
	}
	function chkValue(type,o){
		
		var bOpenchk = false;
		if(type === 'major_id' && o.value.length == 3){
			bOpenchk = true;
			$this = $(".status_bar_major")
		}else if((type === 'prefix_name' || type === 'prefix_nameEN')&& o.value.length == 2){
			bOpenchk = true;
			$this = (type === 'prefix_name')? $(".status_bar_prefix_name") : $(".status_bar_prefix_nameEN");
		}
	if(bOpenchk){
		$this.html('<img src="../../../common/images/icons/loading.gif" align="absmiddle">&nbsp;Checking availability...');
		$.post("/edu/major",
			{
				"chktype":type,
			 	"data":o.value
			},
			function(respond){
				if(respond.result){	
					$this.html('&nbsp;<img src="../../../common/images/icons/accepted.png" align="absmiddle"> <font color="Green"> Available </font>');
					return true;
				}else{
					$this.html('&nbsp;<font color="red"> ไม่ว่าง </font>');
					return false;
				}
			},'json');
	}else{
		return false;
	}

}
	function getFacId(o){
		document.getElementById('major_id').value = o.value;
		return true;
	}
</script> 
<!-- CONTENT -->
<div class="container">
  <div> 
    <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
     <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการสาขาวิชา</div>
    <section>
      
      <ul style="padding:0;">
         <li class="k-button"><a href="/edu/major/form/new" class="add_new_icon ex1">เพิ่มสาขาวิชาที่เกี่ยวข้องใหม่</a></li>
        </ul>

      <table  width="100%" cellpadding="3" id="tblist">
       <thead style="text-decoration:underline; font-weight:bold;" class="k-header">
          <tr >
            <td width="65" align="center">รหัสสาขา</td>
            <td width="193" align="center">ชื่อสาขาวิชา</td>
            <td width="139" align="center">คำนำหน้ารายวิชา / prefix course name</td>
            <td width="149" align="center">สังกัด</td>
            <td width="170" align="center">website</td>
            <td width="70" align="center">สถานะ</td>
            <td width="144" align="center">ดำเนินการ</td>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top">
            <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['major_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>
</td>
            <td width="139" align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['prefix_name'];?>
 / <?php echo $_smarty_tpl->tpl_vars['row']->value['prefix_nameEN'];?>
</td>
            <td valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>
</td>
            <td valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['website'];?>
</td>
            <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['status1'];?>
</td>
            <td >
            <ul class="ulmenu">
                 <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/major/form/edit?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['major_id'];?>
"> แก้ไขสาขาวิชา</a></li>
                  <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"><a href="#" class="rdel" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['major_id'];?>
"> ลบสาขาวิชา</a></li>
             </ul>
           </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
     <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/major" style="text-decoration:underline;">จัดการสาขาวิชา</a> > <?php if (empty($_smarty_tpl->tpl_vars['row']->value['edit'])){?>เพิ่มสาขาวิชาใหม่<?php }else{ ?>แก่้ไขสาขาวิชา<?php }?></div>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
   <div id="landing" style="text-align:center; padding:10pt; background:#FFFFCC;">
     <p>
       <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>

     </p>
     <p>หากต้องการเพิ่มวิชาเรียน กรุณา <a href="/edu/course">คลิ๊กที่นี้</a></p>
   </div>
    <?php }?>
    <a href="/edu/major" class="k-button ex1" >Show all data</a>
    <div>
    <form id="addnew" method="post" action="">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:1px #000000 solid;">
        <thead class="k-header">
          <tr>
            <th colspan="2" scope="col">แบบฟอร์มบันทึก และแก้ไขสาขาวิชาที่เกี่ยวข้อง</th>
          </tr>
         
          </thead>
          <tbody>
 <tr>
            <td>สังกัดคณะ :</td>
            <td><select name="fac_id" onChange="return getFacId(this)">
              <option selected disabled value="">กรุณาเลือก</option>
              <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['faculty']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
              <?php if ($_smarty_tpl->tpl_vars['item']->value['fac_id']==$_smarty_tpl->tpl_vars['row']->value['edit']['fac_id']){?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['fac_id'];?>
" selected>
                <?php echo $_smarty_tpl->tpl_vars['item']->value['fac_name'];?>

                </option>
              <?php }else{ ?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['fac_id'];?>
">
                <?php echo $_smarty_tpl->tpl_vars['item']->value['fac_name'];?>

                </option>
              <?php }?>
              <?php } ?>
            </select></td>
          </tr>
          <tr>
            <td>รหัสสาขา :</td>
            <td><input type="text" name="major_id" id="major_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['major_id'];?>
" size="4" maxlength="4" onKeyUp="return chkValue('major_id',this),checkDex(this)" style="float:left;" class="k-textbox" required ><div class="status_bar_major" style="position:relative; float:left; padding:3px;"></div></td>
          </tr>
          <tr>
            <td width="20%">ชื่อสาขาวิชา :</td>
            <td width="80%"><input type="text" name="major_name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['major_name'];?>
" size="70" maxlength="255"  style="float:left;"  class="k-textbox" required></td>
          </tr>
          <tr>
            <td>Major Name :</td>
            <td><input name="major_nameEN" required value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['major_nameEN'];?>
" size="70" maxlength="255" onKeyUp="checkEngChar(this)"  class="k-textbox" ></td>
          </tr>
          <tr>
            <td>ชื่อขึ้นต้นรายวิชา :</td>
            <td><input name="prefix_name" class="k-textbox" size="3" maxlength="2" required style="float:left" onKeyUp="return chkValue('prefix_name',this)" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['prefix_name'];?>
"><div class="status_bar_prefix_name" style="position:relative; float:left; padding:3px;"></div></td>
          </tr>
          <tr>
            <td>Prefix course name :</td>
            <td><input name="prefix_nameEN" class="k-textbox" size="3" maxlength="2" required style="float:left;" onKeyUp="return chkValue('prefix_nameEN',this),checkEngChar(this)" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['prefix_nameEN'];?>
"><div class="status_bar_prefix_nameEN" style="position:relative; float:left; padding:3px;"></div></td>
          </tr>
          <tr>
            <td>website :</td>
            <td><input name="website" type="text" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['website'];?>
" size="70" maxlength="255" required  class="k-textbox">
            *หากไม่ระบุ กรุณาใส่เครื่องหมาย -</td>
          </tr>
          <tr >
            <td>สถานะ :</td>
            <td>
              <select name="status">
                <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['edit']['status'])){?>
                <?php if ($_smarty_tpl->tpl_vars['row']->value['status']==1){?>
                <option value="1" selected>ใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['row']->value['status']==2){?>
                <option value="2" selected>รอการอนุมัติ</option>
                <option value="0" >ยกเลิกการใช้งาน</option>
                <option value="1">เปิดใช้งาน</option>
                <?php }else{ ?>
                <option value="0" selected>ยกเลิกการใช้งาน</option>
                <option value="1">ใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }?>
                <?php }else{ ?>
                <option value="2">รอการอนุมัติ</option>
                <option value="1" selected>ใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                
                <?php }?>
                </select>
              </td>
          </tr>
          <tr>
          	<td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>" id="button"/> <input type="reset" value="Clear" id="button"/></td>
          </tr>
          </tbody>
        </table>
        </fieldset>
      </form>
    </div>
    <?php }?>
  </div>
  <div class="clear-all"></div>
</div>
</body>
</html><?php }} ?>