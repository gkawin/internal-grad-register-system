<?php /* Smarty version Smarty-3.1.7, created on 2012-07-05 23:01:33
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\faculty.html" */ ?>
<?php /*%%SmartyHeaderCode:316424f145dcd8973e0-59780013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abc57f5a88488c45289a2fc39c4bceba98c41c2d' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\faculty.html',
      1 => 1341504087,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '316424f145dcd8973e0-59780013',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f145dcdbf200',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    '_major' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f145dcdbf200')) {function content_4f145dcdbf200($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
ul.token-input-list-facebook{
	width:455px;
}
</style>
<script>
$(function(){
	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลคณะหรือไม่")) return;
		$this = $(this);
		$.post("/edu/faculty",{ "del":$this.attr("rel"),"fac_name" : $this.attr("data-rel")},function(data){
			if(data.result){
				$this.parents("tr").fadeOut("fast", function(){
				$this.parents("tr").remove();
				});
			}else{
				alert("ไม่สามารถลบได้ เนื่องจากมีสาขาวิชาค้างอยู่ กรุณาแก้ไข")
			}
		},'json');
		return(false);
	});
	$(".delmajor").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลสาขาวิชาหรือไม่")) return;
		$this = $(this);
		$.post("/edu/faculty/major/del",{ "del":$this.attr("rel"),"major_name" : $this.attr("data-rel")},function(data){
			if(data.result){
				$this.parents("tr.innerlist").fadeOut("fast", function(){
				$this.parents("tr.innerlist").remove();
				});
			}else{
				alert("ไม่สามารถลบได้ เนื่องจาก\n"+
					"- มีบุคลากรสังกัดอยู่\n"+
					"- มีหลักสูตรหรือแผนการศึกษาที่อ้างอิงกับสาขาวิชานี้\n"+
					"- มีนักศึกษาสังกัดอยู่\n"+
					"กรุณาแก้ไขที่หมวดสาขาวิชาก่อนทำการลบครั้งต่อไป กรุุณาาแก้ไข");		
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
			url: "/edu/faculty",  
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
		return false;

	}	
	function chkValue_major(type,o){
		var bOpenchk = false;
		var data = "";
		if(o.value.length >=2){
			if(type === 'major_id' && o.value.length == 2){
				bOpenchk = true;
				$this = $(".status_bar_major")
				data = document.getElementById("major_id").value+o.value;
			}else if((type === 'prefix_name' || type === 'prefix_nameEN')&& o.value.length == 2){
				bOpenchk = true;
				$this = (type === 'prefix_name')? $(".status_bar_prefix_name") : $(".status_bar_prefix_nameEN");
				data = o.value;
			}
			if(bOpenchk){
				$this.html('<img src="../../../common/images/icons/loading.gif" align="absmiddle">&nbsp;Checking availability...');
				$.post("/edu/faculty/major/chk",
					{
						"chktype":type,
						"data":data
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
		}//else{
			//$this.html('&nbsp;<font color="red"> กรอกให้มากกว่า 2 อักษร </font>');
		//	return false;
		//}
	}
</script> 
<!-- CONTENT -->
<div class="container">
  <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการคณะ</div>
  <section>
    <ul style="padding:0;">
      <li class="k-button"><a href="/edu/faculty/form/new"   class="add_new_icon ex1"> เพิ่มคณะที่เกี่ยวข้องใหม่</a></li>
    </ul>
    <table  width="100%" cellpadding="3" class="tblist" id="tblist">
      <thead style="text-decoration:underline; font-weight:bold;" class="k-header">
        <tr>
          <td width="705">ชื่อคณะ</td>
          <td width="70" align="center">Website</td>
          <td width="75" align="center">สถานะ</td>
          <td width="104" align="center">ดำเนินการ</td>
        </tr>
      </thead>
      <tbody>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr class="rowhl" valign="top">
          <td><ul class="treeView">
              <li><span style="display:block;">
                <?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>

                </span> <span style="display:block;">
                <?php echo $_smarty_tpl->tpl_vars['row']->value['fac_nameEN'];?>

                </span>
                <ul>
                  <table width="100%">
                    <thead class="k-header">
                      <tr>
                        <th width="10%">รหัสสาขา</th>
                        <th width="60%">ชื่อสาขาวิชา</th>
                        <th width="10%">คำนำหน้า</th>
                        <th width="10%">website</th>
                        <th width="10%">ดำเนินการ</th>
                      </tr>
                    </thead>
                    <?php  $_smarty_tpl->tpl_vars['_major'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_major']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_major']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_major']->key => $_smarty_tpl->tpl_vars['_major']->value){
$_smarty_tpl->tpl_vars['_major']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['row']->value['fac_id']==$_smarty_tpl->tpl_vars['_major']->value['fac_id']){?>
                    <tr class="innerlist">
                      <td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['_major']->value['major_id'];?>
</td>
                      <td><?php echo $_smarty_tpl->tpl_vars['_major']->value['major_name'];?>
</td>
                      <td><?php echo $_smarty_tpl->tpl_vars['_major']->value['prefix_name'];?>
 / <?php echo $_smarty_tpl->tpl_vars['_major']->value['prefix_nameEN'];?>
</td>
                      <td align="center"><a href="<?php echo $_smarty_tpl->tpl_vars['_major']->value['website'];?>
" target="_blank"> คลิ๊กเพื่อเยี่ยมชม</a></td>
                      <td>
                          <ul class="ulmenu">
                            <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"><a href="/edu/faculty/major/edit?id=<?php echo $_smarty_tpl->tpl_vars['_major']->value['major_id'];?>
&facid=<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_id'];?>
&facname=<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>
"> แก้ไข</a></li>
                            <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"><a href="#" class="delmajor" rel="<?php echo $_smarty_tpl->tpl_vars['_major']->value['major_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['_major']->value['major_name'];?>
"> ลบ</a></li>
                          </ul>
                        </td>
                    </tr>
                    <?php }?>
                    <?php } ?>
                  </table>
                </ul>
              </li>
            </ul></td>
          <td  valign="top" align="center"><a href="<?php echo $_smarty_tpl->tpl_vars['row']->value['website'];?>
" target="_blank">
            คลิ๊กเพื่อเยี่ยมชม
            </a></td>
          <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['status1'];?>
</td>
          <td valign="top" ><ul class="ulmenu">
          		<li><img src="/templates/skin/HTML5 Admin Template/images/icn_new_article.png" style="vertical-align:middle;"> <a href="/edu/faculty/major/new?underfacid=<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_id'];?>
&facname=<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>
">เพิ่มสาขาวิชา</a></li>
              <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/faculty/form/edit?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_id'];?>
">แก้ไขคณะวิชา</a></li>
              <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"> <a href="#" class="rdel" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['fac_name'];?>
">ลบคณะวิชา</a></li>
            </ul></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/faculty" style="text-decoration:underline;">จัดการคณะและสาขาวิชา</a> >
    <?php if (empty($_smarty_tpl->tpl_vars['page']->value['edit'])){?>
    เพิ่มคณะใหม่
    <?php }else{ ?>
    แก้ไขคณะ
    <?php }?>
  </div>
  <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>

    <p id="landing"><?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>

      <br>
      กลับสู่หน้าหลักเพื่อเพิ่มสาขาวิชา <a href="/edu/faculty">คลิ๊กที่นี้</a>
    </p>

  <?php }?>
  <div>
    <form id="addnew" method="post" action="">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:1px solid #000;">
          <thead class="k-header">
            <tr>
              <th colspan="2" scope="col">แบบฟอร์มบันทึก และแก้ไขคณะที่เกี่ยวข้อง</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td width="20%">ชื่อคณะ :</td>
              <td width="80%"><input name="fac_name" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['fac_name'];?>
" size="70" maxlength="255" onKeyUp="return chkValue(this.value),checkThai(this)" style="float:left;" class="k-textbox" required validationMessage="กรอกชื่อคณะ">
                <div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
            </tr>
            <tr>
              <td>Faculty Name :</td>
              <td><input name="fac_nameEN"  value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['fac_nameEN'];?>
" size="70" maxlength="255" onKeyUp="checkEngChar(this)" class="k-textbox" required validationMessage="Faculty Name is required"></td>
            </tr>
            <tr>
              <td>website :</td>
              <td><input name="website" type="text" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['website'];?>
" size="70" maxlength="255" class="k-textbox" required>
                *หากไม่ระบุ กรุณาใส่เครื่องหมาย -</td>
            </tr>
            <tr>
              <td>สถานะ :</td>
              <td><select name="status">
                  <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['edit']['status'])){?>
                  <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['status']==1){?>
                  <option value="1" selected>ใช้งาน</option>
                  <option value="0">ยกเลิกการใช้งาน</option>
                  <option value="2">รอการอนุมัติ</option>
                  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['edit']['status']==2){?>
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
                </select></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>" onClick="return confirm('ยืนยันข้อมูล')"></td>
            </tr>
          </tbody>
        </table>
      </fieldset>
    </form>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="major"){?>
  <div>
  	<div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> &gt; <a href="/edu/faculty" style="text-decoration:underline;">จัดการคณะและสาขาวิชา</a> &gt;<?php if (empty($_smarty_tpl->tpl_vars['row']->value['edit'])){?>เพิ่มสาขาวิชาใหม่<?php }else{ ?>แก่้ไขสาขาวิชา<?php }?></div>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
     <p id="landing"><?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>

      <br>
     หากต้องการเพิ่มรายชื่ออาจารย์ กรุณา <a href="/edu/employee">คลิ๊กที่นี้</a>
    </p>
    <?php }?>
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
            <td>
            <input type="text" name="show_faculty" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['facname'];?>
" class="k-textbox" disabled size="70">
            <input type="hidden" name="fac_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['underfacid'];?>
">
            </td>
          </tr>
          <tr>
            <td>รหัสสาขา :</td>
            <td>
            <div style="float:left;">
            <?php if (empty($_smarty_tpl->tpl_vars['row']->value['edit']['major_id'])){?>
            <input type="text" name="major_id" id="major_id" size="1" class="k-textbox" readonly value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['underfacid'];?>
">
            <input type="text" name="major_id1" id="major_id1" size="4" maxlength="2" onKeyUp="return chkValue_major('major_id',this),checkDex(this)" class="k-textbox" required >
            <?php }else{ ?>
            <input type="text" name="major_id" id="major_id" size="4" class="k-textbox" readonly value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['major_id'];?>
">
            <?php }?>
            </div>
            <div class="status_bar_major" style="float:left; padding:3px;"></div></td>
          </tr>
          <tr>
            <td width="20%">ชื่อสาขาวิชา :</td>
            <td width="80%"><input type="text" name="major_name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['major_name'];?>
" size="70" maxlength="255"  style="float:left;"  class="k-textbox" required onKeyUp="checkThai(this)"><div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
          </tr>
          <tr>
            <td>Major Name :</td>
            <td><input name="major_nameEN" required value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['major_nameEN'];?>
" size="70" maxlength="255" onKeyUp="checkEngChar(this)"  class="k-textbox" ></td>
          </tr>
          <tr>
            <td>ชื่อขึ้นต้นรายวิชา :</td>
            <td><input name="prefix_name" class="k-textbox" size="3" maxlength="2" required style="float:left" onKeyUp="return chkValue_major('prefix_name',this),checkThai(this)" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['prefix_name'];?>
"><div class="status_bar_prefix_name" style="position:relative; float:left; padding:3px;"></div></td>
          </tr>
          <tr>
            <td>Prefix course name :</td>
            <td><input name="prefix_nameEN" class="k-textbox" size="3" maxlength="2" required style="float:left;" onKeyUp="return chkValue_major('prefix_nameEN',this),checkEngChar(this)" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['edit']['prefix_nameEN'];?>
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
                <?php if ($_smarty_tpl->tpl_vars['row']->value['edit']['status']==1){?>
                <option value="1" selected>ใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['row']->value['edit']['status']==2){?>
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
          	<td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>"onClick="return confirm('ยืนยันการเพิ่มสาขาวิชา')"/></td>
          </tr>
          </tbody>
        </table>
        </fieldset>
      </form>
  </div>
  </div>  
  <?php }?>
    <div class="clear-all"></div>
  </div>
</div>
</body>
</html><?php }} ?>