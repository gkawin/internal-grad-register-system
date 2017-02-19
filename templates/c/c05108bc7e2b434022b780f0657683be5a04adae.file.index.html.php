<?php /* Smarty version Smarty-3.1.7, created on 2012-03-29 06:51:41
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\index.html" */ ?>
<?php /*%%SmartyHeaderCode:219654f721d8f5a6bf9-03292990%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c05108bc7e2b434022b780f0657683be5a04adae' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/HTML5 Admin Template\\index.html',
      1 => 1332996699,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '219654f721d8f5a6bf9-03292990',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f721d8f5e018',
  'variables' => 
  array (
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f721d8f5e018')) {function content_4f721d8f5e018($_smarty_tpl) {?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Dashboard I Admin Panel</title>
<link rel="stylesheet" href="/templates/skin/HTML5 Admin Template/css/layout.css" type="text/css" media="screen" />
<!--[if lt IE 9]>
	<link rel="stylesheet" href="templates/skin/HTML5 Admin Template/css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<script src="/templates/skin/HTML5 Admin Template/js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="/templates/skin/HTML5 Admin Template/js/hideshow.js" type="text/javascript"></script>
<script src="/templates/skin/HTML5 Admin Template/js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/templates/skin/HTML5 Admin Template/js/jquery.equalHeight.js"></script>
<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
<script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    	$('#generatePwd').bind('click',function(){
			$('#sPwd').val(randomPassword());
		});
	});
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

</script>
</head>

<body>
<header id="header">
  <hgroup>
    <h1 class="site_title"><a href="index.html">Website Admin</a></h1>
    <h2 class="section_title">Dashboard</h2>
  </hgroup>
</header>
<!-- end of header bar -->

<section id="secondary_bar">
  <div class="user">
    <p>
      <?php echo $_smarty_tpl->tpl_vars['page']->value['sFullName'];?>

      (<a href="#">NULL Messages</a>)</p>
    <!-- <a class="logout_user" href="#" title="Logout">Logout</a> --> 
  </div>
  <div class="breadcrumbs_container">
    <article class="breadcrumbs"><a href="index.html">Website Admin</a>
      <div class="breadcrumb_divider"></div>
      <a class="current">Dashboard</a></article>
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
  <h3>ผู้ใช้งาน</h3>
  <ul class="toggle">
    <li class="icn_add_user"><a href="/system/user/add">เพิ่มบัญชีผู้ใช้</a></li>
    <li class="icn_view_users"><a href="/system/user/view">ดูบัญชีผู้ใช้</a></li>
    <li class="icn_profile"><a href="#">ข้อมูลส่วนตัว</a></li>
  </ul>
  <h3>จัดการไฟล์และพื้นที่</h3>
  <ul class="toggle">
    <li class="icn_folder"><a href="#">จัดการไฟล์</a></li>
    <!--<li class="icn_photo"><a href="#">Gallery</a></li>
			<li class="icn_audio"><a href="#">Audio</a></li>
			<li class="icn_video"><a href="#">Video</a></li>-->
  </ul>
  <h3>ดูแลระบบ</h3>
  <ul class="toggle">
    <li class="icn_settings"><a href="#">ตั้งค่าระบบ</a></li>
    <li class="icn_security"><a href="#">ระบบความปลอดภัย</a></li>
    <li class="icn_jump_back"><a href="/dologout">ออกจากระบบ</a></li>
  </ul>
  <footer>
    <hr />
  </footer>
</aside>
<section id="main" class="column">
  <?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="main"){?>
  <article class="module width_full">
    <header>
      <h3>Stats</h3>
    </header>
  </article>
  <!-- end of stats article -->
  
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="userAdd"){?>
  <article class="module width_full">
    <header>
      <h3>เพิ่มบัญชีผู้ใช้งานใหม่</h3>
    </header>
    <div class="module_content">
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td><fieldset>
              <label>กำหนดชื่อบัญชีผู้ใช้</label>
              <input type="text" name="sUsername">
            </fieldset></td>
        </tr>
        <tr>
          <td>	
					<fieldset>
              <label>รหัสผ่าน</label>
              <input type="text" name="sPwd" id="sPwd">
              <input type="submit" id="generatePwd" value="สร้างรหัสผ่าน" style="float:left;margin:7pt;">
            </fieldset></td>
        </tr>
        <tr>
          <td><fieldset >
              <label>การใช้งาน</label>
              <select>
              	<option value="1">
                เจ้าหน้าที่ฝ่ายการศึกษา
                </option>
                <option value="2">
                เจ้าหน้าที่ฝ่ายตรวจสอบผล
                </option>
              </select>
            </fieldset>
            </td>
        </tr>
        <tr>
          <td><fieldset>
              <label>สถานะบัญชี</label>
              <select>
              	<option value="1">
               เปิดการใช้งาน
                </option>
                <option value="0">
                ระงับการใช้งาน
                </option>
              </select>
            </fieldset></td>
        </tr>
        <tr>
          <td align="center"><input type="submit" value="ส่งข้อมูล"></td>
        </tr>
      </table>
      <div class="clear"></div>
    </div>
  </article>
  <!-- end of stats article -->
  
  <?php }elseif($_smarty_tpl->tpl_vars['page']->value['view']=="viewUser"){?>
  
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Content Manager</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th>Entry Name</th> 
    				<th>Category</th> 
    				<th>Created On</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Lorem Ipsum Dolor Sit Amet</td> 
    				<td>Articles</td> 
    				<td>5th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Ipsum Lorem Dolor Sit Amet</td> 
    				<td>Freebies</td> 
    				<td>6th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr>
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Sit Amet Dolor Ipsum</td> 
    				<td>Tutorials</td> 
    				<td>10th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Dolor Lorem Amet</td> 
    				<td>Articles</td> 
    				<td>16th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr>
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Dolor Lorem Amet</td> 
    				<td>Articles</td> 
    				<td>16th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr>  
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			<div id="tab2" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					<th></th> 
    				<th>Comment</th> 
    				<th>Posted by</th> 
    				<th>Posted On</th> 
    				<th>Actions</th> 
				</tr> 
			</thead> 
			<tbody> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Lorem Ipsum Dolor Sit Amet</td> 
    				<td>Mark Corrigan</td> 
    				<td>5th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Ipsum Lorem Dolor Sit Amet</td> 
    				<td>Jeremy Usbourne</td> 
    				<td>6th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr>
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Sit Amet Dolor Ipsum</td> 
    				<td>Super Hans</td> 
    				<td>10th April 2011</td> 
    				<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Dolor Lorem Amet</td> 
    				<td>Alan Johnson</td> 
    				<td>16th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
				<tr> 
   					<td><input type="checkbox"></td> 
    				<td>Dolor Lorem Amet</td> 
    				<td>Dobby</td> 
    				<td>16th April 2011</td> 
   				 	<td><input type="image" src="images/icn_edit.png" title="Edit"><input type="image" src="images/icn_trash.png" title="Trash"></td> 
				</tr> 
			</tbody> 
			</table>

			</div><!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
  <?php }?>
  
</section>
</body>
</html><?php }} ?>