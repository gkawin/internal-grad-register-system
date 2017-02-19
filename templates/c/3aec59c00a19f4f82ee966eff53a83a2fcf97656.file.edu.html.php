<?php /* Smarty version Smarty-3.1.7, created on 2012-06-30 21:05:45
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\edu.html" */ ?>
<?php /*%%SmartyHeaderCode:204084efc6b7f9751e1-24406248%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3aec59c00a19f4f82ee966eff53a83a2fcf97656' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\edu.html',
      1 => 1341065130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204084efc6b7f9751e1-24406248',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4efc6b7f9ec43',
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4efc6b7f9ec43')) {function content_4efc6b7f9ec43($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<link href="/templates/skin/default/edu.css" rel="stylesheet"/>
<script>
$(function(){
	$("li").click(function(){
		window.location = $(this).find("a").attr("href");
	});
});
</script> 
<!-- CONTENT -->
<div class="container"> 
<div style="padding:5pt;"><a href="/edu" style="text-decoration:underline;">หน้าหลัก</a></div>
  <p>
   <h1 style="text-decoration:underline;">Dashboard</h1>
  <div class="recent">
    <ul class="sortable">
      <li class="k-button" id="coursetype"> <a href="/edu/coursetype"> <img src="/templates/skin/default/images/icon/course_type_icon.png" width="32" height="24" style="vertical-align:middle;"/>
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['edu_ct'];?>

        </a> </li>
      <li class="k-button" id="course"> <a href="/edu/course"> <img src="/templates/skin/default/images/icon/course_icon.png" width="24" height="24" style="vertical-align:middle;"/>
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['edu_course'];?>

        </a> </li>
      <li class="k-button" id="syllabus"> <a href="/edu/syllabus"> <img src="/templates/skin/default/images/icon/degree_icon.png" width="24" height="24" style="vertical-align:middle;"/> จัดการหลักสูตร </a> </li>
      <li class="k-button" id="syllabus"> <a href="/edu/level"> <img src="/templates/skin/default/images/icon/degree_icon.png" width="24" height="24" style="vertical-align:middle;"/> ระดับปริญญา</a> </li>

      <li class="k-button" id="building"> <a href="/edu/building"> <img src="/templates/skin/default/images/icon/building_icon.png" width="24" height="24" style="vertical-align:middle;"/> 
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['edu_building'];?>

        </a> </li>
      <li class="k-button" id="building_room"> <a href="/edu/building_room"> <img src="/templates/skin/default/images/icon/New-room-icon.png"width="24" height="24" style="vertical-align:middle;"/> 
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['edu_room'];?>

        </a> </li>
      <li class="k-button" id="faculty"> <a href="/edu/faculty"> <img src="/templates/skin/default/images/icon/shiny-work-icon.png" width="24" height="24" style="vertical-align:middle;"/> 
        จัดการคณะและสาขาวิชา
        </a> </li>
      <!--<li class="k-button" id="major"> <a href="/edu/major" > <img src="/templates/skin/default/images/icon/Browse_by_Subject_icon.png" width="24" height="24" style="vertical-align:middle;"/>
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['edu_major'];?>

        </a> </li>-->
      <li class="k-button" id="employee"> <a href="/edu/employee"> <img src="/templates/skin/default/images/icon/teacher_icon.png" width="24" height="24" style="vertical-align:middle;"/> 
         <?php echo $_smarty_tpl->tpl_vars['lang']->value['edu_emp'];?>

        </a> </li>
      <li class="k-button" id="group"> <a href="/edu/group"> <img src="/templates/skin/default/images/icon/user_group_icon.png" width="24" height="24" style="vertical-align:middle;"/> 
         <?php echo $_smarty_tpl->tpl_vars['lang']->value['edu_group'];?>

        </a> </li>
      <li class="k-button" id="result"> <a href="/edu/result"> <img src="/templates/skin/default/images/icon/results_icon.png" width="24" height="24" style="vertical-align:middle;"/> 
        จัดการผลการศึกษาและผลการสอบ
        </a></li>
      <!--<li class="k-button" id="exam"> <a href="/edu/exam"> <img src="/templates/skin/default/images/icon/exam_icon.png" width="24" height="24" style="vertical-align:middle;"/>
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['edu_exam'];?>

        </a> </li>-->
     <!-- <li class="k-button" id="schedule"> <a href="/edu/schedule"> <img src="/templates/skin/default/images/icon/schedule_icon.png" width="24" height="24" style="vertical-align:middle;"/>
        <?php echo $_smarty_tpl->tpl_vars['lang']->value['schedule'];?>

        </a> </li>-->
      <li class="k-button" id="my"> <a href="/my"> <img src="/templates/skin/default/images/icon/profile_icon.png" width="24" height="24" style="vertical-align:middle;"/> 
         <?php echo $_smarty_tpl->tpl_vars['lang']->value['myprofile'];?>

        </a></li>
    </ul>
  </div>
</p>
    <!-- / box debates --> 
      <div class="clear-all">&nbsp;</div>
  </div>
</div>
</body>
</html><?php }} ?>