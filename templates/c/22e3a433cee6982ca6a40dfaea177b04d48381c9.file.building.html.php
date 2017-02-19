<?php /* Smarty version Smarty-3.1.7, created on 2012-06-17 16:15:54
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\building.html" */ ?>
<?php /*%%SmartyHeaderCode:269454f029875b44b29-52572497%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22e3a433cee6982ca6a40dfaea177b04d48381c9' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\building.html',
      1 => 1339924552,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '269454f029875b44b29-52572497',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f029875b9cff',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f029875b9cff')) {function content_4f029875b9cff($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
ul.token-input-list-facebook{
	width:455px;
}
</style>
<script>
$(function(){

	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลอาคารเรียนหรือไม่")) return;
		$this = $(this);
		$this.addClass("loading");
		$.post("/edu/building",{ "del":$this.attr("rel"),"building_name":$this.attr("data-rel")},function(data){
			if(data.result){
					$this.parents("tr").fadeOut("fast", function(){
						$this.parents("tr").remove();
					});
					$this.removeClass("loading");
			}else{
				alert("ไม่สามารถลบได้");
				$this.removeClass("loading");
			}
		},'json');
		return(false);
	});
	
});
	function chkValue(elm){
		var filter = /^[0-9]*$/;
		if(!filter.test(elm.value)) {
			alert('ขออภัย กรุณาป้อนตัวเลขเท่านั้น');
			elm.value = '';
			elm.focus();
			return false;
		}else{
			if(elm.value.length>=3){
			$("#status_bar").html('<img src="../../../common/images/icons/loading.gif" align="absmiddle">&nbsp;Checking availability...');
			 $.ajax({  
    		type: "POST",  
			url: "/edu/building",  
			data: "chkAvaliable="+ elm.value,  
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
			$("#status_bar").html('<font color="red">กรุณากรอกให้มากกว่า <strong>3</strong> ตัวอักษร</font>');
			return false;
		}
	}
	}
</script> 
<!-- CONTENT -->
<div class="container">
  <div> 
    <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
    <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการอาคาร</div>

    <section style=" width:100%; padding-bottom:30px;">
      
        <ul style="padding:0; list-style:none;">
         <a href="/edu/building/form/new" class="k-button ex1" > <li class="add_new_icon">เพิ่มอาคารเรียนใหม่</li></a>
        </ul>
      
      <table  width="100%" cellpadding="3" id="tblist">
        <thead  style="text-decoration:underline; font-weight:bold;" class="k-header">
          <tr>
            <th width="68">เลขที่อาคาร</th>
            <th width="407">ชื่ออาคาร</th>
            <th width="111">จำนวนชั้นทั้งหมด</th>
            <th width="112">วิทยาเขต</th>
            <th width="117">สถานะ</th>
            <th width="123">ดำเนินการ</th>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top">
            <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['building_name'];?>
</td>
            <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['total_floor'];?>
</td>
            <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['campus'];?>
</td>
            <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['status1'];?>
</td>
            <td align="left">
            <ul class="ulmenu">
              	<li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/building/form/edit?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
">แก้ไขรายการ</a>
                <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"> <a href="#" class="rdel" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_name'];?>
">ลบรายการ</a></li>
            </ul></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
    <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/building" style="text-decoration:underline;">จัดการอาคาร</a> > เพิ่มอาคาร</div>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback'])){?>
      <p id="landing">
      <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>
	หากต้องการกำหนดห้องเรียน กรุณา <a href="/edu/building_room">คลิ๊กที่นี้</a>
    </p>
    
</div>
    <?php }?>
   <div>
    <form id="addnew" method="post" action="" >
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:#FFF 1px solid;">
          <thead class="k-header">
          <tr>
            <th colspan="2">แบบฟอร์มบันทึก และแก้ไขอาคารเรียน</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td width="20%">รหัสอาคาร :</td>
            <td width="80%"><input name="building_id" class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
" size="2" maxlength="3" required <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['building_id'])){?> readonly <?php }?> onKeyUp="chkValue(this),checkDex(this)" style="float:left;"><div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
            </tr>
          <tr>
            <td>ชื่ออาคาร :</td>
            <td><input name="building_name" class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_name'];?>
" size="70" maxlength="255" required></td>
          </tr>
          <tr>
            <td>Building Name :<br/>
             (if available)</td>
            <td><input name="building_nameEN" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['building_nameEN'];?>
" size="70" maxlength="255" onKeyUp='checkEngChar(this)' required class="k-textbox"></td>
          </tr>
      
          <tr>
            <td>วิทยาเขต :</td>
            <td>
            <select name="campus">
            <?php if ($_smarty_tpl->tpl_vars['row']->value['campus']=="เชียงใหม่"){?>
            <option selected>เชียงใหม่</option>
            <option>แพร่</option>
            <option>ชุมพร</option>
            <?php }elseif($_smarty_tpl->tpl_vars['row']->value['campus']=="แพร่"){?>
            <option selected>แพร่</option>
            <option>เชียงใหม่</option>
            <option>ชุมพร</option>
            <?php }else{ ?>
            <option selected>ชุมพร</option>
            <option>แพร่</option>
            <option>เชียงใหม่</option>
            <?php }?>
            </select>
            <!--<input name="campus" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['campus'];?>
" size="70" maxlength="255" class="k-textbox" <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['campus'])){?> readonly <?php }?> required>--></td>
          </tr>
          <tr>
            <td>จำนวนชั้น :</td>
            <td><input name="total_floor" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['total_floor'];?>
" size="5" maxlength="2" class="k-textbox" required onKeyUp="return checkDex(this)"></td>
          </tr>
          <tr>
            <td>สถานะ :</td>
            <td><select name="status">
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
              <option value="1">เปิดใช้งาน</option>
              <option value="0">ยกเลิกการใช้งาน</option>
              <option value="2">รอการอนุมัติ</option>
              <?php }?>
              </select>
              </td>
          </tr>
          <tr>
          	<td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>" onClick="return confirm('ยืนยันข้อมูล')"></td>
          </tr>
          </tbody>
      </table>
        </fieldset>
      </form>
  
    </div>
    <?php }?>
  </div>
</div>
</body>
</html><?php }} ?>