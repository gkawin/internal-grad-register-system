<?php /* Smarty version Smarty-3.1.7, created on 2012-06-23 16:22:46
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\log_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:238214fd252b2da0862-82421489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7359941bf1c4663ccca18346c095b5cbfa7d27eb' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\\log_admin.html',
      1 => 1340394486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '238214fd252b2da0862-82421489',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fd252b2dcdbc',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fd252b2dcdbc')) {function content_4fd252b2dcdbc($_smarty_tpl) {?><script>
var part = '<?php echo $_smarty_tpl->tpl_vars['page']->value['segment'];?>
';
function ShowKendoWindow(log_id,title) {
   var title = title;
        var url = (part==="log") ? "/system/log/details?id="+log_id : "/system/userlog/details?id="+log_id;
        var win = $(".modal-window");
        if (!win.data("kendoWindow")) {
            // window not yet initialized
            win.kendoWindow({
                animation: {
                    open: {
                        effects: { fadeIn: {} },
                        duration: 200,
                        show: true
                    },
                    close: {
                        effects: { fadeOut: {} },
                        duration: 200,
                        hide: true
                    }
                },
				width: 400,
                content: url,
                title: title,
                draggable: true,
                refresh: function() { this.center();}
            }).data("kendoWindow").center().open();
            //event.preventDefault();
        }
        else {
            // reopening window
            win.data("kendoWindow")
            .refresh(url) // request the URL via AJAX
            .title(title)          
            .center().open() // open the window;
        }
}
function getselect(){
	var cb = new Array();
	$(".cb:checked").each(function(){
		cb.push(this.value);
	});
	return cb;
}
$(function(){
	$("#cball").click(function(){
		$(".cb").attr("checked", this.checked);
	});
	$(".ldel").click(function(event){
		if(!confirm("คุณแน่ใจที่จะลบข้อมูลการเปลี่ยนแปลงระบบ?")) return;
			$this = $(this);
			var cb = getselect();
			
			if(part==="log"){
				if(cb.length){
					$this.addClass("loading");
					$.post("/system/log/del",{ "part":part,"del":cb.join(",")},function(data){
						window.location.reload();
					},"json");
				}else{
					alert("กรุณาเลือกรายการอย่างน้อย 1 รายการ");
				}
			}else if(part==="userlog"){
				if(cb.length){
					$this.addClass("loading");
					$.post("/system/userlog/del",{ "part":part,"del":cb.join(",")},function(data){
						window.location.reload();
					},"json");
				}else{
					alert("กรุณาเลือกรายการอย่างน้อย 1 รายการ");
				}
			}
		event.preventDefault()
	});
	
	$("img").css("vertical-align","middle")
	$(".del_syslog").click(function(){
	if(!confirm("คุณแน่ใจที่จะลบข้อมูลการเปลี่ยนแปลงระบบ?")) return;
		$this = $(this);
		$this.addClass("loading");
		$.post("/system/log/del",{ "log_id":$this.attr("rel")},
		function(res){
			if(res.result){
				$this.parents("tr").fadeOut("slow").remove();

			}else{
				alert("ทำรายการไม่สำเร็จ")
			}
		},'json');
	});
})


</script>
<?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="log"){?>

<article class="module width_full">
  <header>
    <h3>รายการข้อมูลการเปลี่ยนแปลงของระบบ</h3>
  </header>
  <div class="module_content">
    <table id="tblistLog" border="0" width="100%" cellpadding="5">
      <thead class="k-header" align="center">
        <tr>
          <td width="2%"><input type="checkbox" name="cball" id="cball" /></td>
          <td width="10%">วันที่</td>
          <td width="10%">เวลา</td>
          <td width="10%">กระทำ</td>
          <td width="14%">ผู้กระทำ</td>
          <td width="8%">ผลการดำเนินการ</td>
          <td width="8%">ดำเนินการ</td>
        </tr>
      </thead>
      <tbody>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>
          <td align="center"><input type="checkbox" name="cb[]" id="cb[]" class="cb" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['log_id'];?>
"/></td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['day'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['time'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['action'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['whoaction'];?>
</td>
          <td align="center">
          <?php if ($_smarty_tpl->tpl_vars['item']->value['result']=="OK"){?>
          <b style="color:green"><?php echo $_smarty_tpl->tpl_vars['item']->value['result'];?>
</b>
          <?php }else{ ?>
          <b style="color:red"><?php echo $_smarty_tpl->tpl_vars['item']->value['result'];?>
</b>
          <?php }?>
          </td>
          <td ><img src="/templates/skin/HTML5 Admin Template/images/icn_trash.png" class="ico_del del_syslog" data-rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['log_id'];?>
" style="cursor:pointer;" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['log_id'];?>
"> <a href="#del" class="del_syslog" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['log_id'];?>
">ลบข้อมูล</a><br>
            <img src="/templates/skin/HTML5 Admin Template/images/icn_categories.png" title="ดูรายละเอียด" class="ico_del"  style="cursor:pointer;" onClick="ShowKendoWindow(<?php echo $_smarty_tpl->tpl_vars['item']->value['log_id'];?>
,'<?php echo $_smarty_tpl->tpl_vars['item']->value['day'];?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['time'];?>
')"> <a href="#openDetail" class="openDetail" onClick="ShowKendoWindow(<?php echo $_smarty_tpl->tpl_vars['item']->value['log_id'];?>
,'<?php echo $_smarty_tpl->tpl_vars['item']->value['day'];?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['time'];?>
')">ดูรายละเอียด</a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="clear"></div>
    <p >ทำกับที่เลือก : <a href="#ldel" class="ldel">โยนทิ้ง</a> </p>
  </div>
</article>

<?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="userlog"){?>
<article class="module width_full">
  <header>
    <h3>รายการข้อมูลการเปลี่ยนแปลงของบัญชีผู้ใช้</h3>
  </header>
  <div class="module_content">
    <table id="tblistLog" border="0" width="100%" cellpadding="5">
      <thead class="k-header" align="center">
        <tr>
          <td width="2%"><input type="checkbox" name="cball" id="cball" /></td>
          <td width="6%">บัญชี</td>
          <td width="10%">เข้าระบบล่าสุด</td>
          <td width="12%">ฝ่าย</td>
          <td width="12%">เจ้าของบัญชี</td>
          <td width="6%">IP Address</td>
          <td width="6%">โมดูลล่าสุด</td>
          <td width="4%">ดำเนินการ</td>
        </tr>
      </thead>
      <tbody>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_acclog']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <tr>
          <td align="center"><input type="checkbox" name="cb[]" id="cb[]" class="cb" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"/></td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['username'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['last_login'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['sec_work'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['EMP_NAME'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['ip'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['item']->value['last_module'];?>
</td>
          <td align="center"><img src="/templates/skin/HTML5 Admin Template/images/icn_trash.png" class="ico_del" data-rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" style="cursor:pointer;"></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="clear"></div>
    <p >ทำกับที่เลือก : <a href="#ldel" class="ldel">โยนทิ้ง</a> </p>
  </div>
</article>
<?php }?>
<div class="modal-window"></div><?php }} ?>