<?php /* Smarty version Smarty-3.1.7, created on 2012-06-17 16:20:08
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\building_room.html" */ ?>
<?php /*%%SmartyHeaderCode:195714f11858e8b0185-34336338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b06a9e1b15308f82f77b8f7c6f6e23c840e33bb' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\building_room.html',
      1 => 1339924801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195714f11858e8b0185-34336338',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f11858ea00a6',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'res' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f11858ea00a6')) {function content_4f11858ea00a6($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>

ul.token-input-list-facebook{
	width:455px;
}
:disabled{
	background:#CCCCCC;
}
</style>
<script>
$(function(){
	
	$(".rdel").click(function(){
		if(!confirm("คุณต้องการลบข้อมูลระดับการศึกษาหรือไม่")) return;
		$this = $(this);
		$this.addClass("loading");
		$.post("/edu/building_room",{ "del":$this.attr("rel"),"room_name":$this.attr("data-rel")},function(res){
			if(res.result){
					$this.parents("tr").fadeOut("fast", function(){
						$this.parents("tr").remove();
					});
					$this.removeClass("loading");
			}else{
				alert("ไม่สามารถลบได้ เพราะมีการลงตารางเรียนในห้องดังกล่าว กรุณาถอนตารางเรียนออกก่อนดำเนินการ");
				$this.removeClass("loading");
			}
		},'json');
		return(false);
	});
});
	
	function chkValue(elm){
		var filter = /^[ก-ฮ0-9]*$/;
				$("#status_bar").html('<img src="../../../common/images/icons/loading.gif" align="absmiddle">&nbsp;Checking availability...');
			 	$.ajax({  
    			type: "POST",  
				url: "/edu/building_room/form/chk",  
				data: "chkAvaliable="+ elm.value,  
				success: 
				function(msg){
			 		$("#status_bar").ajaxComplete(function(event, request, settings){ 
						if(msg){ 
							$(this).html('&nbsp;<img src="../../../common/images/icons/accepted.png" align="absmiddle"> <font color="Green"> Available </font>');
							return true;
						}else{  
							$(this).html('&nbsp;<font color="RED"> ไม่ว่าง </font>');
							return false;
						}   
					});
				}
			});
		}
		
		function getFloor(o){
			$.post("/service/callbackJson?module=building_no_token",
			{
				"q":o.value
			},function(res){
					$("select#floor").html("<option selected disabled>กรุณาเลือก</option>")
				for(var i=1;i<=res[0].total_floor;i++){
					$("select#floor").append("<option value='"+i+"'>"+i+"</option>")
				}
			},'json')
		}
</script> 
<!-- CONTENT -->
<div class="container">


   
    <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
     <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการห้องเรียน</div>
    <section>
      <ul style="padding:0;">
        <li class="k-button"><a href="/edu/building_room/form/new" class="add_new_icon ex1">เพิ่มห้องเรียนใหม่</a></li>
      </ul>
      <table  width="100%" cellpadding="3" id="tblist">
        <thead class="k-header">
          <tr>
            <th >ชื่อห้อง</th>
            <th >อาคาร</th>
            <th >ชั้น</th>
            <th >ประเภทห้อง</th>
            <th >ความจุ</th>
            <th >พื้นที่ใช้สอย</th>
            <th >สถานะ</th>
            <th >ดำเนินการ</th>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top">
            <td style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['room_name'];?>
</td>
            <td style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['building_name'];?>
</td>
            <td width="35" align="center" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['floor'];?>
</td>
            <td align="center"  valign="top" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['room_type'];?>
</td>
            <td align="center"  valign="top" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['capacity'];?>

              คน</td>
            <td align="center"  valign="top" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['area'];?>

              ตร.ม.</td>
            <td align="center" style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['status1'];?>
</td>
            <td align="center" valign="top" style="text-align: left"><div class="tool">
                <ul style="list-style:none;padding:0;margin:0;">
                  <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/building_room/form/edit?id=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
&bid=<?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
" >แก้ไขรายการ</a></li>
                  <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"> <a href="#" class="rdel" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['room_name'];?>
">ลบรายการ</a></li>
                  <li><img src="../../../common/images/icons/room_schedule.png" style="vertical-align:middle;"> <a href="/edu/building_room/time?roomid=<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
&roomname=<?php echo $_smarty_tpl->tpl_vars['row']->value['room_name'];?>
&bid=<?php echo $_smarty_tpl->tpl_vars['row']->value['building_id'];?>
&bname=<?php echo $_smarty_tpl->tpl_vars['row']->value['building_name'];?>
">เพิ่มตารางเวลา</a></li>
                </ul>
              </div></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
     <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/building_room" style="text-decoration:underline;">จัดการห้องเรียน</a> > <?php if (empty($_smarty_tpl->tpl_vars['page']->value['edit'])){?>เพิ่มห้องเรียนใหม่<?php }else{ ?>แก้ไขห้องเรียน<?php }?></div>
      <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
      <p id="landing">
        <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>
        หากต้องการกำหนดระดับปริญญา กรุณา <a href="/edu/level">คลิ๊กที่นี้</a>
      </p>

     

    <?php }?>
    <div>
      <form id="addnew" method="post" action="">
        <fieldset>
          <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:#000 1px solid;">
            <thead class="k-header">
              <tr>
                <th colspan="2" scope="col">แบบฟอร์มบันทึก และแก้ไขห้องเรียน</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td width="20%">ชื่อห้อง :</td>
                <td width="80%"><input name="room_name" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['room_name'];?>
" size="60" maxlength="255" required class="k-textbox" style="float:left;" onKeyUp="return chkValue(this)"><div style="float:left;padding:3px;" id="status_bar"></div></td>
              </tr>
              <tr >
                <td>อาคาร :</td>
                <td><?php if (empty($_smarty_tpl->tpl_vars['page']->value['edit']['building_id'])){?>
                  <select name="building_id" onChange="getFloor(this)">
                    <option value="" disabled selected>กรุณาเลือก</option>
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_building']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['building_id'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['building_name'];?>

                    </option>
                    <?php } ?>
                  </select>
                  <?php }else{ ?>
                  <input name="building_name" class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['building_name'];?>
" size="70" maxlength="255" disabled>
                  <?php }?></td>
              </tr>
              <tr>
                <td>ชั้น :</td>
                <td><?php if (empty($_smarty_tpl->tpl_vars['page']->value['edit']['floor'])){?><select name="floor" id="floor"></select>
                <?php }else{ ?>
                <input name="floor" class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['floor'];?>
" size="2" disabled>
                <?php }?>
                </td>
              </tr>
              <tr >
                <td>ประเภทห้อง :</td>
                <td><label>
                    <input type="radio" name="room_type" value="LEC" class="room_type" <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['room_type']=='LEC'){?> checked <?php }?>>
                    Lecture</label>
                  <label>
                    <input type="radio" name="room_type" value="LAB" class="room_type" <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['room_type']=='LAB'){?> checked <?php }?>>
                    Laboratory</label></td>
              </tr>
              <tr>
                <td>ความจุ :</td>
                <td><input name="capacity" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['capacity'];?>
" size="3" maxlength="3" required class="k-textbox" onKeyUp="checkDex(this)">
                  คน</td>
              </tr>
              <tr >
                <td>พื้นที่ใช้สอย :</td>
                <td><input name="area" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['area'];?>
" size="3" maxlength="3" required class="k-textbox" onKeyUp="checkDex(this)">
                  ตร.ม.</td>
              </tr>
              <tr valign="top">
                <td>อุปกรณ์ในห้อง :</td>
                <td>
                <fieldset style="width:50%;">
               	  <legend>
                    อุปกรณ์พื้นฐาน
                    </legend>
                   <table width="100%" border="0" cellspacing="0" cellpadding="5">
 
  <tr>
    <td colspan="4" class="k-header">อุปกรณ์ห้อง Lecture</td>
    </tr>
   <tbody id="LEC_REMARK" style="display:none;">
  <tr>
    <td width="30%"><input type="checkbox" name="remark[lec][comp]" value="1" <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lec']['comp']){?> checked <?php }?> disabled>คอมพิวเตอร์</td>
    <td width="27%"><input type="checkbox" name="remark[lec][proj]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lec']['proj']){?> checked <?php }?>>Projector</td>
    <td width="19%" disabled><input type="checkbox" name="remark[lec][scr]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lec']['scr']){?> checked <?php }?>>จอภาพ</td>
    <td width="24%" ><input type="checkbox" name="remark[lec][table]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lec']['table']){?> checked <?php }?>>โต๊ะเรียน</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="remark[lec][board]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lec']['board']){?> checked <?php }?>>กระดาน</td>
    <td><input type="checkbox" name="remark[lec][wpen]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lec']['wpen']){?> checked <?php }?>>ปากกา Whiteboard</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr valign="top">
    <td ><input type="checkbox" id="openOtherLec" disabled <?php if (isset($_smarty_tpl->tpl_vars['page']->value['edit']['remark_text']['lec'])){?> checked<?php }?> >อุปกรณ์เพิ่มเติม</td>
     <td colspan="3"><textarea name="remark_text_lec" rows="2" class="k-textbox" <?php if (!isset($_smarty_tpl->tpl_vars['page']->value['edit']['remark_text']['lec'])){?>disabled<?php }?> id="remark_LEC"><?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['remark_text']['lec'];?>
</textarea>
       <br>
       - หากมีมากกว่า 1 รายการ กรุณาคั่นด้วย , เท่านั้น<br>
       - หากไม่ระบุ กรุณาปล่อยว่าง</td>
  </tr>
  </tbody>
  
  <tr>
    <td colspan="4" class="k-header">อุปกรณ์ห้อง Lab</td>
    </tr>
    <tbody id="LAB_REMARK" style="display:none;">
  <tr>
    <td><input type="checkbox" name="remark[lab][bchem]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lab']['bchem']){?> checked <?php }?>>
      ตู้เก็บสารเคมี</td>
    <td><input type="checkbox" name="remark[lab][lav]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lab']['lav']){?> checked <?php }?>>
      อ่างล้างมือ</td>
    <td><input type="checkbox" name="remark[lab][regf]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lab']['regf']){?> checked <?php }?>>
      ตู้แช่</td>
    <td><input type="checkbox" name="remark[lab][oven]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lab']['oven']){?> checked <?php }?>>
      ตู้อบ</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="remark[lab][comp]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lab']['comp']){?> checked <?php }?>>
      คอมพิวเตอร์</td>
    <td><input type="checkbox" name="remark[lab][proj]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lab']['proj']){?> checked <?php }?>>
      Projector</td>
    <td><input type="checkbox" name="remark[lab][scr]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lab']['scr']){?> checked <?php }?>>
      จอภาพ</td>
    <td><input type="checkbox" name="remark[lab][tab]" value="1" disabled <?php if ($_smarty_tpl->tpl_vars['page']->value['edit']['remark']['lab']['tab']){?> checked <?php }?>>
      โต๊ะเรียน</td>
  </tr>
  <tr valign="top">
    <td><input type="checkbox" id="openOtherLab" disabled <?php if (isset($_smarty_tpl->tpl_vars['page']->value['edit']['remark_text']['lab'])){?> checked<?php }?>>อุปกรณ์เพิ่มเติม</td>
    <td colspan="3"><textarea name="remark_text_lab" rows="2" class="k-textbox" <?php if (!isset($_smarty_tpl->tpl_vars['page']->value['edit']['remark_text']['lab'])){?>disabled<?php }?> id="reamark_LAB"><?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['remark_text']['lab'];?>
</textarea>
      <br>
      - หากมีมากกว่า 1 รายการ กรุณาคั่นด้วย , เท่านั้น<br>
- หากไม่ระบุ กรุณาปล่อยว่าง</td>
  </tr>
  </tbody>
</table>

                    
                </fieldset>
                                
               <!-- <textarea name="remark" cols="70" rows="5"><?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['remark'];?>

</textarea>--></td>
              </tr>
              <tr >
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
                    <option value="1" selected>เปิดใช้งาน</option>
                    <option value="0">ยกเลิกการใช้งาน</option>
                    <option value="2">รอการอนุมัติ</option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>"  onClick="return confirm('ยืนยันข้อมูล')">
                  <input type="reset" value="Clear" ></td>
              </tr>
            </tbody>
          </table>
        </fieldset>
      </form>
    </div>
    <script>
    $(function(){
		
		$("#openOtherLab").click(function(){
			var $textLab = $("textarea#reamark_LAB")
			if($textLab.is(":disabled")){
				$textLab.removeAttr("disabled");
			}else{
				$textLab.attr("disabled","disabled");
			}
		});
		$("#openOtherLec").click(function(){
			var $textLab = $("textarea#remark_LEC")
			if($textLab.is(":disabled")){
				$textLab.removeAttr("disabled");
			}else{
				$textLab.attr("disabled","disabled");
			}
		});
		var room_type = '<?php echo $_smarty_tpl->tpl_vars['page']->value['edit']['room_type'];?>
';
		if(room_type !=''){
		if(room_type ==="LAB"){
				$("tbody#LEC_REMARK").slideUp(function(){
					$("tbody#LEC_REMARK > tr > td >input").each(function(index, element) {
                        $(this).attr("disabled","disabled");
                    });
				})
				$("tbody#LAB_REMARK").slideDown(function(){
					$("tbody#LAB_REMARK > tr > td >input").each(function(index, element) {
                        $(this).removeAttr("disabled");
                    });
				})
			}else{
				$("tbody#LEC_REMARK").slideDown(function(){
					$("tbody#LEC_REMARK > tr > td >input").each(function(index, element) {
						$(this).removeAttr("disabled");
                    });
				})
				$("tbody#LAB_REMARK").slideUp(function(){
					$("tbody#LAB_REMARK > tr > td >input").each(function(index, element) {
                          $(this).attr("disabled","disabled");
                    });
				})
			}
		}
			
		$(".room_type").click(function(){
			var isSelect = $(this).val();
			
			if(isSelect === "LAB" || room_type ==="LAB"){
				$("tbody#LEC_REMARK").slideUp(function(){
					$("tbody#LEC_REMARK > tr > td >input").each(function(index, element) {
                        $(this).attr("disabled","disabled");
                    });
				})
				$("tbody#LAB_REMARK").slideDown(function(){
					$("tbody#LAB_REMARK > tr > td >input").each(function(index, element) {
                        $(this).removeAttr("disabled");
                    });
				})
			}else{
				$("tbody#LEC_REMARK").slideDown(function(){
					$("tbody#LEC_REMARK > tr > td >input").each(function(index, element) {
						$(this).removeAttr("disabled");
                    });
				})
				$("tbody#LAB_REMARK").slideUp(function(){
					$("tbody#LAB_REMARK > tr > td >input").each(function(index, element) {
                          $(this).attr("disabled","disabled");
                    });
				})
			}
		});
	});
    </script>
    <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="time"){?>
    <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/building_room" style="text-decoration:underline;">จัดการห้องเรียน</a> > จัดตารางห้องเรียน</div>
    <div>
      <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:#000000 solid 1px;">
        <thead class="k-header">
          <tr>
            <th colspan="2">กำหนดตารางเรียนของห้อง
              <?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['roomname'];?>

              อาคาร
              <?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['bname'];?>
</th>
          </tr>
        </thead>
        <tr>
          <td width="15%">กำหนดภาคการศึกษา</td>
          <td><select id="use_term" onChange="chkAvalTerm(this.value,'chk')">
            <option selected disabled>กรุณาเลือก</option>
            <option value="1">ภาคเรียนที่ 1</option>
            <option value="2">ภาคเรียนที่ 2</option>
            <option value="3">ภาคเรียนที่ 3</option>    
          </select></td>
        </tr>
        <tr>
          <td>เลือกวิชา :</td>
          <td><select id="course" onChange="chkAvalTerm(this.value,'getdeg')">
          </select></td>
        </tr>
        <tr>
          <td>ประเภทปริญญา :</td>
          <td><select id="deg" onChange="chkAvalTerm(this.value,'getsection')">
          </select></td>
        </tr>
        <tr>
          <td>กลุ่มเรียน :</td>
          <td><select name="course_section" id="course_section" onChange="chkAvalTerm(this.value,'getlearn')">
          </select></td>
        </tr>
        <tr>
          <td>ประเภทการเรียน :</td>
          <td><select id="learn_type" onChange="chkAvalTerm(this.value,'showtable')">
          </select></td>
        </tr>
       
        <tr>
          <td colspan="2">
          <div id="landingtable"></div>
          </td>
        </tr>
      </table>
    </div>
    <script>
	var courseid = '';
	var semester =  0;
	var bid = '<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['bid'];?>
'
	var roomid = '<?php echo $_smarty_tpl->tpl_vars['page']->value['_get']['roomid'];?>
'
	var sectionid = 0;
	var section = 0;
	function chkAvalTerm(value,method){
		if(method === "chk"){	// เลือกภาคการศึกษา เพื่อแสดงวิชา
			semester = value
			$.post("/edu/building_room/time/getcourse",{ "value":value},
			function(res){
				$("select#course").html("<option selected disable>กรุณาเลือก</option>");
				$("select#deg").html("");
				$("select#course_section").html("");
				$("select#learn_type").html("");
				for(x in res){
					$("select#course").append("<option value="+res[x].course_id+">"+res[x].course_id+" "+res[x].course_name+"</option>");
				}
			},'json');
			
		}else if(method==="getdeg"){	//เลือกวิชา เพื่อแสดงประเภทปริญญาในแต่ละวิชา
			courseid = value
			$.post("/edu/building_room/time/getdeg",{ "courseid" : courseid},
			function(res){
				$("select#deg").html("<option selected disable>กรุณาเลือก</option>");
				$("select#course_section").html("");
				$("select#learn_type").html("");
				if(res!=null){
					for(x in res){
						$("select#deg").append("<option value="+res[x].deg_id+">"+res[x].deg+"</option>");
					}
				}else{
					if(confirm("คุณยังไม่สร้างกลุ่มเรียน ต้องการสร้างกลุ่มเรียนหรือไม่")) window.location = "/edu/course";
					$("select#deg").html("");

				}
			},'json');
		}else if(method=="getsection"){	//เลือกประเภทปริญญา เพื่อแสดงกลุ่มเรียน
			$.post("/edu/building_room/time/getsection",
			{
				"courseid":courseid,
				"deg":value
			},function(res){
				
				$("select#course_section").html("<option selected disable>กรุณาเลือก</option>");
				$("select#learn_type").html("");
				for(x in res){
					$("select#course_section").append("<option value="+res[x].course_section_id+">"+res[x].section+"</option>");
				}
			},'json');	
		}else if(method==="getlearn"){	//เลือกกลุ่มเรียน เพื่อแสดงประเภทเรียน
			sectionid = value
			$.post("/edu/building_room/time/getlearn",{	"sectionid":value},
			function(res){
				$("select#learn_type").html("<option selected disable>กรุณาเลือก</option>");
				for(x in res){
					$("select#learn_type").append("<option value="+res[x]+">"+res[x]+"</option>");
				}
			},'json');
		}else if(method === "showtable"){	// เลือกกลุ่มเรียน เพื่อแสดงตารางของห้องเรีียน
			$.post("/edu/building_room/time/calltable",
			{
				"sectionid":sectionid,
				"learn_type":value,
				"roomid":roomid,
				"semester":semester
			},function(res){
				$("div#landingtable").html(res);
			})
		}
	}
	</script>
  <?php }?>
    <div class="clear-all"></div>

</div>
</body>
</html><?php }} ?>