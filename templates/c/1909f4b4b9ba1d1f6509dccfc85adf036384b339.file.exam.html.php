<?php /* Smarty version Smarty-3.1.7, created on 2012-04-17 12:25:31
         compiled from "C:/xampp/htdocs/plab.localhost/templates/skin/default\exam.html" */ ?>
<?php /*%%SmartyHeaderCode:265534f698c9c9d3562-43831950%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1909f4b4b9ba1d1f6509dccfc85adf036384b339' => 
    array (
      0 => 'C:/xampp/htdocs/plab.localhost/templates/skin/default\\exam.html',
      1 => 1334658329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '265534f698c9c9d3562-43831950',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4f698c9c9ff13',
  'variables' => 
  array (
    'page' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f698c9c9ff13')) {function content_4f698c9c9ff13($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="container">
<?php if ($_smarty_tpl->tpl_vars['page']->value['view']=="list"){?>
<section>
 <table  width="100%" cellpadding="3" id="tblist">
       <thead style="text-decoration:underline; font-weight:bold;">
          <tr class="k-header">
            <th width="98">รหัสนักศึกษา</th>
            <th width="216">ชื่อนักศึกษา</th>
            <th width="167">หลักสูตร</th>
            <th width="182">ระดับปริญญา</th>
            <th width="283">สถานะ</th>
            <th width="283">ดำเนินการ</th>
            </tr>
        </thead>
        <tbody>
          <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['_gradList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
          <tr class="rowhl" valign="top">
          <style>
          #viewschedule{ color:#00F;}
		  #viewschedule:hover{ color:#FF0000;}
          </style>
            <td><a href="/edu/exam/view?graduateid=<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_ID'];?>
" id="viewschedule"><?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_ID'];?>
</a></td>
            <td><div style="margin-bottom:5px;"><?php echo $_smarty_tpl->tpl_vars['row']->value['Title_Name'];?>
<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Name'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Lastname'];?>
</div><div><?php echo $_smarty_tpl->tpl_vars['row']->value['Title_Name_English'];?>
<?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Name_English'];?>
 <?php echo $_smarty_tpl->tpl_vars['row']->value['Graduate_Lastname_English'];?>
</div></td>
            <td width="167"><?php echo $_smarty_tpl->tpl_vars['row']->value['major_name'];?>
</td>
            <td width="182"><?php echo $_smarty_tpl->tpl_vars['row']->value['Degree'];?>
</td>
            <td width="283"><?php if ($_smarty_tpl->tpl_vars['row']->value['graduate_status']==0){?>
              กำลังศึกษา
              <?php }elseif($_smarty_tpl->tpl_vars['row']->value['graduate_status']==1){?>
              สำเร็จ
  <?php }elseif($_smarty_tpl->tpl_vars['row']->value['graduate_status']==2){?>
              ลาออก
  <?php }elseif($_smarty_tpl->tpl_vars['row']->value['graduate_status']==3){?>
              ลาพัก
  <?php }elseif($_smarty_tpl->tpl_vars['row']->value['graduate_status']==4){?>
              พ้นสภาพ
  <?php }?></td>
            <td width="283">&nbsp;</td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
</section>
<?php }?>
<div class="clear-all"></div>
</div>
</body>
</html>
<?php }} ?>