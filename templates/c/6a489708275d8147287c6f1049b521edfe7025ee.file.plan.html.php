<?php /* Smarty version Smarty-3.1.7, created on 2012-03-31 08:04:41
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\plan.html" */ ?>
<?php /*%%SmartyHeaderCode:243894f2ba67542e532-71361294%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a489708275d8147287c6f1049b521edfe7025ee' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\plan.html',
      1 => 1333173696,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '243894f2ba67542e532-71361294',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f2ba67560c9e',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
    '_planitem' => 0,
    'res' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f2ba67560c9e')) {function content_4f2ba67560c9e($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
.toolbar ul {
	list-style:none;padding:0;
}
.toolbar li{ display:inline;}
#tblist{ border:#000 1px solid;}

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

<script type="text/javascript">
	$(document).ready(function() {	
		$(".aa").each(function(index, element) {
			var i =Array();
			$(".c_s"+index).tokenInput("/service/callbackJson?module=course",{ 
			theme: "facebook",
			preventDuplicates: true,
            propertyToSearch: "course_id",
			tokenValue: "course_id",
			animateDropdown: true,
			hintText: "ป้อนรหัสวิชาที่ต้องการ",
            noResultsText: "ไม่พบข้อมูล",
            searchingText: "กำลังค้นหา...",
			resultsFormatter: 
				function(item){ 
				return "<li><div style='display: inline-block;'><div class='course_name'>" + item.course_id + " : " + item.course_name + "</div><div class='course_nameEN'>" + item.course_idEN + " : " + item.course_nameEN + "</div></div></li>" 
				},
            tokenFormatter: function(item) { return "<li><p>" + item.course_id + " : " + item.course_name + "</p></li>" },
	
			onAdd: function (item) {
				i[index] += parseInt(item.credit);
				$("#sum_credit").html(i[index]);
				
				
            },
            onDelete: function (item) {
				i[index] -= parseInt(item.credit);
                $("#sum_credit").html(i[index]);
            }  
		});	
		
		});
		
		
		
	});
	</script>
<script>
/*	$(function(){

	
	
	

 });*/

</script>

<!-- CONTENT -->
<div class="container">
  <div style="margin-left:10pt; width:98%; "> 
    <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
    <section style="width:100%; padding-bottom:30px;">
      <div class="toolbar">
        <ul>
         <a href="/edu/plan/form" class="k-button"><li class="add_new_icon line">เพิ่มแผนการศึกษาใหม่</li></a>
          
        </ul>
      </div>
      <table  width="100%" cellpadding="3" class="tblist" id="tblist">
       <thead>
          <tr>
            <td width="778"  style="text-align: left">ชื่อหลักสูตร</td>
            <td width="172" style="text-align: left">ระดับปริญญา</td>
          </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_program']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          
          <tr class="rowhl" valign="top">
            <td style="text-align: left">
            <ul class="treeView">
              <li><?php echo $_smarty_tpl->tpl_vars['row']->value['program_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>

              <ul>
              	<table width="100%">
                <thead class="k-header">
                <tr>
                <th width="28%" style="text-align: left">หลักสูตรแผน</th>
                <th width="34%" style="text-align: left">หน่วยกิตรวม</th>
                <th width="21%" style="text-align: left">สถานะ</th>
                <th width="15%" style="text-align: left">ดำเนินการ</th>
                </tr>
                </thead>
            <?php  $_smarty_tpl->tpl_vars['_planitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_planitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_plan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_planitem']->key => $_smarty_tpl->tpl_vars['_planitem']->value){
$_smarty_tpl->tpl_vars['_planitem']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['row']->value['program_id']==$_smarty_tpl->tpl_vars['_planitem']->value['program_id']){?>
      			<tr>
                <td style="text-align: left">
                	<li><a href="/edu/plan/view?id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['id'];?>
&program_id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_id'];?>
&suite=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_suite'];?>
" style="text-decoration:underline;"><?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_suite'];?>
</a></li>
          		</td>
                <td align="center" style="text-align: left">
                	<li><?php echo $_smarty_tpl->tpl_vars['_planitem']->value['all_credit'];?>
 หน่วยกิต</li> 
          		</td>
                <td align="center" style="text-align: left">
                	<li><?php echo $_smarty_tpl->tpl_vars['_planitem']->value['statusTH'];?>
</li> 
          		</td>
                <td align="center" style="text-align: left">
                	<li>
                <a href="/edu/plan/form?editid=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['id'];?>
&program_id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_id'];?>
&suite=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_suite'];?>
" style="border:none;"><img src="../../../common/images/icons/edit.gif"></a>
                <a href="#" class="rdel" rel="<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['id'];?>
"><img src="../../../common/images/icons/delete.png"></a></li> 
          		</td>
                </tr>
                <?php }?>
             <?php } ?>
            </table>
                </ul>
                </li>
              </ul>
            </td>
            <td style="text-align: left"><?php echo $_smarty_tpl->tpl_vars['row']->value['degree_level_name'];?>
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
<?php if (!empty($_smarty_tpl->tpl_vars['row']->value)){?><a href="/edu/plan"  class="k-button"> Click Here to Forward</a><?php }?></div>
    <?php }?>
    <a href="/edu/plan" class="k-button" >Show all data</a>
    
    <div>
    <form id="addnew" method="post" action="">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <thead>
          <tr>
            <th colspan="2" scope="col" style="
            padding:15pt;background-color:#FFFFCC;">แบบฟอร์มบันทึกแผนการศึกษา</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <th colspan="2" class="k-header">หมวดโครงสร้างหลักสูตร (Plan Structor)</th>
            </tr>
          <tr>
            <td width="20%">รหัสหลักสูตร :</td>
            
            <td width="80%"><select name="suite_id">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_program']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['program_id'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['program_id'];?>

                    :
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['program_name'];?>
 
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['major_name'];?>

                    </option>
                   
                    <?php } ?>
                  </select>
             </td>
          </tr>
          <tr>
            <td>ชนิดแผนการศึกษา :</td>
            <td>
            <select name="program_suite">
            	<option>ก แบบ ก(1)</option>
                <option>ก แบบ ก(2)</option>
                <option>ข</option>
            </select>
            
            </td>
          </tr>
          <tr>
            <th colspan="2" class="k-header">หมวดโครงสร้างวิชา (Courses Structor)</th>
          </tr>
          <tr class="courseGroup">
          		
            <td valign="top">หมวด :</td>
            <td><div id="input1" style="margin-bottom:4px;" class="clonedInput">
		<table border="0">
                	<tbody>
                    <tr>
                      <td><select style="float:left;" name="course_Struc[]">
              <option disabled>กรุณาเลือก</option>
              <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_ct']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameTH'];?>
 : <?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameEN'];?>
</option>
              <?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
              <option>กรุณาเพิ่มแผนการศึกษาในหน้า /edu/degree?act=program</option>
              <?php } ?>
              </select><strong><span style="float:left;padding:3px;">หน่วยกิตรวม :</span><div id="sum_credit" style="position:relative; float:left; padding:3px;">0</div><span style="float:left; padding:3px;"> หน่วยกิต</span></strong></td>
                    </tr>
                    <tr>
                      <td>
              <input name="course_list[]" type="text" id="course_list" class="c_s0 aa"></td>
                    </tr>
                    </tbody>
                  </table>  
	</div>
<div id="input1" style="margin-bottom:4px;" class="clonedInput">
		<table border="0">
                	<tbody>
                    <tr>
                      <td><select style="float:left;" name="course_Struc[]">
              <option disabled>กรุณาเลือก</option>
              <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_ct']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameTH'];?>
 : <?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameEN'];?>
</option>
              <?php }
if (!$_smarty_tpl->tpl_vars['item']->_loop) {
?>
              <option>กรุณาเพิ่มแผนการศึกษาในหน้า /edu/degree?act=program</option>
              <?php } ?>
              </select><strong><span style="float:left;padding:3px;">หน่วยกิตรวม :</span><div id="sum_credit" style="position:relative; float:left; padding:3px;">0</div><span style="float:left; padding:3px;"> หน่วยกิต</span></strong></td>
                    </tr>
                    <tr>
                      <td>
              <input name="course_list[]" type="text" id="course_list" class="c_s1 aa"></td>
                    </tr>
                    </tbody>
                  </table>  
	</div>

	<div>
		<input type="button" id="btnAdd" value="add another name" />
		<input type="button" id="btnDel" value="remove name" />
	</div>
                  <button type="button" id="btnAdd" class="k-button">เพิ่มหมวดโครงสร้างวิชาอีก</button>
                <button type="button" id="btnDel">ลบ</button></td>
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