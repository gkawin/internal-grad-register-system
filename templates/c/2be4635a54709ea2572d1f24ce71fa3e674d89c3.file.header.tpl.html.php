<?php /* Smarty version Smarty-3.1.7, created on 2012-06-30 20:40:40
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\header.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:83464efc06f0e19e26-02578003%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2be4635a54709ea2572d1f24ce71fa3e674d89c3' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\header.tpl.html',
      1 => 1341063340,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83464efc06f0e19e26-02578003',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4efc06f0e1bc6',
  'variables' => 
  array (
    'titleMsg' => 0,
    'currlang' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4efc06f0e1bc6')) {function content_4efc06f0e1bc6($_smarty_tpl) {?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<script src="../../../libs/jquery/jquery-1.6.2.min.js" ></script>
<script src="../../../libs/jquery/plugins/DataTables-1.9.0/media/js/jquery.dataTables.js"></script>
<script src="../../../libs/jquery/plugins/Kendo UI/js/kendo.all.min.js"></script>
<script src="../../../libs/jquery/plugins/Kendo UI/js/cultures/kendo.culture.th-TH.min.js"></script>
<script src="../../../libs/jquery/plugins/jquery.tools.min.js"></script>
<script src="../../../libs/jquery/plugins/tokeninput/src/jquery.tokeninput.js"></script>
<!--<link href="../../../libs/jquery/plugins/jquery UI/css/start/jquery-ui-1.8.16.custom.css" rel="stylesheet">
<script src="../../../libs/jquery/plugins/jquery UI/js/jquery-ui-1.8.16.custom.min.js"></script>-->
<!--<script src="http://jquery-datatables-row-grouping.googlecode.com/svn/trunk/media/js/jquery.dataTables.rowGrouping.js"></script>-->
<script src="../../../libs/jquery/plugins/jquery.cookie.js"></script>
<script src="../../../libs/jquery/plugins/interface.js"></script>
<script src="/templates/skin/default/alljs.js"></script>

<link href="../../../libs/jquery/plugins/Kendo UI/styles/kendo.common.min.css" rel="stylesheet" />
<link href="../../../libs/jquery/plugins/Kendo UI/styles/kendo.default.min.css" rel="stylesheet" />
<link href="../../../libs/jquery/plugins/tokeninput/styles/token-input-facebook.css" rel="stylesheet" media="screen"/>
<link href="../../../libs/jquery/plugins/DataTables-1.9.0/media/css/jquery.dataTables.css" rel="stylesheet" />
<link href="/templates/skin/default/main.css" rel="stylesheet" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->
<title>
<?php echo $_smarty_tpl->tpl_vars['titleMsg']->value;?>

</title>
<style>

</style>

</head>
<body>
<!-- HEADER LOGO -->
<header style="background:#006600;height:117px;border-bottom:3px #CCCCCC solid;">
  <figure style="width:1000px;margin:0 auto;"> <img src="<?php if ($_smarty_tpl->tpl_vars['currlang']->value=='en'){?>/templates/skin/default/images/head_ffffff_en.png<?php }else{ ?>/templates/skin/default/images/head_ffffff_th.png<?php }?>" width="1000px" height="100px"/>
    <div id="menu_bar">
    	<span style="display:block; padding:5px; float:right;"><a  style="color:#FFFFFF;" href="/dologout" >ออกจากระบบ</a></span> 	
        <span style="display:block;color:#FFFFFF; padding:5px; float:left;">เข้าใช้งานโดย : <?php echo $_smarty_tpl->tpl_vars['page']->value['user']['nameTH'];?>
</span> 
        <span style="display:block;color:#FFFFFF; padding:5px;" >| เวลา : <span id="clockbox"></span><div class="clear-all"></div></span> 
        </div>
  </figure>

</header>

<?php }} ?>