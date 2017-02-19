<?php /* Smarty version Smarty-3.1.7, created on 2012-03-29 08:08:45
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\deg.html" */ ?>
<?php /*%%SmartyHeaderCode:132574efffd3336f0d4-94657073%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '277c1bb1a6c778f9a5edce8e132262f947fccafc' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\deg.html',
      1 => 1333001304,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132574efffd3336f0d4-94657073',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4efffd333ad60',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4efffd333ad60')) {function content_4efffd333ad60($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
.toolbar ul {
	list-style:none;padding:0;
}


.odd{ background:#FFFAE6;}
ul.token-input-list-facebook{
	width:455px;
}
</style>
<script>
$(function(){
	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลระดับการศึกษาหรือไม่")) return;
		$this = $(this);
		$this.addClass("loading");
		$.post("/edu/degree",{ "del":$this.attr("rel"),"getview":"<?php echo $_smarty_tpl->tpl_vars['page']->value['getview'];?>
"},function(data){
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
	function chkValue(value){
		if(value.length >=6){
			$("#status_bar").html('<img src="../../../common/images/icons/loading.gif" align="absmiddle">&nbsp;Checking availability...');
			 $.ajax({  
    		type: "POST",  
			url: "/edu/degree",  
			data: { "chkAvaliable": value,"getview":"<?php echo $_smarty_tpl->tpl_vars['page']->value['getview'];?>
"},  
			success: 
				function(msg){
			 		$("#status_bar").ajaxComplete(function(event, request, settings){ 
					if(msg == 'OK'){ 
						$(this).html('&nbsp;<img src="../../../common/images/icons/accepted.png" align="absmiddle"> <font color="Green"> Available </font>');
					}else{  
						$(this).html(msg);
						return false;
					}   
				});
				}
			});
		}else{
			$("#status_bar").html('<font color="red">กรุณากรอกให้มากกว่า <strong>6</strong> ตัวอักษร</font>');
		}
	}
</script> 
<!-- CONTENT -->
<div class="container"> 
  <!--- DEGREE LEVEL ZONE ---->
  <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
  <section>
    <div class="toolbar">
      <ul>
        <li class="k-button"><a href="/edu/degree/form" class="add_new_icon">เพิ่มโปรแกรมการศึกษาใหม่</a></li>
      </ul>
    </div>
    <table  width="100%" cellpadding="3" class="tblist" id="tblist">
      <thead style="text-decoration:underline; font-weight:bold; text-align: left;" class="k-header">
        <tr>
          <td width="132">รหัสโปรแกรม</td>
          <td width="313">ชื่อโปรแกรมการศึกษา</td>
          <td width="292" align="left">Program Name</td>
          <td width="53" align="left">จำนวนปี</td>
          <td width="48" align="left">ปีสูงสุด</td>
          <td width="100" align="left">เกรดเฉลี่ยต่ำสุด</td>
        </tr>
      </thead>
      <tbody>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr class="rowhl" valign="top">
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['program_id'];?>

            <div class="tool"> <a href="/edu/faculty/form?editid=<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_id'];?>
" class="k-button">Edit</a> | <a href="#" class="rdel k-button" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_id'];?>
">Delete</a></div></td>
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['program_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>
</td>
          <td width="292" align="left">
            <?php echo $_smarty_tpl->tpl_vars['row']->value['program_nameEN'];?>
(<?php echo $_smarty_tpl->tpl_vars['row']->value['major_nameEN'];?>
)</td>
          <td  valign="top" align="left"><?php echo $_smarty_tpl->tpl_vars['row']->value['years_normal'];?>
</td>
          <td valign="top" align="left"><?php echo $_smarty_tpl->tpl_vars['row']->value['max_years'];?>
</td>
          <td valign="top" align="left"><?php echo $_smarty_tpl->tpl_vars['row']->value['minimum_gpa'];?>
</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
<div>
  <a href="/edu/degree">Show All Data</a>
  <form method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
      <thead>
        <tr class="k-header">
          <th colspan="2" scope="col" >แบบฟอร์มเพิ่มรายละเอียดโปรแกรทการศึกษา</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>
            ชื่อผู้บันทึก
            <?php }else{ ?>
            ชื่อผู้แก้ไข
            <?php }?>
            :</td>
          <td><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
        </tr>
        <tr class="odd">
          <td>รหัสหลักสูตร :</td>
          <td><input name="program_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['program_id'];?>
" size="11" maxlength="11" onKeyUp="checkDex(this)"></td>
        </tr>
        <tr>
          <td width="20%">ชื่อหลักสูตร :</td>
          <td width="80%"><input name="program_name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['program_name'];?>
" size="70" maxlength="255" onkeyup="chkValue(this.value)" style="float:left;" class="required">
          <div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
        </tr>
        <tr class="odd">
          <td>Program Name :</td>
          <td><input name="program_nameEN" class="required" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['program_nameEN'];?>
" size="70" maxlength="255" onKeyUp="checkEngChar(this)"></td>
        </tr>
        <tr>
          <td>ชื่อปริญญา :</td>
          <td><?php if (!empty($_smarty_tpl->tpl_vars['row']->value)){?>
            <select name="degree_id">
              <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['degree_id'];?>
" selected>
              <?php echo $_smarty_tpl->tpl_vars['row']->value['degree_name'];?>

              |
              <?php echo $_smarty_tpl->tpl_vars['row']->value['degree_level_name'];?>

              </option>
            </select>
            <?php }else{ ?>
            <select name="degree_id">
              <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['degree_id'];?>
">
              <?php echo $_smarty_tpl->tpl_vars['item']->value['degree_name'];?>

              |
              <?php echo $_smarty_tpl->tpl_vars['item']->value['degree_level_name'];?>

              </option>
              <?php } ?>
            </select>
            <?php }?></td>
        </tr>
        <tr class="odd">
          <td>จำนวนปีของหลักสูตร :</td>
          <td><input name="program_year" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['years_normal'];?>
" size="11" maxlength="11" onKeyUp="checkDex(this)">
            ปี</td>
        </tr>
        <tr class="odd">
          <td>จำนวนปีของหลักสูตร (สูงสุด) :</td>
          <td><input name="program_year2" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['max_years'];?>
" size="11" maxlength="11" onKeyUp="checkDex(this)">
            ปี</td>
        </tr>
        <tr class="odd">
          <td>เกรดเฉลี่ยต่ำสุด :</td>
          <td><input name="mini" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['program_years'];?>
" size="11" maxlength="11" onKeyUp="checkDex(this)"></td>
        </tr>
        <tr class="odd">
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
              <option value="2">รอการอนุมัติ</option>
              <option value="1">เปิดใช้งาน</option>
              <option value="0">ยกเลิกการใช้งาน</option>
              <?php }?>
            </select></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>" id="button"/>
            <input type="reset" value="Clear" id="button"/></td>
        </tr>
      </tbody>
    </table>
  </form>
  </div>
  <?php }?>

  <div class="clear-all"></div>
</div>
</div>
</body>
</html><?php }} ?>