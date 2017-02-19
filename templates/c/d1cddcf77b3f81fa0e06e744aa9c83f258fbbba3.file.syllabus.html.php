<?php /* Smarty version Smarty-3.1.7, created on 2012-07-08 01:07:04
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\syllabus.html" */ ?>
<?php /*%%SmartyHeaderCode:319134f76936564f9e3-40360344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1cddcf77b3f81fa0e06e744aa9c83f258fbbba3' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\syllabus.html',
      1 => 1341684421,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '319134f76936564f9e3-40360344',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f7693657b584',
  'variables' => 
  array (
    'res' => 0,
    'row' => 0,
    'page' => 0,
    '_planitem' => 0,
    'item' => 0,
    'ModelItem' => 0,
    'des' => 0,
    'i' => 0,
    'edu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f7693657b584')) {function content_4f7693657b584($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<style>
.toolbar ul {
	list-style:none;padding:0;
}
.odd{ background:#FFFAE6;}
ul.token-input-list-facebook{
	width:455px;
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
</style>
<script>
var i =0;
var sPreJson = '<?php echo $_smarty_tpl->tpl_vars['res']->value['oStruJson'];?>
';

var option_token = Array();
if(sPreJson !=''){
	var oPostJson = eval('('+sPreJson+')');
	///i=parseInt(oPostJson[1][0].all_credit);
	for(x in oPostJson){
		console.log(x);
		option_token[x] = { 
				theme: "facebook",
				prePopulate : oPostJson[x],
				preventDuplicates: true,
				propertyToSearch: "course_id",
				tokenValue: "course_id",
				animateDropdown: true,
				hintText: "ป้อนรหัสวิชาที่ต้องการ",
				noResultsText: "ไม่พบข้อมูล",
				searchingText: "กำลังค้นหา...",
				resultsFormatter: 
					function(item){ 
					return "<li><div style='display: inline-block;'><div class='course_name'>" + item.course_id + " : " + item.course_name + " ("+ item.credit+ "หน่วยกิต)</div><div class='course_nameEN'>" + item.course_idEN + " : " + item.course_nameEN + "</div></div></li>"
					},
				tokenFormatter: function(item) { return "<li><p>" + item.course_id + " : " + item.course_name + "</p></li>" },
		
				onAdd: function (item) {
					i += parseInt(item.credit);
					$("#sum_credit").html('<input name="all_credit" value='+i+' size="5" maxlength="25" readonly >');
					
					
				},
				onDelete: function (item) {
					i -= parseInt(item.credit);
					$("#sum_credit").html(i);
				}  
			};
	}
}
	var option_token_default = { 
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
				return "<li><div style='display: inline-block;'><div class='course_name'>" + item.course_id + " : " + item.course_name + " (<b style='color:red'>"+ item.credit+ " หน่วยกิต</b>)</div><div class='course_nameEN'>" + item.course_idEN + " : " + item.course_nameEN + "</div></div></li>" 
				},
            tokenFormatter: function(item) { return "<li><p>" + item.course_id + " : " + item.course_name + "</p></li>" },
	
			onAdd: function (item) {
				i += parseInt(item.credit);
				$("#sum_credit").html('<input name="all_credit" value='+i+' size="5" maxlength="25" readonly >');
				
				
            },
            onDelete: function (item) {
				i -= parseInt(item.credit);
                $("#sum_credit").html(i);
            }  
		};
	

$(".aa").tokenInput("/service/callbackJson?module=course",option_token_default);
$(function(){
	$("#gpa").kendoNumericTextBox({
      value: '<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['minimum_gpa'];?>
',
     min: 1,
     max: 4,
     step: 0.5,
     format: "n",
     decimals: 2
});
	$(".delSyl").click(function(){
		if(confirm("คุณต้องการลบข้อมูลหลักสูตรทั้งหมดหรือไม่")){
			/*check plan*/
			var programid = $(this).attr("rel");
			$this = $(this);
			$.post('/edu/syllabus',{ "deltype":"<?php ob_start();?><?php echo md5('chkpil');?>
<?php $_tmp1=ob_get_clean();?><?php echo sha1($_tmp1);?>
","programid":programid},function(data){
				if(data.result){
					if(confirm("โปรดระวัง มีแผนการศึกษาบรรจุอยู่ในหลักสูตร คุณต้องการลบหลักสูตรและแผนการศึกษาทั้งหมดหรือไม่")){
						$.post('/edu/syllabus',{ "deltype":"<?php ob_start();?><?php echo md5('confirmdel');?>
<?php $_tmp2=ob_get_clean();?><?php echo sha1($_tmp2);?>
","programid":programid},function(data){
							if(data.result){
								$this.parents("tr").fadeOut("fast", function(){
								$this.parents("tr").remove();
								});
							}
						},'json')
					}else{
						return false;
					}
				}else{
					$.post('/edu/syllabus',{ "deltype":"<?php ob_start();?><?php echo md5('confirmdel');?>
<?php $_tmp3=ob_get_clean();?><?php echo sha1($_tmp3);?>
","programid":programid},function(data){
						if(data.result){
							$this.parents("tr").fadeOut("fast", function(){
							$this.parents("tr").remove();
							});
						}
						},'json')
				}
			},'json')
		}
	});	

	$(".delPlan").click(function(event){
		var sBin = $(this).attr("rel");
		$this = $(this);
		if(!confirm("คุณต้องการลบแผนการศึกษานี่หรือไม่"))return;
			$.post("/edu/syllabus",{ "deltype":"<?php ob_start();?><?php echo md5('plandel');?>
<?php $_tmp4=ob_get_clean();?><?php echo sha1($_tmp4);?>
","edu_plan_id":sBin},
			function(data){
				if(data.result){
					$this.parents("tr.planclass").fadeOut('slow',
					function(){
						$this.parents("tr.planclass").remove();
					});
				}
			},"json");
	});
});
	var values,lval = null;
	var bSubmit = false;
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
	function setSelectPlan(value){
		values = value;
		$("input[name=program_suite_p2]").removeAttr('disabled');
	}
	function getsetSelectPlan(){
		return values;
	}
	
	function chkValue(type,value,minChar){
		var lval = new Array();
		var bOnChar = false;
		var iCharLength =0;
		if(type === "plan"){
			lval.push(getsetSelectPlan()+" แบบ "+value);
			lval.push('<?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
echo $_GET["programid"];<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');

			bOnChar = true;
		}else if(type === "syllabus"){
			lval.push(value);
			bOnChar = true;
			iCharLength = value.length;
		}
		if(bOnChar && minChar <= iCharLength){
			$.ajax({  
    		type: "POST",  
			url: "/edu/syllabus",  
			data: "chktype="+type+"&chkdata="+lval,  
			success: 
				function(msg){
			 		$("#status_bar").ajaxComplete(function(event, request, settings){ 
					if(msg === "OK"){ 
						$(this).html('&nbsp;<img src="../../../common/images/icons/accepted.png" align="absmiddle"> <font color="Green"> Available </font>');
						return true
					
					}else{  
						$(this).html(msg);
						return false
						
					}   
				});
				}
			});
		}else{
			return false
		}	
	}
	function syllabusPrefix(o){
		
		$.post("/service/callbackJson?module=degree_level_no_token",
		{
			"q":o.value
		},function(res){
			document.getElementById("program_name").value = res[0].qualification;
			document.getElementById("program_nameEN").value = res[0].qualificationEN;
		},'json')
	}
	function majorAppend(o){
		var p_name = $("#program_name").val();
		var p_nameEN = $("#program_nameEN").val();
		$.post("/edu/syllabus",{ "majorAppend":true,"major_id":o.value},
		function(res){
			
		},'json');
		
	}
</script> 
<!-- CONTENT -->
<div class="container"> 
  <!--- DEGREE LEVEL ZONE ---->
  <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > จัดการหลักสูตรและแผนการศึกษา</div>
  <section>
    <div >
      <ul style="padding:0;">
        <li class="k-button"><a href="/edu/syllabus/form/new" class="add_new_icon ex1">เพิ่มหลักสูตรใหม่</a></li>
        <li class="k-button"><a href="/edu/syllabus/plan/students" class="ex1">กำหนดหลักสูตรให้นักศึกษา</a></li>
      </ul>
    </div>
    <table  width="100%" cellpadding="3" class="tblist" id="tblist">
      <thead class="k-header">
        <tr>
          <td width="641"><strong>ชื่อหลักสูตร</strong></td>
          <td width="47" align="center"><strong>ปีศึกษา</strong></td>
          <td width="62" align="center"><strong>เกรดต่ำสุด</strong></td>
          <td width="78" align="center"><strong>ระดับปริญญา</strong></td>
          <td width="118" align="center"><strong>กระทำการ</strong></td>
        </tr>
      </thead>
      <tbody>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_syllabus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr class="rowhl" valign="top">
          <td style="text-align: left"><ul class="treeView">
              <li>
                <?php echo $_smarty_tpl->tpl_vars['row']->value['program_name'];?>

                <?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>

                <ul>
                  <table width="100%" id="innertable" class="innertb" bgcolor="#FFFFFF">
                    <thead class="k-header">
                      <tr>
                        <th width="37%" >หลักสูตรแผน</th>
                        <th width="25%" >หน่วยกิตรวม</th>
                        <th width="14%" >สถานะ</th>
                        <th width="24%" >ดำเนินการ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  $_smarty_tpl->tpl_vars['_planitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_planitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_plan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_planitem']->key => $_smarty_tpl->tpl_vars['_planitem']->value){
$_smarty_tpl->tpl_vars['_planitem']->_loop = true;
?>
                      <?php if ($_smarty_tpl->tpl_vars['row']->value['program_id']==$_smarty_tpl->tpl_vars['_planitem']->value['program_id']){?>
                      <tr class="planclass">
                        <td style="text-align: left"><li><a href="/edu/syllabus/plan/view?id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['id'];?>
" style="text-decoration:underline;">
                            <?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_suite'];?>

                            </a></li></td>
                        <td align="center"><li>
                            <?php echo $_smarty_tpl->tpl_vars['_planitem']->value['all_credit'];?>

                            หน่วยกิต</li></td>
                        <td align="center"><li>
                            <?php echo $_smarty_tpl->tpl_vars['_planitem']->value['statusTH'];?>

                          </li></td>
                        <td><li>
                            <ul class="ulmenu">
                              <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/syllabus/plan/edit?id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['edu_id'];?>
&program_id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_id'];?>
&suite=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_suite'];?>
">แสดงรายละเอียด</a></li>
                              <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"> <a href="#" class="delPlan" rel="<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['edu_id'];?>
">ลบแผน</a></li>
                              <li><img src="../../../common/images/icons/no_credit.png" style="vertical-align:middle;"> <a href="/edu/syllabus/plan/nocredit?id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['edu_id'];?>
&program_id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_id'];?>
&program_name=<?php echo $_smarty_tpl->tpl_vars['row']->value['program_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>
&suite=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_suite'];?>
">วิชาไม่นับหน่วยกิต</a></li>
                              <li><img src="../../../common/images/icons/room_schedule.png" style="vertical-align:middle;"> <a href="/edu/syllabus/plan/makeschedule?id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['edu_id'];?>
&program_id=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_id'];?>
&program_name=<?php echo $_smarty_tpl->tpl_vars['row']->value['program_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>
&suite=<?php echo $_smarty_tpl->tpl_vars['_planitem']->value['program_suite'];?>
&dlvl=<?php echo $_smarty_tpl->tpl_vars['row']->value['degree_level_name'];?>
">กำหนดแผนการเรียน</a></li>
                            </ul>
                          </li></td>
                      </tr>
                      <?php }?>
                      <?php } ?>
                    </tbody>
                  </table>
                </ul>
              </li>
            </ul></td>
          <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['years_normal'];?>
</td>
          <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['minimum_gpa'];?>
</td>
          <td align="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['degree_level_name'];?>
</td>
          <td><ul class="ulmenu">
              <li><img src="/templates/skin/HTML5 Admin Template/images/icn_new_article.png" style="vertical-align:middle;"> <a href="/edu/syllabus/plan/new?programid=<?php echo $_smarty_tpl->tpl_vars['row']->value['program_id'];?>
">แผนใหม่</a></li>
              <li><img src="../../../common/images/icons/edit.gif" style="vertical-align:middle;"> <a href="/edu/syllabus/form/edit?programid=<?php echo $_smarty_tpl->tpl_vars['row']->value['program_id'];?>
">แก้ไขหลักสูตร</a>
              <li><img src="../../../common/images/icons/delete.png" style="vertical-align:middle;"> <a href="#" rel="<?php echo $_smarty_tpl->tpl_vars['row']->value['program_id'];?>
" data-id="syl" class="delSyl">ลบหลักสูตร</a></li>
            </ul></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="form"){?>
  <div>
    <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/syllabus" style="text-decoration:underline;">จัดการหลักสูตรและแผนการศึกษา</a> >
      <?php if (empty($_smarty_tpl->tpl_vars['row']->value['_editsyll'])){?>
      เพิ่มหลักสูตรใหม่
      <?php }else{ ?>
      แก้ไขหลักสูตร
      <?php }?>
    </div>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
     <p id="landing"> <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>หากต้องการเพิ่มแผนการศึกษา กรุณา <a href="/edu/syllabus/plan/new?programid=<?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['idBack'];?>
">คลิ๊กที่นี้</a>
      <?php }?>
   
    <form name="syllabusForm" method="post" action="" onSubmit="return getSubmit()">
      <table width="100%" border="0" cellspacing="0" cellpadding="5" bgcolor="#FFFFFF" style="border:#000000 solid 1px;">
        <thead>
          <tr class="k-header">
            <th colspan="2" scope="col" >แบบฟอร์มรายละเอียดหลักสูตร</th>
          </tr>
        </thead>
        <tbody >
          <tr>
            <td ><?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>
              ชื่อผู้บันทึก
              <?php }else{ ?>
              ชื่อผู้แก้ไข
              <?php }?>
              :</td>
            <td><?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</td>
          </tr>
          <tr>
            <td>ระดับปริญญา :</td>
            <td><?php if (!empty($_smarty_tpl->tpl_vars['row']->value['_editsyll'])){?>
              <select name="degree_level_id" onChange="syllabusPrefix(this)">
                <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['degLvl_id'];?>
"  selected>
                <?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['qualification_init'];?>
 : <?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['degree_level_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['type'];?>

                </option>
              </select>
              <?php }else{ ?>
              <select name="degree_level_id" onChange="syllabusPrefix(this)">
                <option value="" disabled selected>กรุณาเลือก</option>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_degreeLvl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                <?php echo $_smarty_tpl->tpl_vars['item']->value['qualification_init'];?>
 : <?php echo $_smarty_tpl->tpl_vars['item']->value['degree_level_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>

                </option>
                <?php } ?>
              </select>
              <?php }?></td>
          </tr>
          <tr>
            <td>สาขาวิชา :</td>
            <td>
            
              <select name="major_id" onChange="majorAppend(this)">
              <?php if (empty($_smarty_tpl->tpl_vars['row']->value['_editsyll'])){?>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_major']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['major_id'];?>
">
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['major_name'];?>

                  |
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['fac_name'];?>

                </option>
                <?php } ?>
             <?php }else{ ?>
             <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['major_id'];?>
" selected>
                  <?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['major_name'];?>

                  |
                  <?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['fac_name'];?>

                </option>
             <?php }?>
               
              </select>
          </td>
          </tr>
          <tr>
            <td>รหัสหลักสูตร :</td>
            <td><input name="program_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['program_id'];?>
" size="11" maxlength="6" onKeyUp="return chkValue('syllabus',this.value,6),checkDex(this)" required validationMessage="กรอกรหัสหลักสูตร" class="k-textbox" style="float:left;"<?php if (!empty($_smarty_tpl->tpl_vars['row']->value['_editsyll'])){?> readonly style="background:#CCCCCC;"<?php }?> align="left" >
              <div id="status_bar" style="position:relative; float:left; padding:3px;"></div></td>
          </tr>
          <tr>
            <td width="20%">ชื่อหลักสูตร :</td>
            <td width="80%"><input name="program_name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['program_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['major_name'];?>
" size="70" maxlength="255" id="program_name"  required validationMessage="ระบุชื่อหลักสูตร" class="k-textbox" readonly></td>
          </tr>
          <tr>
            <td>Program Name :</td>
            <td><input name="program_nameEN" id="program_nameEN" class="k-textbox" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['program_nameEN'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['major_nameEN'];?>
" size="70" maxlength="255" onKeyUp="checkEngChar(this)" required validationMessage="Enter Program Name" readonly></td>
          </tr>
          <tr>
            <td>จำนวนปีของหลักสูตร :</td>
            <td><input name="years_normal" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['years_normal'];?>
" size="2" maxlength="1" onKeyUp="checkDex(this)" class="k-textbox" required validationMessage="ระบุปีของหลักสูตร">
              ปี</td>
          </tr>
          <tr >
            <td>จำนวนปีของหลักสูตร (สูงสุด) :</td>
            <td><input name="max_years" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['max_years'];?>
" size="2" maxlength="1" onKeyUp="checkDex(this)"class="k-textbox" required validationMessage="ระบุปีสูงสุดของหลักสูตร">
              ปี</td>
          </tr>
          <tr>
            <td>เกรดเฉลี่ยต่ำสุด :</td>
            <td><input name="minimum_gpa" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['_editsyll']['minimum_gpa'];?>
" size="3" maxlength="5" id="gpa"  class="k-textbox" required validationMessage="ระบุเกรดเฉลี่ย"></td>
          </tr>
          <tr>
            <td>สถานะ :</td>
            <td><select name="status">
                <?php if (!empty($_smarty_tpl->tpl_vars['row']->value['_editsyll'])){?>
                <?php if ($_smarty_tpl->tpl_vars['row']->value['_editsyll']['status']==1){?>
                <option value="1" selected>เปิดใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                <option value="2">รอการอนุมัติ</option>
                <?php }elseif($_smarty_tpl->tpl_vars['row']->value['_editsyll']['status']==2){?>
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
                <option value="1" selected>เปิดใช้งาน</option>
                <option value="0">ยกเลิกการใช้งาน</option>
                <?php }?>
              </select></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="operation" value="<?php if (empty($_smarty_tpl->tpl_vars['row']->value)){?>เพิ่มข้อมูล<?php }else{ ?>แก้ไขข้อมูล<?php }?>" id="button" onClick="return confirm('ยืนยันข้อมูล')">
              <input type="reset" value="Clear" id="button"/></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="newplan"){?>
  <div>
    <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/syllabus" style="text-decoration:underline;">จัดการหลักสูตรและแผนการศึกษา</a> >
      <?php if (empty($_smarty_tpl->tpl_vars['res']->value['oStruJson'])){?>
      เพิ่มแผนการศึกษา
      <?php }else{ ?>
      รายละเอียดแผนการศึกษา
      <?php }?>
    </div>
    <?php if (!empty($_smarty_tpl->tpl_vars['res']->value['callback']['result'])){?>
    <p id="landing">
      <?php echo $_smarty_tpl->tpl_vars['res']->value['callback']['result'];?>
<br>
     คุณจะต้องกำหนดภาคเรียนของแต่ละวิชาในแผนการศึกษานี้ กรุณากลับสู่หน้าหลัก <a href="/edu/syllabus/">คลิ๊กที่นี้</a></p>
    
    <?php }?>
    <form id="addnew" method="post" action="">
      <fieldset>
        <table width="100%" border="0" cellspacing="0" cellpadding="5" class="maintable" bgcolor="#FFFFFF" style="border:1px #000000 solid;">
          <thead>
            <tr>
              <th colspan="2" scope="col" style="
            padding:5pt;background-color:#FFFFCC;">แบบฟอร์มบันทึกแผนการศึกษา</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th colspan="2" class="k-header">หมวดโครงสร้างหลักสูตร (Plan Structor)</th>
            </tr>
            <tr>
              <td width="24%">หลักสูตร :</td>
              <td width="76%"><?php echo $_smarty_tpl->tpl_vars['page']->value['_syllabus'][0]['program_id'];?>

                :
                <?php echo $_smarty_tpl->tpl_vars['page']->value['_syllabus'][0]['program_name'];?>

                <?php echo $_smarty_tpl->tpl_vars['page']->value['_syllabus'][0]['major_name'];?>

                หลักสูตร
                <?php echo $_smarty_tpl->tpl_vars['page']->value['_syllabus'][0]['years_normal'];?>

                ปี</td>
            </tr>
            <tr>
              <td>ชนิดแผนการศึกษา :</td>
              <td><?php if (!empty($_smarty_tpl->tpl_vars['page']->value['_struc'])){?>
                <input name="program_suite" type="text" readonly size="70" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_plan'][0]['program_suite'];?>
" class="k-textbox">
                <?php }else{ ?>
                <select name="program_suite[]" style="float:left;" onChange="return setSelectPlan(this.value)">
                  <option value="" disabled selected>กรุณาเลือก</option>
                  <option>ก</option>
                  <option>ข</option>
                </select>
                <span style="float:left; padding:3px;"> แบบ </span>
                <input name="program_suite[]"  size="30" maxlength="255" onKeyUp="return chkValue('plan',this.value,0)" style="float:left;" class="k-textbox">
                <div id="status_bar" style="position:relative; float:left; padding:3px;"></div>
                <?php }?></td>
            </tr>
            <tr>
              <th colspan="2" class="k-header">หมวดโครงสร้างวิชา (Courses Structor)</th>
            </tr>
            <tr>
              <td>หน่วยกิตรวม : </td>
              <td><div id="sum_credit">
                  <input name="all_credit" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['_struc'][0]['all_credit'];?>
" size="5" maxlength="25" readonly class="k-textbox">
                </div></td>
            </tr>
            <tr class="attach">
              <td colspan="2" ><!--- INSERT COURSE GROUP -->
                
                <?php  $_smarty_tpl->tpl_vars['ModelItem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ModelItem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['res']->value['aModel']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ModelItem']->key => $_smarty_tpl->tpl_vars['ModelItem']->value){
$_smarty_tpl->tpl_vars['ModelItem']->_loop = true;
?>
                <table width="100%" border="0" cellspacing="0" cellpadding="5" id="courseGroup" style="border:#000000 solid 2px; margin-bottom:10px;" bgcolor="#FFFFFF">
                  <tbody>
                    <tr>
                      <td width="220">เลือกหมวด :</td>
                      <td width="738"><select style="float:left;" name="course_Struc[]" id="">
                          <option value="" selected>กรุณาเลือก</option>
                          <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_coursetype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                          <?php if ($_smarty_tpl->tpl_vars['item']->value['id']==$_smarty_tpl->tpl_vars['ModelItem']->key){?>
                          <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" selected>
                          <?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameTH'];?>

                          :
                          <?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameEN'];?>

                          </option>
                          <?php }else{ ?>
                          <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                          <?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameTH'];?>

                          :
                          <?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameEN'];?>

                          </option>
                          <?php }?>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <tr class="numCredit">
                      <td>จำนวนหน่วยกิต :</td>
                      <td><input name="course_type_credit[]" type="text" size="3" maxlength="255" value="<?php echo $_smarty_tpl->tpl_vars['ModelItem']->value[0]['course_type_credit'];?>
" required validationMessage="ระบุหน่วยกิต" class="k-textbox course_type_credit"></td>
                    </tr>
                    <tr>
                      <td>ระบุรายวิชา :</td>
                      <td><input name="course_list[]" type="text" class="aa" value="" title="<?php echo $_smarty_tpl->tpl_vars['ModelItem']->key;?>
"></td>
                    </tr>
                  </tbody>
                </table>
                <?php }
if (!$_smarty_tpl->tpl_vars['ModelItem']->_loop) {
?>
                <table width="100%" border="0" cellspacing="0" cellpadding="5" id="courseGroup" style="border:#000000 solid 2px; margin-bottom:10px;" bgcolor="#FFFFFF">
                  <tbody>
                    <tr>
                      <td width="220">เลือกหมวด :</td>
                      <td width="738"><select style="float:left;" name="course_Struc[]">
                          <option value="" selected>กรุณาเลือก</option>
                          <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_coursetype']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                          <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
                          <?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameTH'];?>

                          :
                          <?php echo $_smarty_tpl->tpl_vars['item']->value['course_type_nameEN'];?>

                          </option>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <tr class="numCredit">
                      <td>จำนวนหน่วยกิต :</td>
                      <td><input name="course_type_credit[]" type="text" size="3" maxlength="255" required validationMessage="ระบุหน่วยกิต" class="k-textbox course_type_credit"></td>
                    </tr>
                    <tr>
                      <td>ระบุรายวิชา :</td>
                      <td><input name="course_list[]" type="text" class="aa"></td>
                    </tr>
                  </tbody>
                </table>
                <?php } ?></td>
            </tr>
            <tr>
              <td colspan="2" valign="top"><button type="button" class="newModel k-button ex1">เพิ่มหมวดวิชา</button>
                <button type="button" class="removeModel k-button ex1">ลบหมวดวิชา</button></td>
            </tr>
            <tr>
              <td valign="top">สถานะ :</td>
              <td>
              <select name="status">
              <?php if (!empty($_smarty_tpl->tpl_vars['page']->value['_struc'][0]['status'])){?>
              <?php switch ($_smarty_tpl->tpl_vars['page']->value['_struc'][0]['status']){?>
<?php case 0:?>
                  <option value="0">ยกเลิก</option>
              <?php break;?><?php case 1:?>
                  <option value="1">ใช้งาน</option>
              <?php break;?><?php case 2:?>
                  <option value="2">รอการอนุมัติ</option>
              
              <?php }?>
              <?php }else{ ?>
              
                  <option value="0">ยกเลิก</option>
              
                  <option value="1" selected>ใช้งาน</option>
              
                  <option value="2">รอการอนุมัติ</option>
              
              <?php }?>
                </select></td>
            </tr>
            <tr>
              <td colspan="2" align="center">
              <?php if (empty($_smarty_tpl->tpl_vars['page']->value['_struc'])){?>
              <input type="submit" name="operation" value="เพิ่มข้อมูล" onClick="return confirm('ยืนยันข้อมูล')">
              <?php }?>
              </td>
            </tr>
          </tbody>
        </table>
      </fieldset>
    </form>
    <script>
	  
      $(function(){
		  var index = 0;
		  jQuery('.maintable > tbody > tr.attach > td > table#courseGroup').find('.aa').each(function(index, element) {
			  if($(this).attr("title")!=null){
				$(this).prevAll().remove();
				$(this).removeAttr('id').removeClass('token-input-list-facebook').tokenInput("/service/callbackJson?module=course",option_token[$(this).attr("title")]);
			  }else{
			  	$(this).prevAll().remove();
				$(this).removeAttr('id').removeClass('token-input-list-facebook').tokenInput("/service/callbackJson?module=course",option_token_default);
			  }	
        });
		  
		  jQuery('.newModel').live('click',function(event){
			  $('.maintable > tbody > tr.attach > td > table#courseGroup')
			  .last().clone().appendTo('.maintable > tbody > tr.attach > td')
			  .find('.aa')
			  .each(function(index, element) {

                  $(this).prevAll().remove(); // remove hasDatepicker class
                  $(this).removeAttr('id').removeClass('token-input-list-facebook').tokenInput("/service/callbackJson?module=course",option_token_default);// re-init datepicker
             });
		});
		jQuery('.removeModel').live('click',function(event){
			if($('.maintable > tbody > tr.attach > td > table#courseGroup').length > 1){
				$('.maintable > tbody > tr.attach > td > table#courseGroup').last().remove();
			}
		});
	});
      </script> 
  </div>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="nonCreditStd"){?>
  <div>
    <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> >  <a href="/edu/syllabus" style="text-decoration:underline;">จัดการหลักสูตรและแผนการศึกษา</a> > จัดการรายวิชาไม่คิดหน่วยกิต</div>
    <table width="100%" border="0" cellpadding="5" >
      <tbody bgcolor="#FFFFFF";>
        <tr>
          <td width="22%">หลักสูตร :</td>
          <td width="78%" colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['_GETDAT']['program_name'];?>
</td>
        </tr>
        <tr>
          <td>ชนิดแผนการศึกษา :</td>
          <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['_GETDAT']['suite'];?>
</td>
        </tr>
      </tbody>
      <tr>
        <th colspan="3" class="k-header">รายชื่อนักศึกษาที่เรียนแผนการศึกษานี้</th>
      </tr>
      <tr>
        <td colspan="3"><table width="100%" cellpadding="5" class="tblist" id="tblist">
            <thead class="k-header">
              <tr>
                <th width="10%" align="left">รหัสนักศึกษา</th>
                <th width="20%" align="left">ชื่อ - สกุล</th>
                <th width="27%" align="left">สังกัด</th>
                <th width="10%" align="left">ดำเนินการ</th>
              </tr>
            </thead>
            <tbody>
              <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_stdList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
              <?php if ($_smarty_tpl->tpl_vars['item']->value['EDUID']==$_smarty_tpl->tpl_vars['page']->value['_GETDAT']['id']){?>
              <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['program_id'];?>

                  :
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['program_name'];?>

                  ,
                  <?php echo $_smarty_tpl->tpl_vars['item']->value['major_name'];?>
</td>
                <td><a href="#" onClick="ShowKendoWindow(<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
,'<?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>
')" class="k-button">กำหนดวิชา</a></td>
              </tr>
              <?php }?>
             
              <?php } ?>
            </tbody>
          </table></td>
      </tr>
    </table>
    <div class="modal-window"></div>
    <div class="clear-all"></div>
  </div>
  <script>
		function ShowKendoWindow(stdCode,stdName) {
        var title = stdName;
        var url = "/edu/syllabus/plan/nocredit/crd?for="+stdCode+"&eid='<?php echo $_smarty_tpl->tpl_vars['row']->value['eid'];?>
'";
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
                content: url,
                title: title,
                draggable: false,
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
   </script>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="makeschedule"){?>
   <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/syllabus" style="text-decoration:underline;">จัดการหลักสูตรและแผนการศึกษา</a> > กำหนดแผนการเรียน</div>
  
  <div>
    <h2>กำหนดแผนการเรียน    </h2>
    <table width="100%" border="0" cellpadding="5" >
      <tbody bgcolor="#FFFFFF";>
        <tr>
          <td width="22%">หลักสูตร :</td>
          <td width="78%" colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['_GETDAT']['program_name'];?>
 , <?php echo $_smarty_tpl->tpl_vars['page']->value['_GETDAT']['dlvl'];?>
</td>
        </tr>
        <tr>
          <td>ชนิดแผนการศึกษา :</td>
          <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['page']->value['_GETDAT']['suite'];?>
</td>
        </tr>
      </tbody>
      <tr>
        <th colspan="3" class="k-header">รายวิชาที่ถูกบรรจุอยู่ในแผนการศึกษา</th>
      </tr>
      <tr>
        <td colspan="3"><table width="100%" border="0" cellpadding="5" style="border:#000 solid 1px; background-color:#FFFFFF;">
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value['_tpSetting']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <tr>
              <th colspan="5" class="k-header" align="left"><?php echo $_smarty_tpl->tpl_vars['item']->key;?>
</th>
            </tr>
            <tr bgcolor="#999999">
              <th width="60%">วิชา</th>
              <th width="10%">ภาคเรียนที่ 1</th>
              <th width="10%">ภาคเรียนที่ 2</th>
              <th width="10%">ภาคเรียนที่ 3</th>
              <th width="10%">ชั้นปี</th>
            </tr>
            <tbody class="learnSchedule">
              <?php  $_smarty_tpl->tpl_vars['des'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['des']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['des']->key => $_smarty_tpl->tpl_vars['des']->value){
$_smarty_tpl->tpl_vars['des']->_loop = true;
?>
              <tr align="center">
                <td align="left"><?php echo $_smarty_tpl->tpl_vars['des']->value['course_id'];?>

                  <?php echo $_smarty_tpl->tpl_vars['des']->value['course_name'];?>
</td>
                <td><div class="<?php if ($_smarty_tpl->tpl_vars['des']->value['semester_1']==1){?>be-able<?php }else{ ?>unable<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['des']->value['course_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['des']->value['semester_1'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['des']->value['course_plan_structure_id'];?>
" id="semester_1"></div>
                <div>
                	
                </div></td>
                <td><div class="<?php if ($_smarty_tpl->tpl_vars['des']->value['semester_2']==1){?>be-able<?php }else{ ?>unable<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['des']->value['course_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['des']->value['semester_2'];?>
" id="semester_2" data-id="<?php echo $_smarty_tpl->tpl_vars['des']->value['course_plan_structure_id'];?>
"></div></td>
                <td><div class="<?php if ($_smarty_tpl->tpl_vars['des']->value['semester_3']==1){?>be-able<?php }else{ ?>unable<?php }?>" title="<?php echo $_smarty_tpl->tpl_vars['des']->value['course_id'];?>
" data-rel="<?php echo $_smarty_tpl->tpl_vars['des']->value['semester_3'];?>
" id="semester_3" data-id="<?php echo $_smarty_tpl->tpl_vars['des']->value['course_plan_structure_id'];?>
"></div></td>
                <td><select name="years_level" onChange="autoUpdate(this,<?php echo $_smarty_tpl->tpl_vars['des']->value['course_plan_structure_id'];?>
)">
                    <?php if (empty($_smarty_tpl->tpl_vars['des']->value['years_level'])){?>
                    <option value="" disabled selected>กรุณาเลือก</option>
                    <?php }?>
                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['page']->value['_syllabus'][0]['years_normal']+1 - (1) : 1-($_smarty_tpl->tpl_vars['page']->value['_syllabus'][0]['years_normal'])+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                    <?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->tpl_vars['des']->value['years_level']){?>
                    <option selected>
                    <?php echo $_smarty_tpl->tpl_vars['i']->value;?>

                    </option>
                    <?php }else{ ?>
                    <option>
                    <?php echo $_smarty_tpl->tpl_vars['i']->value;?>

                    </option>
                    <?php }?>
                    <?php }} ?>
                  </select></td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table></td>
      </tr>
    </table>
  </div>
  <script>
	function autoUpdate(o,updateid){
		if(!confirm("ยืนยันที่จะเปลี่ยน"))return;
		$.post("/edu/syllabus/plan/makeschedule",
		{
			"makeschedule":true,
			"data":o.value,
			"updateid":updateid,
			"target":o.name,
		},
		function(res){},'json');
	}
		$("tbody.learnSchedule div").click(function(){
			$this = $(this);
			var bChangedata = $this.attr('data-rel');
			var updateid = $this.attr("data-id");
			var target = $this.attr("id");
			var nowClass = $this.attr("class");
			if(!confirm("ยืนยันที่จะเปลี่ยนค่าหรือไม่"))return;
				if(bChangedata==1)
					bChangedata = 0;
				else
					bChangedata = 1;
			$.post("/edu/syllabus/plan/makeschedule",
			{ 
				"makeschedule":true,
				"data":bChangedata,
				"updateid":updateid,
				"target":target,
				"courseid":$(this).attr("title")
			},
			function(res){
				if(res.result){
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
				}else{
					alert(res.reason)
					return false;
				}

			},'json');
			

		});
	</script>
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="students"){?>
  <div>
  <div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a> > <a href="/edu/syllabus" style="text-decoration:underline;">จัดการหลักสูตรและแผนการศึกษา</a> > กำหนดหลักสูตรและแผนการเรียนแก่นักศึกษา</div>
  <h2>กำหนดหลักสูตรและแผนการเรียนแก่นักศึกษา</h2>
  <table  width="100%" cellpadding="5" id="tblist">
    <thead  class="k-header">
      <tr valign="top">
        <th width="9%">รหัสนักศึกษา</th>
        <th width="42%">ชื่อนักศึกษา</th>
        <th>หลักสูตรและแผนการศึกษา</th>
        </tr>
    </thead>
    <tbody>
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_gradList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
</td>
        <td><img src="http://202.28.37.99/duk/admin/Manager_Graduate/images_small/<?php echo $_smarty_tpl->tpl_vars['row']->value['image'];?>
" width="64" height="64" style="margin-right:5px;float:left;"/>
          <?php echo $_smarty_tpl->tpl_vars['item']->value['stdName'];?>

          <br>
          <?php echo $_smarty_tpl->tpl_vars['item']->value['stdNameEN'];?>
</td>
        <td>
        <select onChange="updateEducationPlan(this,'<?php echo $_smarty_tpl->tpl_vars['item']->value['Graduate_ID'];?>
')">
        <option value="" selected disabled>กรุณาเลือก</option>
        <?php  $_smarty_tpl->tpl_vars['edu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['edu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_edu_plan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['edu']->key => $_smarty_tpl->tpl_vars['edu']->value){
$_smarty_tpl->tpl_vars['edu']->_loop = true;
?>

<?php if ($_smarty_tpl->tpl_vars['item']->value['edu_plan_id']==$_smarty_tpl->tpl_vars['edu']->value['planID']){?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['edu']->value['planID'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['edu']->value['program_id'];?>
 :<?php echo $_smarty_tpl->tpl_vars['edu']->value['program_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['edu']->value['major_name'];?>
, <?php echo $_smarty_tpl->tpl_vars['edu']->value['program_suite'];?>
 : <?php echo $_smarty_tpl->tpl_vars['edu']->value['degree_level_name'];?>
</option>
       <?php }else{ ?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['edu']->value['planID'];?>
" ><?php echo $_smarty_tpl->tpl_vars['edu']->value['program_id'];?>
 :<?php echo $_smarty_tpl->tpl_vars['edu']->value['program_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['edu']->value['major_name'];?>
, <?php echo $_smarty_tpl->tpl_vars['edu']->value['program_suite'];?>
 : <?php echo $_smarty_tpl->tpl_vars['edu']->value['degree_level_name'];?>
</option>
        <?php }?>
      
        <?php } ?>
         </select>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
  <script>
  function updateEducationPlan(o,gradID){
  	if(!confirm("ยืนยันการเปลี่ยนแปลง")) return;
	$.post("/edu/syllabus/plan/students",
	{
		"operation":true,
		"eduID":o.value,
		"gradID":gradID
	},function(res){
		
	},'json')
  }
  </script>
  <?php }?>
  <div class="clear-all"></div>
</div>
</div>
</div>
</body>
</html><?php }} ?>