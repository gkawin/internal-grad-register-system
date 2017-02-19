<?php /* Smarty version Smarty-3.1.7, created on 2012-01-14 14:37:21
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\room.html" */ ?>
<?php /*%%SmartyHeaderCode:199114f033b639ce0c7-93305993%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'defb62b0b87ecb43f54dbe4d3d038774b97789b1' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\room.html',
      1 => 1326548217,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199114f033b639ce0c7-93305993',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f033b63a6db9',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f033b63a6db9')) {function content_4f033b63a6db9($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
.toolbar{
	padding:10pt;	
}
.toolbar ul{
	list-style:none; display:inline; padding:0; margin:0;
}
.toolbar ul li{
	display:inline;
}
.tblist{
	border:solid 1px #999;
}
.tblist td{
	padding:3px 7px;
}
.tblist thead td{
	background:url(images/bg1.png) repeat-x #CCC; 
	font-family: Tahoma, Geneva, sans-serif;
	font-weight:bold;
}
.tblist tbody tr td{
	border-bottom:solid 1px #EEE;
}
.tblist tbody tr.rowhl{
	background-color:#FCFCFC;
}
tr td{
	border-bottom:#DDECFF solid 1px;
}
thead{
	background:#999999;
}
tbody{
	background:#FFFFFF;
}
ul li{
	list-style:none;
	display:inline;
}
.odd{ background:#FFFAE6;}
</style>
<script>
$(function(){
	$("#cball").click(function(){
				$(".cb").attr("checked", this.checked);
	});
	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลระดับการศึกษาหรือไม่")) return;
		$this = $(this);
		$this.addClass("loading");
		$.post("/edu/building",{ "del":$this.attr("rel")},function(data){
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
  oTable = $('#tblist').dataTable({
		"bJQueryUI": false,
		"bStateSave": true,
		"oLanguage": {
			"sLengthMenu": "แสดง _MENU_ แถวต่อหน้า",
			"sZeroRecords": "ไม่มีข้อมูล",
			"sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
			"sInfoEmtpy": "ไม่มีข้อมูล",
			"sInfoFiltered": "(จากทั้งหมด _MAX_ แถว)",
			"sSearch": "ค้นหา"
		}
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
</script> 
<!-- CONTENT -->
<div class="content">
  <div style="margin-left:10pt; width:94%; position:relative;  float:left; padding:10pt;
height:auto;"> 
    <!-- <div id="btnLayout"> <a href="/edu/building">
      <button id="button" class="degreeManage"> <img src="/templates/skin/default/images/add_page.png" width="24" height="24" align="absmiddle" />จัดการระดับการศึกษา</button>
      </a> <a href="/edu/degree?action=program">
      <button id="button" class="programManage" > <img src="/templates/skin/default/images/icon/magnifier_left.png" width="24" height="24" align="absmiddle" />จัดการโปรแกรมการศึกษา</button>
      </a> </div>-->
    <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
    <section style=" width:100%; margin-top:15pt;">
      <div class="toolbar">
        <ul>
          <li><a href="/edu/building/form">เพิ่มระดับการศึกษาใหม่</a></li>
          <li><a href="#delete" id="ldel">Delete</a></li>
        </ul>
      </div>
      <table  width="100%" cellpadding="3" class="tblist" id="tblist">
        <thead>
          <tr>
            <td width="24" align="center"><input type="checkbox" name="cball" id="cball" /></td>
            <td width="63" align="center">เลขที่อาคาร</td>
            <td width="253">ชื่ออาคาร</td>
            <td width="302">Building Name</td>
            <td width="143">วิทยาเขต</td>
            <td width="97">สถานะ</td>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top">
            <td align="center"><input type="checkbox" name="cb[]" id="cb[]" class="cb" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" /></td>
            <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['building_name'];?>
<div class="tool"> <a href="/edu/building/form?editid=<?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
">Edit</a> | <a href="#" class="rdel" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
">Delete</a> </div></td>
            <td width="302" valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['building_nameEN'];?>
</td>
            <td  valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['campus'];?>
</td>
            <td  valign="top"><?php if ($_smarty_tpl->tpl_vars['row']->value['status']==1){?>เปิดใช้งาน<?php }elseif($_smarty_tpl->tpl_vars['row']->value['status']==0){?>ยกเลิกการใช้งาน<?php }else{ ?>รอการอนุมัติ<?php }?></td>
          </tr>
          <?php }
if (!$_smarty_tpl->tpl_vars['row']->_loop) {
?>
          <tr>
            <td colspan="6" class="notfound">item not found</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['result'])){?>
    <div style="padding:20pt; background-color:#FC0; text-align:center; "><h1><?php echo $_smarty_tpl->tpl_vars['res']->value['result'];?>
</h1><br>
<?php if (!empty($_smarty_tpl->tpl_vars['row']->value)){?><a href="/edu/building"> Click Here to Forward</a><?php }?></div>
    <?php }?>
    <a href="/edu/building" >Show all data</a><br>
    <div>
    <form id="addnew" method="post" action="" enctype="multipart/form-data">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <thead>
          <tr>
            <th colspan="2" scope="col" style="
            padding:15pt;">แบบฟอร์มบันทึก และแก้ไขอาคารเรียน</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td width="20%">รหัสอาคาร :</td>
            <td width="80%"><input name="building_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
" size="2" maxlength="3" class="required" onBlur="checkDex(this)" <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['building_id'])){?> readonly <?php }?>></td>
            </tr>
          <tr  class="odd">
            <td>ชื่ออาคาร :</td>
            <td><input name="building_name" class="required" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_name'];?>
" size="70" maxlength="255"></td>
          </tr>
          <tr>
            <td>Building Name :<br/>
             (if available)</td>
            <td><input name="building_nameEN" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_nameEN'];?>
" size="70" maxlength="255" onBlur='checkEngChar(this)'></td>
          </tr>
          <tr class="odd">
            <td>แบบแปลน (ถ้ามี) :</td>
            <td><?php if (empty($_smarty_tpl->tpl_vars['row']->value['model_path'])){?><input type="file" name="model_path"><?php }else{ ?><img src="<?php echo $_smarty_tpl->tpl_vars['row']->value['model_path'];?>
" width="128" height="64"/><?php }?></td>
          </tr>
          <tr>
            <td>วิทยาเขต :</td>
            <td>
            <input name="campus" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['campus'];?>
" size="70" maxlength="255" class="required" <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['campus'])){?> disabled <?php }?>></td>
          </tr>
          <tr class="odd">
            <td>รายละเอียด :</td>
            <td><textarea name="description" cols="70" rows="3" ><?php echo $_smarty_tpl->tpl_vars['row']->value['description'];?>
</textarea></td>
          </tr>
          <tr>
            <td>สถานะ :</td>
            <td><select name="status">
            <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['status'])){?>
            	<?php if ($_smarty_tpl->tpl_vars['row']->value['status']==1){?>
                	<option value="1" disabled>เปิดใช้งาน</option>
                    <option value="0">ยกเลิกการใช้งาน</option>
                    <option value="2">รอการอนุมัติ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['row']->value['status']==2){?>
                	<option value="2" disabled>รอการอนุมัติ</option>
                    <option value="0" >ยกเลิกการใช้งาน</option>
                    <option value="1">เปิดใช้งาน</option>
                <?php }else{ ?>
                    <option value="0" disabled>ยกเลิกการใช้งาน</option>
                    <option value="1">เปิดใช้งาน</option>
                   	<option value="2">รอการอนุมัติ</option>
                <?php }?>
              <?php }else{ ?>
              		<option value="1">เปิดใช้งาน</option>
                    <option value="0">ยกเลิกการใช้งาน</option>
                    <option value="2">รอการอนุมัติ</option>
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
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>