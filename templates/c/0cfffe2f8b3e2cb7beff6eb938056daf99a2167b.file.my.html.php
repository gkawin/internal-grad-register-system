<?php /* Smarty version Smarty-3.1.7, created on 2012-07-06 00:44:46
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\my.html" */ ?>
<?php /*%%SmartyHeaderCode:258814f38d0f2449233-73857032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cfffe2f8b3e2cb7beff6eb938056daf99a2167b' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\my.html',
      1 => 1341510284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258814f38d0f2449233-73857032',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f38d0f247ec0',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f38d0f247ec0')) {function content_4f38d0f247ec0($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
	ul{ list-style:none;}
	 #operation-profile ul{ padding-left:0;list-style:none;}
	 #operation-profile li { padding-top:5px;}
	 #operation-profile a { color:#00F;}
	 #labelF {  width:1000px; font-weight:bold;text-decoration:underline;}
	 li.infomation_Emp { padding:5pt;}
	 .group-icon { padding-left:18px;padding-bottom:18px; background:url(/templates/skin/default/images/icon/edit_ico.png) no-repeat}
.group-icon:hover { padding-left:18px;padding-bottom:18px; background:url(/templates/skin/default/images/icon/edit_hover.png) no-repeat;}

.is0{ background:url(../../../common/images/progressImg1.png) no-repeat 0 0;width:138px;height:7px;}
.is10{ background-position:0 -7px; }
.is20{ background-position:0 -14px;}
.is30{ background-position:0 -21px;}
.is40{ background-position:0 -28px;}
.is50{ background-position:0 -35px;}
.is60{ background-position:0 -42px;}
.is70{ background-position:0 -49px;}
.is80{ background-position:0 -56px;}
.is90{ background-position:0 -63px;}
.is100{ background-position:0 -70px;}
</style>
<div class="container">
<?php if ($_smarty_tpl->tpl_vars['page']->value['view']==''){?>
<div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > ข้อมูลส่วนตัว</div>
<?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="changepassword"){?>
<div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/my" style="text-decoration:underline;">ข้อมูลส่วนตัว</a> > เปลี่ยนรหัสผ่าน</div>
<?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="policy"){?>
<div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/my" style="text-decoration:underline;">ข้อมูลส่วนตัว</a> > นโยบายส่วนตัว</div>
  <div id="box_area" style="border:#999999 1px solid; margin:10px;padding:10px;">
<?php }?>

    <figure style="width:128px; padding:0; margin:0;float:left;"> <img src="/common/images/employee_pics/<?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['pic_path'];?>
" width="128" height="128">
      <nav id="operation-profile">
        <ul style="font-size:12px;">
          <li> <a href="/my/changepassword">เปลี่ยนรหัสผ่าน</a> </li>
          <!--<li> <a href="/my/policy">ตั้งค่าความเป็นส่วนตัว</a> </li>-->
        </ul>
      </nav>
    </figure>
    <article style="float:right; margin-left:10px; width:85%;height:auto;border:#999999 1px solid;" id="my-info" >
      <?php if ($_smarty_tpl->tpl_vars['page']->value['view']==''){?>
      <header id="details" class="k-header" style="padding:10px;border-bottom:#999999 1px solid;"> ข้อมูลส่วนตัว </header>
      <section style="background-color:#FFF;">
        <table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
          <tr align="left">
            <th width="27%" scope="row">Username :</th>
            <td width="73%"><?php echo $_smarty_tpl->tpl_vars['page']->value['username'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">ชื่อ - สกุล :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['titlename'];?>
              <?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['firstname'];?>

              <?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['lastname'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">Name - Lastname :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['titlenameEN'];?>

              <?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['firstnameEN'];?>

              <?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['lastnameEN'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row" valign="top">กลุ่ม :</th>
            <td><ul style="padding:0; margin:0;">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <li><!--<a href="#edit" class="group-icon" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_id'];?>
"></a>-->
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['group_name'];?>

                </li>
                <?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
                <li>ไม่พบข้อมูล</li>
                <?php } ?>
              </ul></td>
          </tr>
          <tr align="left">
            <th scope="row">สังกัด :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['major_name'];?>

              ,
              <?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['fac_name'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">วันที่จ้าง :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['hire_date'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">ตำแหน่งงาน :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['position'];?>
</td>
          </tr>
          <tr align="left">
            <th colspan="2" class="k-header" scope="row">การศึกษา</th>
          </tr>
          <tr align="left">
            <th scope="row">ระดับปริญญาตรี :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['behavior_degree'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">Behavior Degree :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['behavior_degreeEN'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">ระดับปริญญาโท :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['master_degree'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">Master Degree :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['master_degreeEN'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">ระดับปริญญาเอก :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['phd_degree'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row" >Doctor Degree :</th>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['emp_data']['phd_degreeEN'];?>
</td>
          </tr>
          <tr align="left">
            <th scope="row">&nbsp;</th>
            <td>&nbsp;</td>
          </tr>
          <tr align="left">
            <th scope="row">&nbsp;</th>
            <td>&nbsp;</td>
          </tr>
        </table>
      </section>
      <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="changepassword"){?>
      <header id="details" class="k-header" style="padding:10px;border-bottom:#999999 1px solid;"> เปลี่ยนรหัสผ่าน </header>
      
      <section style="background-color:#FFF;">
      <form method="post" action="">
        <table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
          <tr  align="left">
            <th width="27%" scope="row">รหัสผ่านเดิม</th>
            <td width="73%"><input name="oldPwd" type="password" size="50" maxlength="50" class="k-textbox" required id="oldPwd"/></td>
          </tr>
          <tr  align="left">
            <th scope="row">รหัสผ่านใหม่</th>
            <td><input name="newPwd" type="password" size="50" maxlength="50" id="newPwd" value="" class="k-textbox" required/>
              <br>
              <input  type="text" size="50" maxlength="50" class="k-textbox" readonly/>
            <div id="passwordStrengthDiv" class="is0"></div></td>
          </tr>
         
          <tr  align="left">
            <th scope="row">ยืนยันรหัสผ่านใหม่</th>
            <td><input name="confirmNewPwd" type="password" size="50" maxlength="50" class="k-textbox" required id="confirmNewPwd"/></td>
          </tr>
           <tr  align="center">
            <th colspan="2" scope="row"><input type="button" name="changepwd" value="เปลี่ยนแปลงรหัสผ่าน"  id="confirm"></th>
          </tr>
        </table>
        </form>
     
      </section>
         
        <script>
		$(function(){
			$("#confirm").bind("click",function(event){
				var oldpwd = $("#oldPwd").val();
				var newpwd = $("#newPwd").val();
				var confimpwd = $("#confirmNewPwd").val();
				$.post("/my/changepassword/chk",{ "oldpwd":oldpwd},
				function(res){
					if(res.result){
						$("#oldPwd").css('background','#FFF')
						if(newpwd===confimpwd){
							$("#newPwd").css('background','#FFF')
							$("#confirmNewPwd").css('background','#FFF')
							$.post("/my/changepassword/change",{ "newpwd":newpwd,"confimpwd":confimpwd},
							function(res){
								if(res.result){
									alert("เปลี่ยนรหัสผ่านสำเร็จ")
									window.location("/my")
								}
							},'json')
							return true;
						}else{
							alert("รหัสผ่านใหม่ของคุณไม่ตรงกัน")
							document.getElementById('newPwd').focus()
							$("#newPwd").css('background','#F00')
							$("#confirmNewPwd").css('background','#F00')
							return false;
						}
					}else{
						alert("รหัสผ่านเก่าของคุณไม่ถูกต้อง")
						document.getElementById('oldPwd').focus()
						$("#oldPwd").css('background','#F00')
						return false;
					}
				},'json')
			});
		});
		
		
$.fn.passwordStrength = function( options ){
	return this.each(function(){
		var that = this;that.opts = {};
		that.opts = $.extend({}, $.fn.passwordStrength.defaults, options);
		
		that.div = $(that.opts.targetDiv);
		that.defaultClass = that.div.attr('class');
		
		that.percents = (that.opts.classes.length) ? 100 / that.opts.classes.length : 100;

		 v = $(this)
		.keyup(function(){
			if( typeof el == "undefined" )
				this.el = $(this);
			var s = getPasswordStrength (this.value);
			var p = this.percents;
			var t = Math.floor( s / p );
			var text = "";
			
			if( 100 <= s )
				t = this.opts.classes.length - 1;
			if(s>=0&&s<=40){
				text = "รหัสผ่านไม่ปลอดภัย";
			}else if(s>=41&&s<=75){
				text = "รหัสผ่านพอใช้ได้";
			}
			else if(s>76){
				text = "รหัสผ่านมีความปลอดภัย";
			}
			this.div
				.css('width','80%')
				.removeAttr('class')
				.addClass( this.defaultClass )
				.addClass( this.opts.classes[ t ] )
				.html("<span style='padding-left:150px; color:red'><strong>"+text+"</strong></span>")
			
			
				
		})
		.after('<a href="#">Generate Password</a>')
		.next()
		.click(function(){
			var randPass = randomPassword();
			$(this).prev().val( randPass ).trigger('keyup');
			$('input[name=newPwd_show]').val(randPass);
			return false;
		});
	});

	function getPasswordStrength(H){
		var D=(H.length);
		if(D>5){
			D=5
		}
		var F=H.replace(/[0-9]/g,"");
		var G=(H.length-F.length);
		if(G>3){G=3}
		var A=H.replace(/\W/g,"");
		var C=(H.length-A.length);
		if(C>3){C=3}
		var B=H.replace(/[A-Z]/g,"");
		var I=(H.length-B.length);
		if(I>3){I=3}
		var E=((D*10)-20)+(G*10)+(C*15)+(I*10);
		if(E<0){E=0}
		if(E>100){E=100}
		return E
	}

	function randomPassword() {
		var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$_+";
		var size = 10;
		var i = 1;
		var ret = ""
		while ( i <= size ) {
			$max = chars.length-1;
			$num = Math.floor(Math.random()*$max);
			$temp = chars.substr($num, 1);
			ret += $temp;
			i++;
		}
		return ret;
	}

};
	
$.fn.passwordStrength.defaults = {
	classes : Array('is10','is20','is30','is40','is50','is60','is70','is80','is90','is100'),
	targetDiv : '#passwordStrengthDiv',
	cache : {}
}
$(document)
.ready(function(){
	$('input[name="newPwd"]').passwordStrength();
});
</script>
        
      <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="policy"){?>
     <!-- <section>
        <header id="details" class="k-header" style="padding:10px;border-bottom:#999999 1px solid;">ตั้งค่านโยบายส่วนตัว</header>
        <section> </section>
      </section>-->
      <?php }?>
    </article>
    <div class="clear-all"></div>
  </div>
</div>
</body>
</html><?php }} ?>