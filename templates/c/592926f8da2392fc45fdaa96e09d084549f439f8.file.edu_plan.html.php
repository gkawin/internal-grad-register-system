<?php /* Smarty version Smarty-3.1.7, created on 2012-02-02 12:09:17
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\edu_plan.html" */ ?>
<?php /*%%SmartyHeaderCode:197314f2a6eddc70e75-48597746%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '592926f8da2392fc45fdaa96e09d084549f439f8' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\edu_plan.html',
      1 => 1328180674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197314f2a6eddc70e75-48597746',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f2a6eddd7c29',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f2a6eddd7c29')) {function content_4f2a6eddd7c29($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
		$.post("/edu/major",{ "del":$this.attr("rel")},function(data){
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
  oTable = $('#tblist').dataTable({
		"bJQueryUI": false,
		"bStateSave": true,
		"oLanguage": {
			"sLengthMenu": "แสดง _MENU_ แถวต่อหน้า",
			"sZeroRecords": "ไม่มีข้อมูล",
			"sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
			"sInfoEmtpy": "ไม่มีข้อมูล",
			"sInfoFiltered": "(จากทั้งหมด _MAX_ แถว)",
			"sSearch": "ค้นหา",
			"sPaginationType" : "full_numbers",
			"bFilter": true,
			 "aoColumns": [
                { "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": false },
                ]

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
	function chkValue(value){
		if(value.length >=6){
			$("#status_bar").html('<img src="../../../common/images/icons/loading.gif" align="absmiddle">&nbsp;Checking availability...');
			 $.ajax({  
    		type: "POST",  
			url: "/edu/major",  
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
  <div style="margin-left:10pt; width:98%; "> 
    <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
    <section style="width:100%; margin-top:15pt;">
      <div class="toolbar">
        <ul>
         <a href="/edu/major/form" class="k-button"><li class="add_new_icon">เพิ่มคณะที่เกี่ยวข้องใหม่</li></a>
          <a href="#delete" id="ldel" class="k-button"><li class="list_del_icon">ลบทีละหลายรายการ</li></a>
        </ul>
      </div>
      <table  width="100%" cellpadding="3" class="tblist" id="tblist">
       <thead>
          <tr>
            <td width="27" align="center"><input type="checkbox" name="cball" id="cball" /></td>
            <td width="71">รหัสสาขา</td>
            <td width="170">ชื่อสาขาวิชา</td>
            <td width="165">Major Name</td>
            <td width="152">สังกัด</td>
            <td width="186" >website</td>
            <td width="103" align="center">สถานะ</td>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top">
            <td align="center"><input type="checkbox" name="cb[]" id="cb[]" class="cb" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['major_id'];?>
" /></td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['major_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>
<div class="tool"> <a href="/edu/major/form?editid=<?php echo $_smarty_tpl->tpl_vars['row']->value['major_id'];?>
"  class="k-button">Edit</a> | <a href="#" class="rdel k-button" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
">Delete</a> </div></td>
            <td width="165"><?php echo $_smarty_tpl->tpl_vars['row']->value['major_nameEN'];?>
</td>
            <td valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>
</td>
            <td valign="top"><?php echo $_smarty_tpl->tpl_vars['row']->value['website'];?>
</td>
            <td valign="top" align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['status1'];?>
</td>

          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['result'])){?>
    <div style="padding:20pt; background-color:#FC0; text-align:center; "><h1><?php echo $_smarty_tpl->tpl_vars['res']->value['result'];?>
</h1><br>
<?php if (!empty($_smarty_tpl->tpl_vars['row']->value)){?><a href="/edu/major"  class="k-button"> Click Here to Forward</a><?php }?></div>
    <?php }?>
    <a href="/edu/major" class="k-button" >Show all data</a><br>
    <div>
    <form id="addnew" method="post" action="">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <thead>
          <tr>
            <th colspan="2" scope="col" style="
            padding:15pt;">แบบฟอร์มบันทึก และแก้ไขสาขาวิชาที่เกี่ยวข้อง</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td>รหัสสาขา :</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="20%">ชื่อคณะ :</td>
            <td width="80%"><input type="text" name="fac_name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>
" size="70" maxlength="255" onKeyUp="return chkValue(this.value)" style="float:left;"><div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
            </tr>
          <tr  class="odd">
            <td>Faculty Name :</td>
            <td><input name="fac_nameEN" class="required" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_nameEN'];?>
" size="70" maxlength="255" onKeyUp="checkEngChar(this)"></td>
          </tr>
          <tr>
            <td>วิสัยทัศน์  :</td>
            <td><textarea name="determination" cols="70" rows="3" onKeyUp="checkDex(this)"><?php echo $_smarty_tpl->tpl_vars['row']->value['determination'];?>
</textarea></td>
          </tr>
          <tr class="odd">
            <td>ภารกิจ  :</td>
            <td><textarea name="mission" cols="70" rows="3" onKeyUp="checkDex(this)"><?php echo $_smarty_tpl->tpl_vars['row']->value['mission'];?>
</textarea></td>
          </tr>
          <tr>
            <td>วัตถุประสงค์  :</td>
            <td><textarea name="objective" cols="70" rows="3" onKeyUp="checkDex(this)"><?php echo $_smarty_tpl->tpl_vars['row']->value['objective'];?>
</textarea></td>
          </tr>
          <tr class="odd">
            <td>website :</td>
            <td><input name="website" type="text" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['website'];?>
" size="70" maxlength="255"></td>
          </tr>
          <tr class="odd">
            <td>สถานะ :</td>
            <td>
              <select name="status">
                <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['status'])){?>
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
                <option value="1">ใช้งาน</option>
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
</div>
</body>
</html><?php }} ?>