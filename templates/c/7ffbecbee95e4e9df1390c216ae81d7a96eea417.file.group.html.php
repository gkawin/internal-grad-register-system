<?php /* Smarty version Smarty-3.1.7, created on 2012-06-15 13:28:56
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\group.html" */ ?>
<?php /*%%SmartyHeaderCode:229744f2432fa9f9779-83604700%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ffbecbee95e4e9df1390c216ae81d7a96eea417' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\group.html',
      1 => 1339759734,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '229744f2432fa9f9779-83604700',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f2432fac65ba',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f2432fac65ba')) {function content_4f2432fac65ba($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
 
<script>
$(function(){
 

	$(".demo div[title]").tooltip( {  
	opacity: 0.8,position : 'bottom right'});
	
	$(".demo div").click(function(){
		$this = $(this);
		var nowClass = $this.attr("class");
		var updateid = $this.attr('data-id');
		var target = $this.attr('id');
		var bChangedata = $this.attr('data-rel');
		if(!confirm("คุณต้องการแก้ไขข้อมูลหรือไม่่")) return;
			if(bChangedata==1)
					bChangedata = 0;
				else
					bChangedata = 1;
			$.post("/edu/group",
			{ 
				"changeData":true,
				"data":bChangedata,
				"updateid":updateid,
				"target":target
			},
			function(res){
				$this.attr('data-rel',bChangedata);
				if($this.attr('data-rel')!=1){
					$this.removeClass("be-able").fadeOut('slow',function(){
						$this.fadeIn('slow').addClass("unable");
					});
				}else{
					$this.removeClass("unable").fadeOut('slow',function(){
						$this.fadeIn('slow').addClass("be-able");
					});
				}

			},'json');
	});
	
		
	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลระดับการศึกษาหรือไม่")) return;
		$this = $(this);
		$this.addClass("loading");
		$.post("/edu/group",{ "del":$this.attr("data-rel")},function(data){
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
});
</script>
<style>
section.group-content{
 	width:100%; 
	margin-top:15pt;
	background-color:#FFFFFF;
}
li{
	list-style:none;
}
li.icon-group {
	list-style-image:url(/templates/skin/default/images/icon/group_icon.png);
	float:left;
}

.tooltip { /*plugin jquery tooltips*/
	display:none;
	background: #666;
	-moz-border-radius:10px 10px 10px;
	border-radius:10px 10px 10px;
	-webkit-border-radius:10px 10px 10px;
	border:#000000 solid 5px;
	font-size:12px;
	padding:5px;
	color:#fff;	
}
thead.k-group th{
	border-right:#000000 1px solid;
	padding-bottom:10pt;
	padding-top:10pt;
}
tbody.demo td{
	border-right:#000000 1px solid;
	border-bottom:#000000 1px solid;
	padding-bottom:10pt;
	padding-top:10pt;
}
tbody tr:last-child{
	border-bottom:none;
	
}
.be-able{
	background:url(../../../common/images/icons/accepted.png) no-repeat center;
	height:20px;
	width:20px;
	cursor:pointer !important;
	
}
.unable{
	background:url(../../../common/images/icons/block.gif) no-repeat center;
	height:16px;
	width:16px;
	cursor:pointer !important;
	
}

ul.group-permit li{
	border-bottom:#000000 1px solid;
	padding-bottom:10px;
	padding-top:10px;
}
</style>
<script>
$(document).ready(function(){
	 var window = $("#addgroup").kendoWindow({
        title: "แก้ไขกลุ่ม",
        visible: false,
    }).data("kendoWindow");
$("#new_group").click(function(){
    var window = $("#addgroup").data("kendoWindow");
    window.center();
    window.open();
});
$("input[name=employee_member]").tokenInput("/service/callbackJson?module=emp", {
                theme: "facebook",preventDuplicates: true,propertyToSearch: "name",});
				
	$("#savegroup").click(function(e){	
	if(!confirm("ยืนยันการเพิ่มข้อมูล")) return;
		var bindata = $("form#newgroup").serialize();
		$.post("/edu/group",bindata,
		function(res){
			if(res)
				$("#result").fadeIn("slow").html("ทำรายการสำเร็จ<br>หากต้องการกำหนดอาคารเรียน กรุณา<a href='/edu/building'>คลิ๊กที่นี้</a>");
		});
	});
});
</script> 
<!-- CONTENT -->

<div class="container">
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> >จัดการกลุ่มบุคลากร</div>
  <div>
    <section class="group-content">
      <header>
        <ul>
          <li class="icon-group">
            <h2>รายชื่อกลุ่ม</h2>
          </li>
          <li style="float:right; margin-right:10pt;">
            <h4><a href="#" id="new_group" class="k-button" >+ สร้างกลุ่มอาจารย์ใหม่</a></h4>
          </li>
        </ul>
        <div class="clear-all"></div>
      </header>
      <article><a id="gt"></a>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="grid_tbl" >
          <thead class="k-group">
          <th width="60%" scope="col">ชื่อกลุ่ม</th>
            <th width="10%" scope="col">การสอน</th>
            <th width="10%" scope="col">ที่ปรึกษา</th>
            <th width="10%" scope="col">สำนักงาน</th>
            <th width="10%" scope="col">สถานะกลุ่ม</th>
              </thead>
          <tbody class="demo">
            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
            <tr>
              <td>
              <!--	<a href="#" id="group_edit" class="i-icon ico-edit redit" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_id'];?>
" ></a>-->
                <img src="../../../common/images/icons/delete.png" class="rdel" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_id'];?>
" style="vertical-align:baseline; cursor:pointer;">
                <?php echo $_smarty_tpl->tpl_vars['row']->value['group_name'];?>

               
              </td>
              <td align="center"  ><div class="<?php if ($_smarty_tpl->tpl_vars['row']->value['teachable']==1){?>be-able<?php }else{ ?>unable<?php }?>" title="คลิ๊กเพื่อเปลี่ยนสถานะของกลุ่มว่าทำการเรียนการสอนได้หรือไม่" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['teachable'];?>
" id="teachable"></div></td>
              <td align="center" class="demo"><div class="<?php if ($_smarty_tpl->tpl_vars['row']->value['advisor']==1){?>be-able<?php }else{ ?>unable<?php }?>" title="คลิ๊กเพื่อเปลี่ยนสถานะของกลุ่มว่าเป็นที่ปรึกษาแก่นักศึกษาได้หรือไม่" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['advisor'];?>
" id="advisor"></div></td>
              <td align="center" class="demo"><div class="<?php if ($_smarty_tpl->tpl_vars['row']->value['graduate_officer']==1){?>be-able<?php }else{ ?>unable<?php }?>" title="คลิ๊กเพื่อเปลี่ยนสถานะของกลุ่มว่าเป็นพนักงานในสำนักงานได้หรือไม่" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['graduate_officer'];?>
" id="graduate_officer"></div></td>
              <td align="center" class="demo"><div class="<?php if ($_smarty_tpl->tpl_vars['row']->value['status']==1){?>be-able<?php }else{ ?>unable<?php }?>" title="คลิ๊กเพื่อเปลี่ยนสถานะของกลุ่มว่าจะใช้งานหรือไม่" data-id="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['status'];?>
" id="status"></div></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </article>
      <div id="addgroup" style="padding: 5px; ">
       <div id="result" style="display:none; background:#00FF33; padding:10px;" align="center"></div>
        <form  method="post" id="newgroup">
          <fieldset>
            <table width="96%" border="0" cellspacing="0" cellpadding="5" align="center">
              <thead>
                <tr>
                  <th colspan="2" scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>ชื่อกลุ่ม :</td>
                  <td><input name="group_name" type="text"  size="50" maxlength="255" class="k-textbox"></td>
                </tr>
                <tr>
                  <td width="27%" valign="top">สมาชิกกลุ่ม :</td>
                  <td width="73%"><input name="employee_member"  size="50" maxlength="255"  style="float:left;"></td>
                </tr>
                <tr>
                  <td valign="top" style="padding-top:2.1em;">สิทธิ์ของกลุ่ม :</td>
                  <td valign="top"><ul class="group-permit" style="padding:0;">
                      <li>
                        <input name="teachable" type="checkbox" >
                        <label><strong>ทำการเรียนการสอนได้</strong></label>
                        <br>
                        <label style="color:#999999;">Description here</label>
                      </li>
                      <li>
                        <input name="advisor" type="checkbox">
                        <label><strong>ที่ปรึกษานักศึกษา</strong></label>
                        <br>
                        <label style="color:#999999;">Description here</label>
                      </li>
                      <li>
                        <input name="graduate_officer" type="checkbox" >
                        <label><strong>บุคลากรในสำนักงาน</strong></label>
                        <br>
                        <label style="color:#999999;">Description here</label>
                      </li>
                    </ul></td>
                </tr>
                <tr>
                  <td>สถานะ :</td>
                  <td><select name="status">
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
                    </select></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><input type="hidden" name="savegroup" value="true"><input type="button"  id="savegroup" value="เพิ่มข้อมูล" class="k-button" >
                    <input type="reset" value="Clear" class="k-button"/></td>
                </tr>
              </tbody>
            </table>
          </fieldset>
        </form>
       
      </div>
    </section>
  </div>
</div>
</body>
</html><?php }} ?>