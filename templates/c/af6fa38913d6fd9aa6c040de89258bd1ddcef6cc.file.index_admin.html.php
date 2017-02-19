<?php /* Smarty version Smarty-3.1.7, created on 2012-07-10 01:18:59
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\index_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:199164fb53be3df1a38-62869199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af6fa38913d6fd9aa6c040de89258bd1ddcef6cc' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\\index_admin.html',
      1 => 1341857936,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199164fb53be3df1a38-62869199',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fb53be3e5301',
  'variables' => 
  array (
    'page' => 0,
    'res' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb53be3e5301')) {function content_4fb53be3e5301($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta charset="utf-8"/>
<title>Dashboard I Admin Panel</title>
<link rel="stylesheet" href="/templates/skin/HTML5 Admin Template/css/layout.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../../libs/jquery/plugins/DataTables-1.9.0/media/css/jquery.dataTables.css" type="text/css" />
<link rel="stylesheet" href="../../../libs/jquery/plugins/Kendo UI/styles/kendo.common.min.css" type="text/css" />
<link rel="stylesheet" href="../../../libs/jquery/plugins/Kendo UI/styles/kendo.default.min.css" type="text/css" />
<!--[if lt IE 9]>
	<link rel="stylesheet" href="templates/skin/HTML5 Admin Template/css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<script src="../../../libs/jquery/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="../../../libs/jquery/plugins/Kendo UI/source/js/kendo.all.js" type="text/javascript"></script>
<script src="../../../libs/jquery/plugins/DataTables-1.9.0/media/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="/templates/skin/HTML5 Admin Template/js/hideshow.js" type="text/javascript"></script>
<script src="/templates/skin/HTML5 Admin Template/js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/templates/skin/HTML5 Admin Template/js/jquery.equalHeight.js"></script>
<script type="text/javascript" src="/templates/skin/HTML5 Admin Template/alljs.js"></script>
<style>
.loading{
	background:url(../../../common/images/icons/loading.gif) no-repeat right 0; padding-right:20px; }
</style>
</head>

<body>
<header id="header">
  <hgroup>
    <h1 class="site_title"><a href="/system">Admin</a></h1>
    <h2 class="section_title">ระบบจัดการและควบคุมระเบียนนักศึกษา</h2>
  </hgroup>
</header>
<!-- end of header bar -->

<section id="secondary_bar">
  <div class="user">
    <!--<p>
      <?php echo $_smarty_tpl->tpl_vars['page']->value['sFullName'];?>

      (<a href="#">NULL Messages</a>)</p>
    <!-- <a class="logout_user" href="#" title="Logout">Logout</a> --> 
  </div>
  
  <div class="breadcrumbs_container">
  
    <article class="breadcrumbs">
    <?php switch ($_smarty_tpl->tpl_vars['page']->value['segment']){?>
<?php case '':?>
    	<a href="/system">หน้าหลัก</a>
    <?php break;?><?php case "user":?>
    	<?php switch ($_smarty_tpl->tpl_vars['page']->value['view']){?>
<?php case "userAdd":?>
    	<a href="/system">หน้าหลัก</a>
        <div class="breadcrumb_divider"></div>
      	<a class="current">เพิ่มบัญชีผู้ใช้</a>
        <?php break;?><?php case "viewUser":?>
    	<a href="/system">หน้าหลัก</a>
        <div class="breadcrumb_divider"></div>
      	<a class="current">ดูบัญชีผู้ใช้</a>
        <?php break;?><?php case "emp":?>
    	<a href="/system">หน้าหลัก</a>
        <div class="breadcrumb_divider"></div>
      	<a class="current">เพิ่มข้อมูลพนักงานและบัญช</a>
        <?php }?>
    <?php break;?><?php case "log":?>
    <a href="/system">หน้าหลัก</a>
    <div class="breadcrumb_divider"></div>
    <a class="current">บันทึกรายการของระบบ</a>
    <?php break;?><?php case "userlog":?>
    <a href="/system">หน้าหลัก</a>
    <div class="breadcrumb_divider"></div>
    <a class="current">บันทึกรายการของบัญชีผู้ใช้</a>
    <?php break;?><?php case "secure":?>
    	<a href="/system">หน้าหลัก</a>
        <div class="breadcrumb_divider"></div>
        <a class="current">ระบบความปลอดภัย</a>
    	<?php switch ($_smarty_tpl->tpl_vars['page']->value['view']){?>
<?php case "changepassword":?>
        <div class="breadcrumb_divider"></div>
        <a class="current">เปลี่ยนรหัสผ่านผู้ดูแลระบบ</a>
        <?php }?>
  	<?php }?>     
        
      	
    </article>
  </div>
</section>
<!-- end of secondary bar -->

<aside id="sidebar" class="column">
  <form class="quick_search">
    <input type="text" value="Quick Search" onfocus="if(!this._haschanged){ this.value=''};this._haschanged=true;">
  </form>
  <!--<hr/>
		<h3>Content</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="#">New Article</a></li>
			<li class="icn_edit_article"><a href="#">Edit Articles</a></li>
			<li class="icn_categories"><a href="#">Categories</a></li>
			<li class="icn_tags"><a href="#">Tags</a></li>
		</ul>-->
  <h3>จัดการผู้ใช้งาน</h3>
  <ul class="toggle">
    <!--<li class="icn_add_user"><a href="/system/user/add">เพิ่มบัญชีผู้ใช้</a></li>-->
    <li class="icn_view_users"><a href="/system/user/view">ดูบัญชีผู้ใช้</a></li>
    <li class="icn_profile"><a href="/system/user/emp">เพิ่มข้อมูลพนักงานและบัญชี</a></li>
  </ul>
  <h3>จัดการข้อมูลการใช้งาน</h3>
  <ul class="toggle">
    <li class="icn_folder"><a href="/system/log">บันทึกรายการของระบบ</a></li>
    <li class="icn_photo"><a href="/system/userlog">บันทึกรายการของบัญชีผู้ใช้</a></li>
	<!--<li class="icn_audio"><a href="#">Au</a></li>
	<li class="icn_video"><a href="#">Video</a></li>-->
  </ul>
  <h3>ดูแลระบบ</h3>
  <ul class="toggle">
    <!--<li class="icn_settings"><a href="#">จัดการระบบโมดูล</a></li>-->
    <li class="icn_security"><a href="/system/secure">ระบบความปลอดภัย</a></li>
    <li class="icn_jump_back"><a href="/dologout">ออกจากระบบ</a></li>
  </ul>
  <footer>
    <hr />
  </footer>
</aside>
<section id="main" class="column">

  
  <?php if ($_smarty_tpl->tpl_vars['page']->value['segment']=="user"){?>
  <?php echo $_smarty_tpl->getSubTemplate ('user_admin.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['segment']=="log"||$_smarty_tpl->tpl_vars['page']->value['segment']=="userlog"){?>
  <?php echo $_smarty_tpl->getSubTemplate ('log_admin.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['segment']=="secure"){?>
  <?php echo $_smarty_tpl->getSubTemplate ('secure_admin.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  <?php }else{ ?>
   <style>
   img{
   vertical-align:middle;

	
   }
  
   </style>
  <article class="module width_full">
    <header>
      <h3>DashBoard</h3>
    </header>
    <div class="module_content" style="position:relative;">
    <?php if ($_smarty_tpl->tpl_vars['res']->value['adminChange']){?>
    <div id="notice" style="padding:10pt; background:#FF9900;"><strong>กรุณาเปลี่ยนรหัสผ่านผู้ดูแลระบบโดยทันที เพื่อความปลอดภัย</strong></div><?php }?>

    	<div style="margin-left:4.7em; position:relative;">
<!--  <a href="/system/user/add" class="k-button "  style="display:block; margin:5pt; width:20%; float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_add_user.png"> เพิ่มบัญชีผู้ใช้</a>-->
  <a href="/system/user/view" class="k-button " style="display:block; margin:5pt; width:20%;float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_view_users.png">ดูบัญชีผู้ใช้</a>
  <a href="/system/user/emp" class="k-button " style="display:block; margin:5pt; width:20%;float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_profile.png">เพิ่มข้อมูลพนักงานและบัญชี</a>
 
  <a href="/system/log" class="k-button " style="display:block; margin:5pt; width:20%;float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_folder.png">บันทึกรายการของระบบ</a>
  <a href="/system/userlog" class="k-button " style="display:block; margin:5pt; width:20%;float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_photo.png">บันทึกรายการของบัญชีผู้ใช้</a>
<!--  <a href="#" class="k-button " style="display:block; margin:5pt; width:20%;float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_settings.png">จัดการระบบโมดูล</a>-->
 	<a href="/system/secure" class="k-button " style="display:block; margin:5pt; width:20%;float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_security.png">ระบบความปลอดภัย</a>
   <a href="/dologout" class="k-button " style="display:block; margin:5pt; width:20%;float:left;color:#000;"><img src="/templates/skin/HTML5 Admin Template/images/icn_jump_back.png">ออกจากระบบ</a>
   <div class="clear"></div>
    </div>
    </div>
  </article>
  <!-- end of stats article -->
  <?php }?>
 
</section>
</body>
</html><?php }} ?>